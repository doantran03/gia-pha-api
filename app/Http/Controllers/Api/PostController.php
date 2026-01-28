<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController
{
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }
}
