<?php


namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AssignRolesToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        // Create an editor user
        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor User',
                'password' => Hash::make('password'),
                'role' => 'editor'
            ]
        );

        // Create a viewer user
        $viewer = User::firstOrCreate(
            ['email' => 'viewer@example.com'],
            [
                'name' => 'Viewer User',
                'password' => Hash::make('password'),
                'role' => 'viewer'
            ]
        );

        $this->command->info('Users created successfully!');
        $this->command->info('Admin: admin@example.com / password');
        $this->command->info('Editor: editor@example.com / password');
        $this->command->info('Viewer: viewer@example.com / password');

        // Assign existing posts to users (if any exist)
        $posts = Post::whereNull('user_id')->get();

        if ($posts->count() > 0) {
            foreach ($posts as $index => $post) {
                // Distribute posts among admin and editor
                $post->user_id = ($index % 2 == 0) ? $admin->id : $editor->id;
                $post->save();
            }
            $this->command->info("Assigned {$posts->count()} posts to users");
        }
    }
}
