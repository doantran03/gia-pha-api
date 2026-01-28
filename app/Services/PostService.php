<?php 

namespace App\Services;

use App\Models\Post;
use App\Services\FileUploadService;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostService 
{
    protected FileUploadService $fileUploadService;
    protected PostRepositoryInterface $postRepository;

    public function __construct(FileUploadService $fileUploadService, PostRepositoryInterface $postRepository)
    {
        $this->fileUploadService = $fileUploadService;
        $this->postRepository = $postRepository;
    }

    public function create(array $data): Post
    {
        $this->handleFeatureImageUpload($data);

        if (empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post = $this->postRepository->create($data);

        return $post;
    }

    public function update(Post $post, array $data): Post
    {
        $this->handleFeatureImageUpload($data);

        if (array_key_exists('published_at', $data) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $updatePost = $this->postRepository->update($post, $data);

        return $updatePost;
    }

    public function delete(Post $post): void
    {
        $this->postRepository->delete($post);
    }

    /* ================== PRIVATE HELPERS ================== */

    private function handleFeatureImageUpload(array &$data, bool $isUpdate = false): void
    {
        if (!array_key_exists('featured_image', $data)) {
            return;
        }

        if ($isUpdate && empty($data['featured_image'])) {
            unset($data['featured_image']);
            return;
        }

        if (!empty($data['featured_image'])) {
            $data['featured_image'] = $this->fileUploadService->upload($data['featured_image'], 'posts');
            return;
        }

        unset($data['featured_image']);
    }
}