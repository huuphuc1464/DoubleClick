@extends('Admin.layout')

@section('title', 'Chi tiết liên hệ')

@section('content')
<div class="container">
    <h4>Thông tin chi tiết</h4>
    <p><strong>ID:</strong> {{ $contact->MaLienHe }}</p>
    <p><strong>Họ Tên:</strong> {{ $contact->HoTen }}</p>
    <p><strong>Email:</strong> {{ $contact->Email }}</p>
    <p><strong>SĐT:</strong> {{ $contact->SDT }}</p>
    <p><strong>Nội dung:</strong> {{ $contact->NoiDung }}</p>
    <p><strong>Trạng thái:</strong>
        @if ($contact->TrangThai == 1)
            <span class="badge bg-success">Đã xử lý</span>
        @elseif ($contact->TrangThai == 0)
            <span class="badge bg-warning">Đang xử lý</span>
        @else
            <span class="badge bg-danger">Chưa xử lý</span>
        @endif
    </p>
    <a href="{{ route('contacts.index') }}" class="btn btn-primary">Quay lại</a>
</div>
@endsection
