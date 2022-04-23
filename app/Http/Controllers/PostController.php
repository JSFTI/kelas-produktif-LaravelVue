<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // GET all
    public function index(Request $request)
    {
        $postCount = Post::count();
        $page = $request->page ?? 1;
        $offset = ($page - 1) * 10;
        $posts = Post::limit(10)->offset($offset)->get();
        return [
            'count' => $postCount,
            'nextPage' => $postCount > 10 * $page ? route('posts.index', ['page' => $page + 1]) : null,
            'prevPage' => $page > 1 ? route('posts.index', ['page' => $page - 1]) : null,
            'posts' => $posts,
        ];
    }

    // POST
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->image = $request->image;
        $post->content = $request->content;
        $post->save();

        return response()->json('success', 200);
    }

    // GET one
    public function show($id)
    {
        $post = Post::with('comments')->find($id);
        $nextPost = Post::where('id', '>', $post->id)->select('id')->first();
        $prevPost = Post::where('id', '<', $post->id)->select('id')->first();

        return response()->json([
            'post' => $post,
            'next' => $nextPost ? route('posts.show', [$nextPost->id]) : null,
            'prev' => $prevPost ? route('posts.show', [$prevPost->id]) : null
        ], 200);
    }

    // PUT
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->image = $request->image;
        $post->content = $request->content;
        $post->save();

        return response()->json('success', 200);
    }

    // DELETE
    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json('success', 200);
    }
}
