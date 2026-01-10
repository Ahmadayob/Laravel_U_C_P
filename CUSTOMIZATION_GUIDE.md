# 🎨 RBAC Customization Guide

This guide shows you how to customize and extend the Role-Based Access Control system.

---

## 🎯 Common Customizations

### 1. Add a New Role (e.g., "Moderator")

#### Step 1: Update the Database
```bash
php artisan tinker
```

```php
// Add moderator role to an existing user
$user = User::find(1);
$user->role = 'moderator';
$user->save();

// Or create a new moderator user
User::create([
    'name' => 'Moderator User',
    'email' => 'moderator@example.com',
    'password' => Hash::make('password'),
    'role' => 'moderator'
]);
```

#### Step 2: Add Helper Method to User Model

**File:** `app/Models/User.php`

```php
public function isModerator(): bool
{
    return $this->role === 'moderator';
}
```

#### Step 3: Update PostPolicy

**File:** `app/Policies/PostPolicy.php`

```php
public function update(User $user, Post $post): bool
{
    // Admin can update any post
    if ($user->isAdmin()) {
        return true;
    }

    // Moderator can update any post (NEW)
    if ($user->isModerator()) {
        return true;
    }

    // Editor can only update their own posts
    if ($user->isEditor()) {
        return $post->user_id === $user->id;
    }

    return false;
}

public function delete(User $user, Post $post): bool
{
    // Admin can delete any post
    if ($user->isAdmin()) {
        return true;
    }

    // Moderator can delete any post (NEW)
    if ($user->isModerator()) {
        return true;
    }

    // Editor can only delete their own posts
    if ($user->isEditor()) {
        return $post->user_id === $user->id;
    }

    return false;
}
```

#### Step 4: Update Middleware (if needed)

**File:** `routes/web.php`

```php
// Moderator-only routes
Route::middleware(['auth', 'check.role:moderator,admin'])->group(function () {
    Route::get('/moderate', [ModerateController::class, 'index']);
});
```

---

### 2. Add More Granular Permissions

Instead of just roles, you might want specific permissions.

#### Create a Permission System

**Migration:**
```bash
php artisan make:migration create_permissions_table
```

```php
Schema::create('permissions', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // e.g., 'edit-posts', 'delete-posts'
    $table->timestamps();
});

Schema::create('role_permissions', function (Blueprint $table) {
    $table->id();
    $table->string('role');
    $table->foreignId('permission_id')->constrained();
    $table->timestamps();
});
```

**Usage in Policy:**
```php
public function update(User $user, Post $post): bool
{
    // Check if user's role has 'edit-posts' permission
    $hasPermission = DB::table('role_permissions')
        ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
        ->where('role_permissions.role', $user->role)
        ->where('permissions.name', 'edit-posts')
        ->exists();

    if ($hasPermission) {
        // Check ownership if needed
        return $post->user_id === $user->id;
    }

    return false;
}
```

---

### 3. Add Role-Based Navigation

**File:** `resources/views/layouts/navigation.blade.php` (or your layout)

```blade
<nav>
    <a href="/blog">Blog</a>
    
    @can('create', App\Models\Post::class)
        <a href="/blog/create">Create Post</a>
    @endcan
    
    @if(auth()->user()->isAdmin())
        <a href="/admin">Admin Panel</a>
    @endif
    
    @if(auth()->user()->isAdmin() || auth()->user()->isModerator())
        <a href="/moderate">Moderation</a>
    @endif
</nav>
```

---

### 4. Add Role Badge Component

**Create:** `resources/views/components/role-badge.blade.php`

```blade
@props(['role'])

@php
    $colors = [
        'admin' => 'bg-green-100 text-green-800',
        'editor' => 'bg-blue-100 text-blue-800',
        'viewer' => 'bg-gray-100 text-gray-800',
        'moderator' => 'bg-purple-100 text-purple-800',
    ];
    
    $color = $colors[$role] ?? 'bg-gray-100 text-gray-800';
@endphp

<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $color }}">
    {{ ucfirst($role) }}
</span>
```

**Usage:**
```blade
<x-role-badge :role="$post->user->role" />
```

---

### 5. Extend to Other Models (e.g., Comments)

#### Create Comment Policy

```bash
php artisan make:policy CommentPolicy --model=Comment
```

**File:** `app/Policies/CommentPolicy.php`

```php
public function update(User $user, Comment $comment): bool
{
    // Admin can update any comment
    if ($user->isAdmin()) {
        return true;
    }

    // User can update their own comment
    return $comment->user_id === $user->id;
}

public function delete(User $user, Comment $comment): bool
{
    // Admin and moderator can delete any comment
    if ($user->isAdmin() || $user->isModerator()) {
        return true;
    }

    // User can delete their own comment
    return $comment->user_id === $user->id;
}
```

#### Update Comment Model

**File:** `app/Models/Comment.php`

```php
protected $fillable = ['content', 'author', 'post_id', 'user_id'];

public function user()
{
    return $this->belongsTo(User::class);
}
```

#### Update Comment Controller

```php
public function update(Request $request, $id)
{
    $comment = Comment::findOrFail($id);
    
    $this->authorize('update', $comment);
    
    // Update logic...
}

public function destroy($id)
{
    $comment = Comment::findOrFail($id);
    
    $this->authorize('delete', $comment);
    
    $comment->delete();
    
    return back()->with('success', 'Comment deleted');
}
```

---

### 6. Add Role Selection in User Registration

**File:** `app/Http/Controllers/Auth/RegisterController.php`

```php
protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => $data['role'] ?? 'viewer', // Default to viewer
    ]);
}
```

**File:** `resources/views/auth/register.blade.php`

```blade
<div>
    <label for="role">Role</label>
    <select name="role" id="role">
        <option value="viewer">Viewer</option>
        <option value="editor">Editor</option>
        <!-- Only show admin option to existing admins -->
        @if(auth()->check() && auth()->user()->isAdmin())
            <option value="admin">Admin</option>
        @endif
    </select>
</div>
```

---

### 7. Add Activity Logging

Track who does what:

```bash
php artisan make:migration create_activity_logs_table
```

```php
Schema::create('activity_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->string('action'); // 'created', 'updated', 'deleted'
    $table->string('model'); // 'Post', 'Comment'
    $table->unsignedBigInteger('model_id');
    $table->json('changes')->nullable();
    $table->timestamps();
});
```

**Create Model:**
```php
php artisan make:model ActivityLog
```

**Usage in Controller:**
```php
public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);
    $this->authorize('update', $post);
    
    $oldData = $post->toArray();
    
    // Update post...
    $post->update($request->all());
    
    // Log activity
    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'updated',
        'model' => 'Post',
        'model_id' => $post->id,
        'changes' => [
            'old' => $oldData,
            'new' => $post->fresh()->toArray()
        ]
    ]);
    
    return redirect('/blog');
}
```

---

### 8. Add Admin Panel for Role Management

**Controller:** `app/Http/Controllers/Admin/UserController.php`

```php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.role:admin');
    }

    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,editor,viewer,moderator'
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role updated successfully');
    }
}
```

**View:** `resources/views/admin/users/index.blade.php`

```blade
<x-layout title="User Management">
    <h1>Manage Users</h1>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Current Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <x-role-badge :role="$user->role" />
                </td>
                <td>
                    <form method="POST" action="/admin/users/{{ $user->id }}/role">
                        @csrf
                        @method('PATCH')
                        <select name="role">
                            <option value="viewer" {{ $user->role === 'viewer' ? 'selected' : '' }}>Viewer</option>
                            <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Editor</option>
                            <option value="moderator" {{ $user->role === 'moderator' ? 'selected' : '' }}>Moderator</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
```

**Routes:** `routes/web.php`

```php
Route::middleware(['auth', 'check.role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole']);
});
```

---

### 9. Add API Authorization

**File:** `app/Http/Controllers/Api/PostApiController.php`

```php
public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);
    
    // Use policy for API as well
    $this->authorize('update', $post);
    
    $post->update($request->all());
    
    return response()->json($post);
}
```

**API Routes with Role Protection:**

```php
Route::middleware(['auth:sanctum', 'check.role:admin,editor'])->group(function () {
    Route::post('/posts', [PostApiController::class, 'store']);
    Route::put('/posts/{id}', [PostApiController::class, 'update']);
    Route::delete('/posts/{id}', [PostApiController::class, 'destroy']);
});
```

---

### 10. Add Soft Deletes with Restore Permission

**Migration:**
```php
Schema::table('posts', function (Blueprint $table) {
    $table->softDeletes();
});
```

**Model:**
```php
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
}
```

**Policy:**
```php
public function restore(User $user, Post $post): bool
{
    // Only admin can restore
    return $user->isAdmin();
}

public function forceDelete(User $user, Post $post): bool
{
    // Only admin can permanently delete
    return $user->isAdmin();
}
```

**Controller:**
```php
public function restore($id)
{
    $post = Post::withTrashed()->findOrFail($id);
    $this->authorize('restore', $post);
    
    $post->restore();
    
    return back()->with('success', 'Post restored');
}
```

---

## 🎓 Best Practices

1. **Keep Authorization in Policies**: Don't scatter authorization logic across controllers
2. **Use Helper Methods**: Create role helper methods like `isAdmin()` for readability
3. **Test Thoroughly**: Test each role with each action
4. **Document Changes**: Update documentation when adding new roles/permissions
5. **Use Middleware for Routes**: Protect entire route groups with middleware
6. **Use @can in Views**: Hide UI elements users can't access
7. **Log Important Actions**: Track who does what for security
8. **Validate Role Values**: Ensure only valid roles can be assigned

---

## 📚 Additional Resources

- Laravel Authorization Docs: https://laravel.com/docs/authorization
- Laravel Policies: https://laravel.com/docs/authorization#creating-policies
- Laravel Gates: https://laravel.com/docs/authorization#gates
- Spatie Permission Package: https://spatie.be/docs/laravel-permission (for complex permission systems)

---

**Happy Customizing! 🚀**
