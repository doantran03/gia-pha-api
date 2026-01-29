@extends('layouts.admin')

@section('title', 'Thêm sự kiện - Gia Phả')

@section('content')
    <h1 class="mt-4">Thêm sự kiện</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Gia phả</a>
        </li>
        <li class="breadcrumb-item active">Thêm sự kiện</li>
    </ol>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin sự kiện</h5>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('events.store') }}" novalidate>
                        @csrf

                        <div class="row g-3">
                            {{-- TÊN SỰ KIỆN --}}
                            <div class="col-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title') }}" placeholder="Tên sự kiện">
                                    <label>Tên sự kiện</label>
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- NGÀY BẮT ĐẦU --}}
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="datetime-local" class="form-control" name="start"
                                        value="{{ old('start') }}" placeholder="Ngày bắt đầu">
                                    <label>Ngày bắt đầu</label>
                                    @error('start')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- NGÀY KẾT THÚC --}}
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="datetime-local" class="form-control" name="end"
                                        value="{{ old('end') }}" placeholder="Ngày kết thúc">
                                    <label>Ngày kết thúc</label>
                                </div>
                            </div>

                            {{-- BACKGROUND COLOR --}}
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="color" class="form-control" name="background_color"
                                        value="{{ old('background_color') }}" placeholder="Màu nền">
                                    <label>Màu nền</label>
                                </div>
                            </div>

                            {{-- TẤT CẢ NGÀY --}}
                            <div class="col-md-3">
                                <input type="checkbox" class="form-check-input" name="all_day" value="1"
                                    {{ old('all_day') ? 'checked' : '' }} >
                                <label class="form-check-label">Tất cả ngày</label>
                            </div>
                            
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('events.index') }}" class="btn btn-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-primary">Thêm sự kiện</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection