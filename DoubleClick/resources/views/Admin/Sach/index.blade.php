@extends('Admin.layout')
{{-- @section('title', $title) --}}
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/dssach.css') }}">

@endsection
@section('content')
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-primary"><i class="fas fa-plus"></i> Thêm sách</button>
        <div class="input-group" style="width: 300px;">
            <input type="text" class="form-control" placeholder="Tìm kiếm sách...">
            <button class="btn btn-secondary" type="button">Tìm kiếm</button>
        </div>
    </div>
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="#">Các sách đang bán</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Sách đã ngưng bán</a>
        </li>
    </ul>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0 text-primary">Các sách đang bán</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sách</th>
                            <th>Tên tác giả</th>
                            <th>Hình ảnh</th>
                            <th>Giá bán</th>
                            <th>Số lượng tồn</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Sách 1</td>
                            <td>Tác giả 1</td>
                            <td><a href="#">1.png</a></td>
                            <td>1000</td>
                            <td>1000</td>
                            <td><span class="badge bg-warning text-dark">Hết hàng</span></td>
                            <td>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Xóa</button>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                                <button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Xem chi tiết</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Sách 2</td>
                            <td>Tác giả 2</td>
                            <td><a href="#">2.png</a></td>
                            <td>1000</td>
                            <td>1000</td>
                            <td><span class="badge bg-success">Còn hàng</span></td>
                            <td>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Xóa</button>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                                <button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Xem chi tiết</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Sách 3</td>
                            <td>Tác giả 3</td>
                            <td><a href="#">3.png</a></td>
                            <td>1000</td>
                            <td>1000</td>
                            <td><span class="badge bg-success">Còn hàng</span></td>
                            <td>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Xóa</button>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                                <button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Xem chi tiết</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Sách 4</td>
                            <td>Tác giả 4</td>
                            <td><a href="#">4.png</a></td>
                            <td>1000</td>
                            <td>1000</td>
                            <td><span class="badge bg-success">Còn hàng</span></td>
                            <td>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Xóa</button>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                                <button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Xem chi tiết</button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Sách 5</td>
                            <td>Tác giả 5</td>
                            <td><a href="#">5.png</a></td>
                            <td>1000</td>
                            <td>1000</td>
                            <td><span class="badge bg-warning text-dark">Hết hàng</span></td>
                            <td>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Xóa</button>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                                <button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Xem chi tiết</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end align-items-center mt-3">
        <nav>
            <ul class="pagination mb-0">
                <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">Sau</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection
