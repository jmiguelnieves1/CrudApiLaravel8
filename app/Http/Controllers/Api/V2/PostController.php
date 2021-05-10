<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\PostCollection;
use App\Http\Resources\V2\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate();
        return new PostCollection($posts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:254',
            'content' => 'required|min:10',
        ]);

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->save();

        return response()->json([
            new PostResource($post)
        ], 201);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:5|max:254',
            'content' => 'required|min:10',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->update();

        return response()->json([
            new PostResource($post)
        ], 202);
    }

    public function destroy(Post $post)
    {
        //
    }
}
