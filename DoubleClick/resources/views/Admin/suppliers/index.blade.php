@extends('Admin.layout')

@section('title', 'Danh sách nhà cung cấp')

@section('content')
    <!-- Tìm kiếm và Thêm nhà cung cấp -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <a href="" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm nhà cung cấp
            </a>
        </div>
        <div class="col-lg-6">
            <form class="form-inline float-right">
                <input type="text" class="form-control" placeholder="Tìm kiếm nhà cung cấp..." id="search">
                <button type="submit" class="btn btn-secondary ml-2">Tìm kiếm</button>
            </form>
        </div>
    </div>

    <!-- Tabs: Nhà cung cấp hoạt động và đã xóa -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="active-suppliers-tab" data-bs-toggle="tab" href="#active-suppliers"
                role="tab" aria-controls="active-suppliers" aria-selected="true">Nhà cung cấp hoạt động</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="deleted-suppliers-tab" data-bs-toggle="tab" href="#deleted-suppliers" role="tab"
                aria-controls="deleted-suppliers" aria-selected="false">Các nhà cung cấp đã xóa</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!-- Tab: Nhà cung cấp hoạt động -->
        <div class="tab-pane fade show active" id="active-suppliers" role="tabpanel" aria-labelledby="active-suppliers-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách nhà cung cấp hoạt động</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên nhà cung cấp</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dữ liệu giả -->
                                @for ($i = 1; $i <= 5; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>Nhà cung cấp {{ $i }}</td>
                                        <td>Địa chỉ {{ $i }}</td>
                                        <td>email{{ $i }}@example.com</td>
                                        <td>012345678{{ $i }}</td>
                                        <td>
                                            @if ($i % 2 == 0)
                                                <span class="badge badge-success">Hoạt động</span>
                                            @else
                                                <span class="badge badge-danger">Không hoạt động</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                            <form action="#" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Các nhà cung cấp đã xóa -->
        <div class="tab-pane fade" id="deleted-suppliers" role="tabpanel" aria-labelledby="deleted-suppliers-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Các nhà cung cấp đã xóa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên nhà cung cấp</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dữ liệu giả cho nhà cung cấp đã xóa -->
                                @for ($i = 6; $i <= 10; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>Nhà cung cấp {{ $i }}</td>
                                        <td>Địa chỉ {{ $i }}</td>
                                        <td>email{{ $i }}@example.com</td>
                                        <td>012345678{{ $i }}</td>
                                        <td>
                                            <span class="badge badge-warning">Đã xóa mềm</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm">
                                                <i class="fas fa-undo"></i> Khôi phục
                                            </a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Phân trang -->
    <div class="float-right">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item disabled">
                    <span class="page-link">Trước</span>
                </li>
                <li class="page-item active"><span class="page-link">1</span></li>
                <li class="page-item">
                    <a class="page-link" href="#">Sau</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
