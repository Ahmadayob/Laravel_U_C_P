<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    function index() {
        // Eloquent ORM ->Get all data from posts table
     $data = Comment::all(); 

     // pass the data to the view
     return view ('comment.index', ['comments' => $data,"pageTitle" => "Blog"]);
    }

    function create() {
        Comment::create([
            'author' => 'Ahmad',
            'content' => 'this is another test content',
            'post_id' => 3
        ]);
        return redirect('/comments');
        
    }
}
