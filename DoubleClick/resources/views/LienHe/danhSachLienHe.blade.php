
@extends('Admin.layout')

@section('title', 'Thông tin liên hệ khách hàng')
@section('subtitle', 'Liên hệ')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Danh sách liên hệ</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100" style="border: 2px solid black;">
                            <thead style="background-color: #d3d3d3; color: black; text-align: center; border: 2px solid black;">
                                <tr>
                                    <th style="border: 2px solid black;">ID</th>
                                    <th style="border: 2px solid black;">Họ Tên</th>
                                    <th style="border: 2px solid black;">Email</th>
                                    <th style="border: 2px solid black;">SĐT</th>
                                    <th style="border: 2px solid black;">Nội dung</th>
                                    <th style="border: 2px solid black;">Trạng thái</th>
                                    <th style="border: 2px solid black;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                <tr>
                                    <td style="border: 2px solid black;">{{ $contact->MaLienHe }}</td>
                                    <td style="border: 2px solid black;">{{ $contact->HoTen }}</td>
                                    <td style="border: 2px solid black;">{{ $contact->Email }}</td>
                                    <td style="border: 2px solid black;">{{ $contact->SDT }}</td>
                                    <td style="border: 2px solid black;">{{ Str::limit($contact->NoiDung, 30) }}</td>
                                    <td style="border: 2px solid black;">
                                        @if ($contact->TrangThai == 1)
                                            <span class="badge bg-success">Đã xử lý</span>
                                        @elseif ($contact->TrangThai == 0)
                                            <span class="badge bg-warning">Đang xử lý</span>
                                        @else
                                            <span class="badge bg-danger">Chưa xử lý</span>
                                        @endif
                                    </td>

                                    <td style="border: 2px solid black; white-space: nowrap;">
                                        <a href="{{ route('contacts.show', $contact->MaLienHe) }}" class="btn btn-info btn-sm">Xem</a>
                                        <a href="{{ route('contacts.update-status', $contact->MaLienHe) }}" class="btn btn-warning btn-sm">Cập nhật</a>
                                        <form action="{{ route('contacts.destroy', $contact->MaLienHe) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa liên hệ này?')">Xóa</button>
    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
