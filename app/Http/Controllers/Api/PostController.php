<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 9);

        $posts = Post::orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $posts->items(),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'per_page'     => $posts->perPage(),
                'total_posts'  => $posts->total(),
                'total_pages'    => $posts->lastPage(),
            ]
        ]);
    }

    public function home(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function detail($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }
}
