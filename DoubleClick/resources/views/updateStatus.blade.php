@extends('layouts.admin')

@section('title', 'Cập nhật trạng thái')

@section('subtitle', 'Liên hệ')

@section('content')
<div class="container-fluid text-center" style="background-color: #d3d3d3; padding: 20px;">
    <h3>Cập nhật trạng thái</h3>
    <p id="current-status"><strong>Trạng thái hiện tại:</strong>
        <span style="color:
            @if($contact->status == 'Đã xử lý') #28a745
            @elseif($contact->status == 'Đang xử lý') #ffc107
            @else #dc3545
            @endif;">
            {{ $contact->status ?? 'Chưa xử lý' }}
        </span>
    </p>

    <div class="d-flex justify-content-center mt-4">
        <!-- Nút Đã xử lý -->
        <form action="{{ route('contacts.update-status-action', ['id' => $contact->id]) }}" method="POST" style="display: inline-block;">
            @csrf
            <input type="hidden" name="status" value="Đã xử lý">
            <button type="submit" class="btn btn-success" style="margin: 0 10px;">Đã xử lý</button>
        </form>

        <!-- Nút Đang xử lý -->
        <form action="{{ route('contacts.update-status-action', ['id' => $contact->id]) }}" method="POST" style="display: inline-block;">
            @csrf
            <input type="hidden" name="status" value="Đang xử lý">
            <button type="submit" class="btn btn-warning" style="margin: 0 10px;">Đang xử lý</button>
        </form>

        <!-- Nút Chưa xử lý -->
        <form action="{{ route('contacts.update-status-action', ['id' => $contact->id]) }}" method="POST" style="display: inline-block;">
            @csrf
            <input type="hidden" name="status" value="Chưa xử lý">
            <button type="submit" class="btn btn-danger" style="margin: 0 10px;">Chưa xử lý</button>
        </form>
    </div>

    <!-- Nút Quay lại -->
    <div class="mt-4">
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    @if (session('success'))
    <div class="alert alert-success mt-2" style="margin-top: 10px;">
        {{ session('success') }}
    </div>
@endif


</div>
@endsection
