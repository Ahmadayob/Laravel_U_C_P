<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    function index()
    {
        $comments = Comment::paginate(10);
        return view("comment.index", ['comments' => $comments, 'pageTitle' => 'Comments']);
    }

    function create()
    {

        return view('comment.create', ['pageTitle' => 'Create New Comment']);

    }

    function store(Request $request)
    {

        $post = Post::findOrFail($request->input('post_id'));

        $comment = new Comment();

        $comment->author = $request->input('author');
        $comment->content = $request->input('content');
        $comment->post_id = $request->input('post_id');

        $comment->save();

        return redirect('/blog')->with('success', 'Comment add successfully');
    }

    function show(string $id)
    {
        $comment = Comment::find($id);
        return view('comment.show', ['comment' => $comment, 'pageTitle' => 'view Comment']);
    }

    function edit(string $id)
    {
        $comment = Comment::find($id);
        return view('comment.edit', ['comment' => $comment, 'pageTitle' => 'Edit Comment']);
    }

    function update(Request $request, string $id)
    {
        // @todo : this will be completed in the form section
    }

    function destroy(string $id)
    {
        // @todo : this will be completed in the form section
    }
}