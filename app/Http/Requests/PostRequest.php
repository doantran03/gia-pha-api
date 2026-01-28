<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $postId = $this->route('postId');

        return [
            'featured_image' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($postId),
            ],
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'status' => 'required|in:published,draft',
            'published_at' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'featured_image.image' => 'File tải lên phải là hình ảnh.',
            'featured_image.max'   => 'Hình ảnh tối đa 2MB.',
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'slug.required'  => 'Vui lòng nhập slug.',
            'slug.unique'    => 'Slug này đã tồn tại.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
