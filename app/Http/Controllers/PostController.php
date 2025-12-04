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
     return view ('post.index', ['posts' => $data,"pageTitle" => "Blog"]);
    }

    function show($id) {
        $post=Post::find($id);
        
        return view('post.show',['post'=>$post,"pageTitle" =>   $post->title]);
    }
    function create() {
        $post=Post::create([
            'title'=>'My find unique post',
            'body'=>'this is my content',
            'author'=>'Ahmad',
            'published'=>true
        ]);
        return redirect('/blog');
        
    }

    function delete($id){
        Post::destroy($id);
        return redirect('/blog');
    }
}
