<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
class TagController extends Controller
{
    function index()
    {
        $tags = Tag::paginate(10);
        return view("tag.index", ['tags' => $tags, 'pageTitle' => 'Tags']);
    }

    function create()
    {

        return view('tag.create', ['pageTitle' => 'Create New Tag']);

    }

    function store(Request $request)
    {
        // @todo : this will be completed in the form section
    }

    function show(string $id)
    {
        $tag = Tag::find($id);
        return view('tag.show', ['tag' => $tag, 'pageTitle' => 'view Tag']);
    }

    function edit(string $id)
    {
        $tag = Tag::find($id);
        return view('tag.edit', ['tag' => $tag, 'pageTitle' => 'Edit Tag']);
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