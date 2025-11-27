<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    function index() {
        // Eloquent ORM ->Get all data from posts table
     $data = Post::all(); 

     // pass the data to the view
     return view ('post.index', ['posts' => $data]);
    }
}
