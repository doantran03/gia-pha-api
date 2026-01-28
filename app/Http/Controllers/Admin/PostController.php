<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(PostRequest $request)
    {
        $this->postService->create($request->validated());

        return redirect()
            ->route('posts.index')
            ->with('success', 'Bài viết đã được tạo thành công.');
    }

    public function edit($postId)
    {
        $post = Post::findOrFail($postId);

        return view('admin.posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $postId)
    {
        $post = Post::findOrFail($postId);

        $this->postService->update($post, $request->validated());

        return redirect()
            ->route('posts.index')
            ->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function delete($postId)
    {
        $post = Post::findOrFail($postId);

        $this->postService->delete($post);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Bài viết đã được xóa thành công.');
    }
}
