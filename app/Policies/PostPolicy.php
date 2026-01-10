<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     * All authenticated users can view the list of posts
     */
    public function viewAny(User $user): bool
    {
        return true; // All users can view the list
    }

    /**
     * Determine whether the user can view the model.
     * All authenticated users can view individual posts
     */
    public function view(User $user, Post $post): bool
    {
        return true; // All users can view posts
    }

    /**
     * Determine whether the user can create models.
     * Only admin and editor can create posts
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Determine whether the user can update the model.
     * Admin can update any post
     * Editor can only update their own posts
     * Viewer cannot update any posts
     */
    public function update(User $user, Post $post): bool
    {
        // Admin can update any post
        if ($user->isAdmin()) {
            return true;
        }

        // Editor can only update their own posts
        if ($user->isEditor()) {
            return $post->user_id === $user->id;
        }

        // Viewer cannot update
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     * Admin can delete any post
     * Editor can only delete their own posts
     * Viewer cannot delete any posts
     */
    public function delete(User $user, Post $post): bool
    {
        // Admin can delete any post
        if ($user->isAdmin()) {
            return true;
        }

        // Editor can only delete their own posts
        if ($user->isEditor()) {
            return $post->user_id === $user->id;
        }

        // Viewer cannot delete
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }
}
