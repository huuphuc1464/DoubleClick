@extends('Admin.layout')

@section('title', 'Cập nhật trạng thái')

@section('subtitle', 'Liên hệ')

@section('content')
<div class="container-fluid text-center" style="background-color: #d3d3d3; padding: 20px;">
    <h3>Cập nhật trạng thái</h3>
    <p id="current-status"><strong>Trạng thái hiện tại:</strong>
        <span style="color:
        @if($contact->TrangThai == 1) #28a745
        @elseif($contact->TrangThai == 0) #ffc107
        @else #dc3545
        @endif;">
            @if($contact->TrangThai == 1)
                Đã xử lý
            @elseif($contact->TrangThai == 0)
                Đang xử lý
            @else
                Chưa xử lý
            @endif
        </span>
    </p>


    <div class="d-flex justify-content-center mt-4">
        <form action="{{ route('contacts.update-status-action', ['id' => $contact->MaLienHe]) }}" method="POST"
            style="display: inline-block;">
            @csrf
            <input type="hidden" name="status" value="Đã xử lý">
            <button type="submit" class="btn btn-success " style="margin: 0 10px; width: 110px; " onclick="confirmStatusChange('form-status-danger')">Đã xử lý</button>
        </form>

        <form action="{{ route('contacts.update-status-action', ['id' => $contact->MaLienHe]) }}" method="POST"
            style="display: inline-block;">
            @csrf
            <input type="hidden" name="status" value="Đang xử lý">
            <button type="submit" class="btn btn-warning" style="margin: 0 10px; width: 110px;" onclick="confirmStatusChange('form-status-danger')">Đang xử lý</button>
        </form>

        <form action="{{ route('contacts.update-status-action', ['id' => $contact->MaLienHe]) }}" method="POST"
            style="display: inline-block;">
            @csrf
            <input type="hidden" name="status" value="Chưa xử lý">
            <button type="submit" class="btn btn-danger" style="margin: 0 10px; width: 110px;" onclick="confirmStatusChange('form-status-danger')">Chưa xử lý</button>
        </form>

    </div>

    <script>
        function confirmStatusChange(formId) {
            if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái không?')) {
                document.getElementById(formId).submit();
            }
        }
    </script>

    @if ($errors->has('TrangThai'))
        <div class="alert alert-danger mt-2">
            {{ $errors->first('TrangThai') }}
        </div>
    @endif


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
