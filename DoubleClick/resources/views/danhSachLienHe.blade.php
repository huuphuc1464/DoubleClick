@extends('layouts.admin')

@section('title', 'Thông tin liên hệ khách hàng')

@section('subtitle', 'Liên hệ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Danh sách liên hệ</h4>
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
                                    <td style="border: 2px solid black;">{{ $contact->id }}</td>
                                    <td style="border: 2px solid black;">{{ Str::limit($contact->name, 20, '...')}}</td>
                                    <td style="border: 2px solid black;">{{ Str::limit($contact->email, 20, '...') }}</td>
                                    <td style="border: 2px solid black;">{{ $contact->phone }}</td>
                                    <td style="border: 2px solid black;">{{ Str::limit($contact->message, 50, '...') }}</td>
                                    <td style="border: 2px solid black; text-align: center;">
                @if ($contact->status == 'Đã xử lý')
                    <span class="badge badge-success">{{ $contact->status }}</span>
                @elseif ($contact->status == 'Đang xử lý')
                    <span class="badge badge-warning">{{ $contact->status }}</span>
                @else
                    <span class="badge badge-danger">{{ $contact->status }}</span>
                @endif
            </td>
                                    <td style="border: 2px solid black; white-space: nowrap;">
                                        <!-- Nút Xem -->
                                        <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info btn-sm">Xem</a>

                                        <!-- Nút Cập Nhật -->
                                        <a href="{{ route('contacts.update-status', $contact->id) }}" class="btn btn-warning btn-sm">Cập Nhật</a>


                                        <!-- Nút Xóa -->
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#viewModal{{ $contact->id }}">Xóa</button>
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
