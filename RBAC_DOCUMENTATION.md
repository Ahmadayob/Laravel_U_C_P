# Role-Based Access Control (RBAC) System

This Laravel application implements a comprehensive Role-Based Access Control system with the following features:

## 🎯 Features Implemented

### 1. ✅ Assign Role to User
- Added `role` column to users table with default value 'viewer'
- Three roles available: **admin**, **editor**, **viewer**
- Roles are assigned during user creation or can be updated

### 2. ✅ Hide Un-Authorized Features
- UI elements (buttons, links) are hidden based on user permissions
- Uses Laravel's `@can` directive in Blade templates
- Create button only visible to admin and editor
- Edit/Delete buttons only visible to users with appropriate permissions

### 3. ✅ Ownership Based Access Control
- Posts are linked to users via `user_id` foreign key
- Editors can only modify/delete their own posts
- Admins can modify/delete any post
- Viewers cannot modify or delete any posts

### 4. ✅ View All, But Modify Own
- All authenticated users can view all posts (viewAny, view)
- Editors can create posts and modify only their own posts
- Admins have full access to all posts
- Viewers have read-only access

### 5. ✅ Using Policies for Validation
- `PostPolicy` implements all authorization logic
- Policy methods: viewAny, view, create, update, delete, restore, forceDelete
- Controller uses `$this->authorize()` to check permissions
- Automatic 403 responses for unauthorized actions

## 📋 Role Permissions Matrix

| Action | Admin | Editor | Viewer |
|--------|-------|--------|--------|
| View all posts | ✅ | ✅ | ✅ |
| View single post | ✅ | ✅ | ✅ |
| Create post | ✅ | ✅ | ❌ |
| Edit own post | ✅ | ✅ | ❌ |
| Edit any post | ✅ | ❌ | ❌ |
| Delete own post | ✅ | ✅ | ❌ |
| Delete any post | ✅ | ❌ | ❌ |
| Restore post | ✅ | ❌ | ❌ |
| Force delete | ✅ | ❌ | ❌ |

## 🔧 Technical Implementation

### Database Structure
```
users table:
- role (varchar, default: 'viewer')

posts table:
- user_id (foreign key to users.id, nullable, cascade on delete)
```

### Models

#### User Model (`app/Models/User.php`)
- Added `role` to fillable fields
- Helper methods: `isAdmin()`, `isEditor()`, `isViewer()`
- Relationship: `posts()` - hasMany

#### Post Model (`app/Models/Post.php`)
- Added `user_id` to fillable fields
- Relationship: `user()` - belongsTo

### Policy (`app/Policies/PostPolicy.php`)
Authorization rules:
- **viewAny()**: All authenticated users
- **view()**: All authenticated users
- **create()**: Admin or Editor
- **update()**: Admin (any post) or Editor (own posts only)
- **delete()**: Admin (any post) or Editor (own posts only)
- **restore()**: Admin only
- **forceDelete()**: Admin only

### Controller (`app/Http/Controllers/PostController.php`)
Each method includes authorization:
```php
$this->authorize('create', Post::class);  // For create
$this->authorize('update', $post);        // For update/delete
```

### Middleware (`app/Http/Middleware/CheckRole.php`)
Custom middleware for route-level role checking:
```php
Route::get('/admin', ...)->middleware('check.role:admin');
Route::get('/dashboard', ...)->middleware('check.role:admin,editor');
```

### Views
Using `@can` directive:
```blade
@can('create', App\Models\Post::class)
    <a href="/blog/create">Create Post</a>
@endcan

@can('update', $post)
    <a href="/blog/{{ $post->id }}/edit">Edit</a>
@endcan

@can('delete', $post)
    <button>Delete</button>
@endcan
```

## 👥 Test Users

Three test users have been created:

| Email | Password | Role | Permissions |
|-------|----------|------|-------------|
| admin@example.com | password | admin | Full access to all posts |
| editor@example.com | password | editor | Can create posts, edit/delete own posts |
| viewer@example.com | password | viewer | Read-only access |

## 🚀 Usage Examples

### Testing the System

1. **Login as Admin**:
   ```
   Email: admin@example.com
   Password: password
   ```
   - Can see Create button
   - Can edit/delete ALL posts
   - Can see all action buttons

2. **Login as Editor**:
   ```
   Email: editor@example.com
   Password: password
   ```
   - Can see Create button
   - Can only edit/delete OWN posts
   - Cannot modify posts created by others

3. **Login as Viewer**:
   ```
   Email: viewer@example.com
   Password: password
   ```
   - Cannot see Create button
   - Cannot see Edit/Delete buttons
   - Can only view posts

### Programmatic Role Assignment

```php
// Assign role to a user
$user = User::find(1);
$user->role = 'admin';
$user->save();

// Check user role
if ($user->isAdmin()) {
    // Admin-specific logic
}

if ($user->isEditor()) {
    // Editor-specific logic
}
```

### Using Middleware in Routes

```php
// In routes/web.php
Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

Route::middleware(['auth', 'check.role:admin,editor'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create']);
});
```

## 🔒 Security Features

1. **Authorization at Multiple Levels**:
   - Middleware for route-level protection
   - Policy for model-level authorization
   - Blade directives for UI-level hiding

2. **Automatic 403 Responses**:
   - Unauthorized actions return 403 Forbidden
   - Clear error messages

3. **Ownership Tracking**:
   - Every post is linked to its creator
   - User information displayed on posts

4. **Cascading Deletes**:
   - When a user is deleted, their posts are also deleted

## 📝 Notes

- All authorization logic is centralized in the `PostPolicy`
- The `AuthorizesRequests` trait is added to the base Controller
- Posts created before the role system will be assigned to admin/editor users
- The system is extensible - you can add more roles or permissions easily

## 🎓 Best Practices Implemented

1. ✅ Single Responsibility: Policy handles all authorization
2. ✅ DRY Principle: Reusable role helper methods
3. ✅ Security First: Authorization checks in controller AND views
4. ✅ User Experience: Clear role indicators in UI
5. ✅ Maintainability: Well-documented and organized code
