<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagController extends Controller
{

    public function index(): View
    {
        $tags = Tag::all();

        // Pass the data to the view
        return view('tag.index', [
            'tags' => $tags,
            'pageTitle' => 'Tags',
        ]);
    }


    public function create(): RedirectResponse
    {
        Tag::create([

            'title' => 'CSS',

        ]);

        return redirect('/tags');
    }

    function testManyToMany()
    {

        //    $post3 = Post::find(3);
        //      $post2 = Post::find(2);
//        $post1 = Post::find(1);

        //      $post3->tags()->attach([1, 2]);
//        $post2->tags()->attach([1]);


        //return response()->json(([
        //'post3' => $post3->tags,
        // 'post2' => $post2->tags,
        //   'post1' => $post1->tags,
        // ]));

        $tag = Tag::find(1);

        $tag->posts()->attach([3]);

        return response()->json([
            'tag' => $tag->title,
            'posts' => $tag->posts

        ]);

    }


}
