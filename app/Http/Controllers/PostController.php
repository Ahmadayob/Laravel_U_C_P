<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\BlogPostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check authorization
        $this->authorize('viewAny', Post::class);

        // Eloquent ORM -> Get all data from posts table
        $posts = Post::with('user')->latest()->paginate(10);

        // Pass the data to the view
        return view('post.index', [
            'posts' => $posts,
            'pageTitle' => 'Blog',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check authorization
        $this->authorize('create', Post::class);

        return view('post.create', ['pageTitle' => "Blog - Create New Post"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostRequest $request)
    {
        // Check authorization
        $this->authorize('create', Post::class);

        $post = new Post();
        $post->title = $request->input('title');
        $post->author = $request->input('author');
        $post->body = $request->input('body');
        $post->published = $request->input('published');
        $post->user_id = auth()->id(); // Assign the current user as owner

        $post->save();

        return redirect('/blog')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('user')->findOrFail($id);

        // Check authorization
        $this->authorize('view', $post);

        return view('post.show', [
            'post' => $post,
            'pageTitle' => $post->title,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        // Check authorization
        $this->authorize('update', $post);

        return view('post.edit', ['post' => $post, 'pageTitle' => "Blog - Edit Post: " . $post->title]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);

        // Check authorization
        $this->authorize('update', $post);

        $post->title = $request->input('title');
        $post->author = $request->input('author');
        $post->body = $request->input('body');
        $post->published = $request->input('published', false);

        $post->save();

        return redirect('/blog')->with('success', 'Post updated successfully');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Check authorization
        $this->authorize('delete', $post);

        $post->delete();

        return redirect('/blog')->with('success', 'Post deleted successfully');
    }
}
