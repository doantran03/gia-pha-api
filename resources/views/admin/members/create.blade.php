@extends('layouts.admin')

@section('title', 'Thêm thành viên - Gia Phả')

@section('content')
    <h1 class="mt-4">Thêm thành viên</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Gia phả</a>
        </li>
        <li class="breadcrumb-item active">Thêm thành viên</li>
    </ol>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin thành viên</h5>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="row">
                            {{-- ========= COL 9 : THÔNG TIN ========= --}}
                            <div class="col-lg-9">
                                <div class="row g-3">

                                    {{-- HỌ TÊN --}}
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                                value="{{ old('full_name') }}" placeholder="Nguyễn Văn A">
                                            <label>Họ và tên</label>
                                            @error('full_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- TÊN KHÁC --}}
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="other_name"
                                                value="{{ old('other_name') }}" placeholder="Tên húy">
                                            <label>Tên khác</label>
                                        </div>
                                    </div>

                                    {{-- ĐỊA CHỈ --}}
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="address" 
                                                value="{{ old('address') }}" placeholder="Thôn 3, Xã Y, Huyện Z">
                                            <label>Địa chỉ</label>
                                        </div>
                                    </div>

                                    {{-- CHA --}}
                                    <div class="col-md-4">
                                        <select class="form-select select2-father" name="fid">
                                            <option value="">Cha</option>
                                            @foreach($fathers as $m)
                                                <option value="{{ $m->id }}">{{ $m->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- MẸ --}}
                                    <div class="col-md-4">
                                        <select class="form-select select2-mother" name="mid">
                                            <option value="">Mẹ</option>
                                        </select>
                                    </div>

                                    {{-- VỢ / CHỒNG --}}
                                    <div class="col-md-4">
                                        <select class="form-select select2-spouse" name="pids[]" multiple>
                                            @foreach($members as $m)
                                                <option value="{{ $m->id }}">{{ $m->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- NGÀY SINH --}}
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                                value="{{ old('birth_date') }}">
                                            <label>Ngày sinh</label>
                                            @error('birth_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- GIỚI TÍNH --}}
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select class="form-select" name="gender">
                                                <option value="male">Nam</option>
                                                <option value="female">Nữ</option>
                                                <option value="other">Khác</option>
                                            </select>
                                            <label>Giới tính</label>
                                        </div>
                                    </div>

                                    {{-- THỨ TỰ --}}
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="number" class="form-control @error('order') is-invalid @enderror" name="order"
                                                value="{{ old('order') }}" placeholder="1">
                                            <label>Thứ tự</label>
                                            @error('order')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- ĐỜI --}}
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" name="generation"
                                                value="{{ old('generation') }}" placeholder="1">
                                            <label>Đời</label>
                                        </div>
                                    </div>

                                    {{-- TIỂU SỬ --}}
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="biography" style="height: 200px">{{ old('biography') }}</textarea>
                                            <label>Tiểu sử</label>
                                        </div>
                                    </div>

                                    {{-- NGÀY MẤT --}}
                                    <div class="col-12">
                                        <div class="form-check mt-3">
                                            <input class="form-check-input"
                                                    value="1"
                                                type="checkbox"
                                                id="has_death_date"
                                                onchange="toggleDeathDate()"
                                                {{ old('death_date') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_death_date">
                                                Đã mất
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12"
                                        id="death-date-wrapper"
                                        style="{{ old('death_date') ? '' : 'display:none' }}">

                                        <div class="form-floating">
                                            <input type="date"
                                                class="form-control"
                                                name="death_date"
                                                value="{{ old('death_date') }}">
                                            <label>Ngày mất</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ========= COL 4 : AVATAR ========= --}}
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="mb-3">Ảnh</p>
                                        <img id="preview-avatar"
                                            src="{{ asset('assets/img/default-avatar.png') }}"
                                            class="img-fluid rounded"
                                            style="cursor: pointer;">

                                        <input type="file" id="avatar-input" class="d-none" name="avatar"
                                            accept="image/*"
                                            onchange="previewAvatar(this)">

                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('members.index') }}" class="btn btn-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-primary">Thêm thành viên</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection