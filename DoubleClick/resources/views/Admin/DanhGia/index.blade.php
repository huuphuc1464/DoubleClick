@extends('Admin.layout')
{{-- @section('title', $title) --}}
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/admindanhgia.css') }}">
@endsection
@section('content')
<div class="container mt-5 mb-5">
    <div class="content-container">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="text-primary">Đánh giá sách</h5>
            <div class="d-flex">
                <div class="input-group me-2" style="max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Tìm kiếm tên sách ...">
                    <button class="btn btn-secondary" type="button">Tìm kiếm</button>
                </div>
                <div class="input-group" style="max-width: 150px;">
                    <select class="form-select">
                        <option value="">Lọc theo số sao</option>
                        <option value="1">1 sao</option>
                        <option value="2">2 sao</option>
                        <option value="3">3 sao</option>
                        <option value="4">4 sao</option>
                        <option value="5">5 sao</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sách</th>
                        <th>Tên khách hàng</th>
                        <th>Số sao</th>
                        <th>Bình luận</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Sách 1</td>
                        <td>Khách hàng A</td>
                        <td>1</td>
                        <td>Bình luận 1</td>
                        <td><button class="btn btn-delete"><i class="fas fa-trash-alt"></i> Xóa</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sách 2</td>
                        <td>Khách hàng B</td>
                        <td>1</td>
                        <td>Bình luận 2</td>
                        <td><button class="btn btn-delete"><i class="fas fa-trash-alt"></i> Xóa</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Sách 3</td>
                        <td>Khách hàng C</td>
                        <td>2</td>
                        <td>Bình luận 3</td>
                        <td><button class="btn btn-delete"><i class="fas fa-trash-alt"></i> Xóa</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Sách 4</td>
                        <td>Khách hàng D</td>
                        <td>3</td>
                        <td>Bình luận 4</td>
                        <td><button class="btn btn-delete"><i class="fas fa-trash-alt"></i> Xóa</button></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Sách 5</td>
                        <td>Khách hàng E</td>
                        <td>3</td>
                        <td>Bình luận 5</td>
                        <td><button class="btn btn-delete"><i class="fas fa-trash-alt"></i> Xóa</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
            <nav>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">Sau</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endsection
