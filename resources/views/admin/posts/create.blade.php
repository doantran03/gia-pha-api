@extends('layouts.admin')

@section('title', 'Thêm bài viết - Gia Phả')

@section('content')
    <h1 class="mt-4">Thêm bài viết</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Gia phả</a>
        </li>
        <li class="breadcrumb-item active">Thêm bài viết</li>
    </ol>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin bài viết</h5>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="row">
                            {{-- ========= COL 9 : THÔNG TIN ========= --}}
                            <div class="col-lg-9">
                                <div class="row g-3">

                                    {{-- TIÊU ĐỀ --}}
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title"
                                                value="{{ old('title') }}" placeholder="Tiêu đề bài viết">
                                            <label>Tiêu đề</label>
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- SLUG --}}
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                                                value="{{ old('slug') }}" placeholder="Slug bài viết">
                                            <label>Slug</label>
                                            @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- NỘI DUNG --}}
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="content" style="height: 200px">{{ old('content') }}</textarea>
                                            <label>NỘI DUNG</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ========= COL 4 : AVATAR ========= --}}
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row g-3">
                                            <div class="col-12">
                                                {{-- AVATAR --}}
                                                <p class="mb-3">Hình ảnh</p>
                                                <img id="preview_featured_image" src="#" class="img-fluid rounded d-none" style="cursor: pointer;">

                                                <input type="file" id="featured_image" class="form-control" name="featured_image" accept="image/*" onchange="previewFeatureImage(this)">
                                            </div>  
                                                
                                            {{-- MÔ TẢ NGẮN --}}
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="excerpt" 
                                                        value="{{ old('excerpt') }}" placeholder="Thôn 3, Xã Y, Huyện Z">
                                                    <label>Mô tả ngắn</label>
                                                </div>
                                            </div>

                                            {{-- TRẠNG THÁI --}}
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <select class="form-select" name="status">
                                                        <option value="published">Đã xuất bản</option>
                                                        <option value="draft">Bản nháp</option>
                                                    </select>
                                                    <label>Trạng Thái</label>
                                                </div>
                                            </div>

                                            {{-- NGÀY XUẤT BẢN --}}
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" name="published_at" 
                                                        value="{{ old('published_at') }}" placeholder="mm/dd/yyyy">
                                                    <label>Ngày xuất bản</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-primary">Thêm bài viết</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection