#!/bin/bash

echo "================================"
echo "RBAC System Verification"
echo "================================"
echo ""

echo "✅ Checking migrations..."
php artisan migrate:status | grep -E "(add_role_to_user|add_user_id_to_posts)"

echo ""
echo "✅ Checking if test users exist..."
php artisan tinker --execute="
\$users = App\Models\User::whereIn('email', ['admin@example.com', 'editor@example.com', 'viewer@example.com'])->get(['name', 'email', 'role']);
foreach (\$users as \$user) {
    echo \$user->email . ' - ' . \$user->role . PHP_EOL;
}
"

echo ""
echo "✅ Checking Policy..."
if [ -f "app/Policies/PostPolicy.php" ]; then
    echo "PostPolicy exists ✓"
else
    echo "PostPolicy missing ✗"
fi

echo ""
echo "✅ Checking Middleware..."
if [ -f "app/Http/Middleware/CheckRole.php" ]; then
    echo "CheckRole middleware exists ✓"
else
    echo "CheckRole middleware missing ✗"
fi

echo ""
echo "✅ Checking Views..."
if grep -q "@can('create'" resources/views/post/index.blade.php; then
    echo "Authorization directives in index.blade.php ✓"
else
    echo "Authorization directives missing ✗"
fi

echo ""
echo "================================"
echo "Verification Complete!"
echo "================================"
echo ""
echo "Test Credentials:"
echo "  Admin:  admin@example.com / password"
echo "  Editor: editor@example.com / password"
echo "  Viewer: viewer@example.com / password"
echo ""
echo "Visit: http://127.0.0.1:8000/blog"
