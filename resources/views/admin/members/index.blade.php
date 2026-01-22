@extends('layouts.admin')

@section('title', 'Danh sách thành viên - Gia Phả')

@section('content')
    <h1 class="mt-4">Danh sách thành viên</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Gia phả</a>
        </li>
        <li class="breadcrumb-item active">Danh sách thành viên</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách thành viên
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Thứ tự</th>
                        <th>Đời</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>
                                <img src="{{ $member->avatar
                                    ? $member->avatar
                                    : asset('assets/img/default-avatar.png') }}"
                                    width="50"
                                    alt="Avatar">
                            </td>

                            <td>{{ $member->full_name }}</td>
                            <td>{{ optional($member->birth_date)->format('d/m/Y') }}</td>
                            <td>{{ $member->gender == 'male' ? 'Nam' : 'Nữ' }}</td>
                            <td>{{ $member->order }}</td>
                            <td>{{ $member->generation }}</td>

                            {{-- ACTIONS --}}
                            <td>
                                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-success">
                                    Chỉnh sửa
                                </a>

                                <form method="POST" action="{{ route('members.delete', $member->id) }}"style="display:inline-block" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')">
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