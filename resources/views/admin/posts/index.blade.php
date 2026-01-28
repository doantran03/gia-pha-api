@extends('layouts.admin')

@section('title', 'Danh sách bài viết - Gia Phả')

@section('content')
    <h1 class="mt-4">Danh sách bài viết</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Gia phả</a>
        </li>
        <li class="breadcrumb-item active">Danh sách bài viết</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách bài viết
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Slug</th>
                        <th>Mô tả ngắn</th>
                        <th>Trạng thái</th>
                        <th>Ngày xuất bản</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                                @if (!empty($post->featured_image))
                                    <img 
                                        src="{{ $post->featured_image }}"
                                        width="50"
                                        alt="Avatar">
                                @endif
                            </td>

                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->excerpt }}</td>
                            <td>{{ $post->status }}</td>
                            <td>{{ optional($post->published_at)->format('d/m/Y') }}</td>
                            {{-- ACTIONS --}}
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-success">
                                    Chỉnh sửa
                                </a>

                                <form method="POST" action="{{ route('posts.delete', $post->id) }}"style="display:inline-block" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection