@extends('layouts.admin')

@section('title', 'Chỉnh sửa thành viên - Gia Phả')

@section('content')
<h1 class="mt-4">Chỉnh sửa thành viên</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Gia phả</a>
    </li>
    <li class="breadcrumb-item active">Chỉnh sửa thành viên</li>
</ol>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">

            <div class="card-header">
                <h5 class="mb-0">Thông tin thành viên</h5>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('members.update', $member->id) }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- ========= COL 9 : THÔNG TIN ========= --}}
                        <div class="col-lg-9">
                            <div class="row g-3">

                                {{-- HỌ TÊN --}}
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                            name="full_name"
                                            value="{{ old('full_name', $member->full_name) }}">
                                        <label>Họ và tên</label>
                                        @error('full_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- TÊN KHÁC --}}
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control"
                                            name="other_name"
                                            value="{{ old('other_name', $member->other_name) }}">
                                        <label>Tên khác</label>
                                    </div>
                                </div>

                                {{-- ĐỊA CHỈ --}}
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control"
                                            name="address"
                                            value="{{ old('address', $member->address) }}">
                                        <label>Địa chỉ</label>
                                    </div>
                                </div>

                                {{-- CHA --}}
                                <div class="col-md-4">
                                    <select class="form-select select2-father" name="fid">
                                        <option value="">Cha</option>
                                        @foreach($fathers as $m)
                                            <option value="{{ $m->id }}"
                                                {{ old('fid', $member->fid) == $m->id ? 'selected' : '' }}>
                                                {{ $m->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- MẸ --}}
                                <div class="col-md-4">
                                    <select class="form-select select2-mother" name="mid">
                                        <option value="">Mẹ</option>
                                        @if($member->mother)
                                            <option value="{{ $member->mother->id }}" selected>
                                                {{ $member->mother->full_name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                {{-- VỢ / CHỒNG --}}
                                @php
                                    $partnerIds = old(
                                        'pids',
                                        $member->partners->pluck('id')->toArray()
                                    );
                                @endphp

                                <div class="col-md-4">
                                    <select class="form-select select2-spouse" name="pids[]" multiple>
                                        @foreach($members as $m)
                                            <option value="{{ $m->id }}"
                                                {{ in_array($m->id, $partnerIds) ? 'selected' : '' }}>
                                                {{ $m->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- NGÀY SINH --}}
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="date"
                                            class="form-control"
                                            name="birth_date"
                                            value="{{ old('birth_date', optional($member->birth_date)->format('Y-m-d')) }}">
                                        <label>Ngày sinh</label>
                                    </div>
                                </div>

                                {{-- GIỚI TÍNH --}}
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <select class="form-select" name="gender">
                                            <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                                            <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                                            <option value="other" {{ old('gender', $member->gender) == 'other' ? 'selected' : '' }}>Khác</option>
                                        </select>
                                        <label>Giới tính</label>
                                    </div>
                                </div>

                                {{-- THỨ TỰ --}}
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="number"
                                            class="form-control"
                                            name="order"
                                            value="{{ old('order', $member->order) }}">
                                        <label>Thứ tự</label>
                                    </div>
                                </div>

                                {{-- ĐỜI --}}
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="number"
                                            class="form-control"
                                            name="generation"
                                            value="{{ old('generation', $member->generation) }}">
                                        <label>Đời</label>
                                    </div>
                                </div>

                                {{-- TIỂU SỬ --}}
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control"
                                            name="biography"
                                            style="height:200px">{{ old('biography', $member->biography) }}</textarea>
                                        <label>Tiểu sử</label>
                                    </div>
                                </div>

                                {{-- NGÀY MẤT --}}
                                <div class="col-12">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            id="has_death_date"
                                            onchange="toggleDeathDate()"
                                            {{ old('death_date', $member->death_date) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="has_death_date">
                                            Đã mất
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12"
                                     id="death-date-wrapper"
                                     style="{{ old('death_date', $member->death_date) ? '' : 'display:none' }}">
                                    <div class="form-floating">
                                        <input type="date"
                                            class="form-control"
                                            name="death_date"
                                            value="{{ old('death_date', $member->death_date) }}">
                                        <label>Ngày mất</label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- ========= COL 3 : AVATAR ========= --}}
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-3">Ảnh</p>

                                    <img id="preview-avatar"
                                        src="{{ $member->avatar
                                            ? $member->avatar
                                            : asset('assets/img/default-avatar.png') }}"
                                        class="img-fluid rounded"
                                        style="cursor:pointer">

                                    <input type="file"
                                        id="avatar-input"
                                        class="d-none"
                                        name="avatar"
                                        accept="image/*"
                                        onchange="previewAvatar(this)">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">
                            Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Cập nhật thành viên
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
