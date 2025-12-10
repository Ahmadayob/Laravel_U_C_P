<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class PostController extends Controller
{

    /**
     * Display a listing of the posts.
     */
    public function index(): View
    {
        // Eloquent ORM -> Get all data from posts table
        $posts = Post::paginate(10);

        // Pass the data to the view
        return view('post.index', [
            'posts' => $posts,
            'pageTitle' => 'Blog',
        ]);
    }


    /**
     * Display a single post.
     */
    public function show(int $id): View
    {
        // لو الـ id مش موجود يرجع 404 بدل ما يعمل خطأ
        $post = Post::findOrFail($id);

        return view('post.show', [
            'post' => $post,
            'pageTitle' => $post->title,
        ]);
    }

    /**
     * Create a demo post (for testing).
     */
    public function create(): RedirectResponse
    {
        // Post::create([
        //   'title' => 'My find unique post',
        // 'body' => 'this is my content',
        //'author' => 'Ahmad',
        // 'published' => true,
        // ]);

        Post::factory(1000)->create();

        return redirect('/blog');
    }

    /**
     * Delete a post by id.
     */
    public function delete(int $id): RedirectResponse
    {
        Post::destroy($id);

        return redirect('/blog');
    }
}
