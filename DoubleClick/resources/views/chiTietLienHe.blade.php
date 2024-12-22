@extends('layouts.admin')

@section('title', 'Chi tiết liên hệ')

@section('subtitle', 'Chi tiết liên hệ')

@section('content')
<div class="container">
    <h4>Thông tin chi tiết</h4>
    <p><strong>ID:</strong> {{ $contact->id }}</p>
    <p><strong>Tên người dùng:</strong> {{ $contact->name }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>SĐT:</strong> {{ $contact->phone }}</p>
    <p><strong>Nội dung:</strong> {{ $contact->message }}</p>
    <p><strong>Trạng thái:</strong>
                    @if ($contact->status == 'Đã xử lý')
                        <span class="badge badge-success">{{ $contact->status }}</span>
                    @elseif ($contact->status == 'Đang xử lý')
                        <span class="badge badge-warning">{{ $contact->status }}</span>
                    @else
                        <span class="badge badge-danger">{{ $contact->status }}</span>
                    @endif
                </p>
    <a href="{{ route('contacts.index') }}" class="btn btn-primary">Quay lại</a>
</div>
@endsection
