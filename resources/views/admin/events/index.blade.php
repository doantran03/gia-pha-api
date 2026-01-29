@extends('layouts.admin')

@section('title', 'Danh sách sự kiện - Gia Phả')

@section('content')
    <h1 class="mt-4">Danh sách sự kiện</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Gia phả</a>
        </li>
        <li class="breadcrumb-item active">Danh sách sự kiện</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách sự kiện
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tiêu đề</th>
                        <th>Liên kết</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Tất cả ngày</th>
                        <th>Màu nền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->link }}</td>
                            <td>{{ optional($event->start)->format('d/m/Y H:i a') }}</td>
                            <td>{{ optional($event->end)->format('d/m/Y H:i a') }}</td>
                            <td>{{ $event->all_day ? 'Có' : 'Không' }}</td>
                            <td>{{ $event->background_color }}</td>
                            {{-- ACTIONS --}}
                            <td>
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-success">
                                    Chỉnh sửa
                                </a>

                                <form method="POST" action="{{ route('events.delete', $event->id) }}"style="display:inline-block" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')">
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