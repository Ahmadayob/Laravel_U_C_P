# RBAC Quick Reference Guide

## 🔑 Test Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Editor | editor@example.com | password |
| Viewer | viewer@example.com | password |

## 🎯 What Each Role Can Do

### 👑 Admin
- ✅ View all posts
- ✅ Create new posts
- ✅ Edit ANY post (including others' posts)
- ✅ Delete ANY post (including others' posts)
- ✅ Restore deleted posts
- ✅ Force delete posts

### ✏️ Editor
- ✅ View all posts
- ✅ Create new posts
- ✅ Edit ONLY their own posts
- ✅ Delete ONLY their own posts
- ❌ Cannot edit/delete others' posts
- ❌ Cannot restore or force delete

### 👁️ Viewer
- ✅ View all posts
- ❌ Cannot create posts
- ❌ Cannot edit any posts
- ❌ Cannot delete any posts
- ❌ Read-only access

## 📂 Files Modified/Created

### Created:
- `app/Policies/PostPolicy.php` - Authorization rules
- `app/Http/Middleware/CheckRole.php` - Role middleware
- `database/migrations/2026_01_10_152340_add_role_to_user_table.php`
- `database/migrations/2026_01_10_154630_add_user_id_to_posts_table.php`
- `database/seeders/AssignRolesToUsersSeeder.php`

### Modified:
- `app/Models/User.php` - Added role helpers and posts relationship
- `app/Models/Post.php` - Added user relationship
- `app/Http/Controllers/Controller.php` - Added AuthorizesRequests trait
- `app/Http/Controllers/PostController.php` - Added authorization checks
- `bootstrap/app.php` - Registered CheckRole middleware
- `resources/views/post/index.blade.php` - Added @can directives
- `resources/views/post/show.blade.php` - Added @can directives

## 🧪 Testing the System

### Step 1: Login as Admin
```
1. Go to /login
2. Email: admin@example.com
3. Password: password
4. Navigate to /blog
5. You should see:
   - Create button
   - Edit button on ALL posts
   - Delete button on ALL posts
```

### Step 2: Login as Editor
```
1. Logout
2. Login with editor@example.com / password
3. Navigate to /blog
4. You should see:
   - Create button
   - Edit/Delete buttons ONLY on posts you created
   - No Edit/Delete on other users' posts
```

### Step 3: Login as Viewer
```
1. Logout
2. Login with viewer@example.com / password
3. Navigate to /blog
4. You should see:
   - NO Create button
   - NO Edit buttons
   - NO Delete buttons
   - Only view access
```

## 💻 Code Snippets

### Check User Role in Controller
```php
if (auth()->user()->isAdmin()) {
    // Admin logic
}

if (auth()->user()->isEditor()) {
    // Editor logic
}

if (auth()->user()->isViewer()) {
    // Viewer logic
}
```

### Check Permission in Blade
```blade
@can('create', App\Models\Post::class)
    <!-- Show create button -->
@endcan

@can('update', $post)
    <!-- Show edit button -->
@endcan

@can('delete', $post)
    <!-- Show delete button -->
@endcan
```

### Protect Routes with Middleware
```php
// Only admin can access
Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

// Admin or Editor can access
Route::middleware(['auth', 'check.role:admin,editor'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

### Authorize in Controller
```php
// Check if user can create
$this->authorize('create', Post::class);

// Check if user can update specific post
$this->authorize('update', $post);

// Check if user can delete specific post
$this->authorize('delete', $post);
```

## 🔄 Common Tasks

### Change User Role
```bash
php artisan tinker
```
```php
$user = User::where('email', 'user@example.com')->first();
$user->role = 'admin'; // or 'editor' or 'viewer'
$user->save();
```

### Create New User with Role
```php
User::create([
    'name' => 'New User',
    'email' => 'newuser@example.com',
    'password' => Hash::make('password'),
    'role' => 'editor'
]);
```

### Assign Post to User
```php
$post = Post::find($postId);
$post->user_id = auth()->id();
$post->save();
```

## 🐛 Troubleshooting

### Issue: Getting 403 Forbidden
**Solution**: Check if:
1. User is logged in
2. User has the correct role
3. For update/delete: User owns the post (if editor)

### Issue: Buttons still showing for unauthorized users
**Solution**: 
1. Clear browser cache
2. Check if `@can` directives are properly placed
3. Ensure policy is registered (auto-registered in Laravel 11)

### Issue: Authorization not working
**Solution**:
1. Check if `AuthorizesRequests` trait is in base Controller
2. Verify policy methods return boolean
3. Check if user is authenticated

## 📊 Database Queries

### Get all posts by a user
```php
$user = User::find(1);
$posts = $user->posts;
```

### Get post with owner info
```php
$post = Post::with('user')->find($postId);
echo $post->user->name;
echo $post->user->role;
```

### Get all admins
```php
$admins = User::where('role', 'admin')->get();
```

### Get all editors
```php
$editors = User::where('role', 'editor')->get();
```

## 🎨 UI Indicators

Posts now show:
- Post title
- Post author
- Posted by: [User Name] ([Role])
- Action buttons (based on permissions)

This helps users understand:
- Who created the post
- What role that user has
- What actions they can perform
