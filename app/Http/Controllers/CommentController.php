<?php

namespace App\Http\Controllers;

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
        // @todo : this will be completed in the form section
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