<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): ?Post;

    public function create(array $data): Post;

    public function update(Post $post, array $data): Post;

    public function delete(Post $post): bool;
}
