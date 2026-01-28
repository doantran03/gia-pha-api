<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{   
    public function all(): Collection
    {
        return Post::with()->get();
    }

    public function find(int $id): ?Post
    {
        return Post::with()->find($id);
    }

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data): Post
    {
        $post->update($data);
        return $post;
    }

    public function delete(Post $post): bool
    {
        return $post->delete();
    }
}
