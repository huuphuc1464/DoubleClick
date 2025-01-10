@extends('Admin.layout')
{{-- @section('subtitle', $subtitle) --}}
@section('title')
Danh sách sách
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/dssach.css') }}">
@endsection
@section('content')
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.sach.insert') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm sách</a>
        <form action="{{ route('admin.sach') }}" method="GET" class="input-group" style="width: 300px;">
            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sách..." value="{{ request()->search }}">
            <button class="btn btn-secondary" type="submit">Tìm kiếm</button>
        </form>
    </div>
    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="dang-ban-tab" data-bs-toggle="tab" href="#dang-ban" role="tab" aria-controls="dang-ban" aria-selected="true">Các sách đang bán</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ngung-ban-books-tab" data-bs-toggle="tab" href="#ngung-ban-books" role="tab" aria-controls="ngung-ban-books" aria-selected="false">Sách đã ngưng bán</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="sap-het-hang-tab" data-bs-toggle="tab" href="#sap-het-hang" role="tab" aria-controls="sap-het-hang" aria-selected="false">Sách sắp hết hàng</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="dang-ban" role="tabpanel" aria-labelledby="dang-ban-tab">
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
                                    <th style="width: 220px;">Tên sách</th>
                                    <th style="width: 140px;">Tên tác giả</th>
                                    <th style="width: 140px;">Thể loại</th>
                                    <th>Giá bán</th>
                                    <th>Số lượng tồn</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sach as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="#" class="image-link">{{ $item->TenSach }}</a>
                                        <div class="image-preview">
                                            <img src="{{ asset('img/Sach/'.$item->AnhDaiDien) }}" alt="Image">
                                        </div>
                                    </td>
                                    <td>{{ $item->TenTG }}</td>
                                    <td>{{ $item->TenLoai }}</td>
                                    <td>{{ number_format($item->GiaBan, 0, '.', ',') }}</td>
                                    <td>{{ number_format($item->SoLuongTon) }}</td>
                                    @if($item->SoLuongTon < 10 && $item->SoLuongTon > 0)
                                        <td><span class="badge bg-warning text-dark">Sắp hết hàng</span></td>
                                        @elseif($item->SoLuongTon == 0)
                                        <td><span class="badge bg-danger">Hết hàng</span></td>
                                        @else
                                        <td><span class="badge bg-success">Còn hàng</span></td>
                                        @endif
                                        <td>
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></button>
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                @if ($sach->lastPage() > 1)
                <ul class="pagination">
                    <!-- Trang đầu -->
                    <li class="page-item {{ ($sach->currentPage() == 1) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $sach->url(1) }}" aria-label="First">Trang đầu</a>
                    </li>

                    <!-- Trang trước -->
                    @if ($sach->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $sach->url($sach->currentPage() - 1) }}">
                            {{ $sach->currentPage() - 1 }}
                        </a>
                    </li>
                    @endif

                    <!-- Trang hiện tại -->
                    <li class="page-item active">
                        <a class="page-link" href="#">{{ $sach->currentPage() }}</a>
                    </li>

                    <!-- Trang sau -->
                    @if ($sach->currentPage() < $sach->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ $sach->url($sach->currentPage() + 1) }}">
                                {{ $sach->currentPage() + 1 }}
                            </a>
                        </li>
                        @endif

                        <!-- Trang cuối -->
                        <li class="page-item {{ ($sach->currentPage() == $sach->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $sach->url($sach->lastPage()) }}" aria-label="Last">Trang cuối</a>
                        </li>
                </ul>
                @endif
            </div>
        </div>

        <!-- Nội dung cho "Sách đã ngưng bán" -->
        <div class="tab-pane fade" id="ngung-ban-books" role="tabpanel" aria-labelledby="ngung-ban-books-tab">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">Các sách đã ngưng bán</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 220px;">Tên sách</th>
                                    <th style="width: 140px;">Tên tác giả</th>
                                    <th style="width: 140px;">Thể loại</th>
                                    <th>Giá bán</th>
                                    <th>Số lượng tồn</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ngungban as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="#" class="image-link">{{ $item->TenSach }}</a>
                                        <div class="image-preview">
                                            <img src="{{ asset('img/Sach/'.$item->AnhDaiDien) }}" alt="Image">
                                        </div>
                                    </td>
                                    <td>{{ $item->TenTG }}</td>
                                    <td>{{ $item->TenLoai }}</td>
                                    <td>{{ number_format($item->GiaBan, 0, '.', ',') }}</td>
                                    <td>{{ number_format($item->SoLuongTon) }}</td>
                                    <td><span class="badge bg-danger">Ngưng bán</span></td>
                                    <td>
                                        <button class="btn btn-info btn-sm"><i class="fas fa-undo"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                @if ($ngungban->lastPage() > 1)
                <ul class="pagination">
                    <!-- Trang đầu -->
                    <li class="page-item {{ ($ngungban->currentPage() == 1) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $ngungban->url(1) }}" aria-label="First">Trang đầu</a>
                    </li>

                    <!-- Trang trước -->
                    @if ($ngungban->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $ngungban->url($ngungban->currentPage() - 1) }}">
                            {{ $ngungban->currentPage() - 1 }}
                        </a>
                    </li>
                    @endif

                    <!-- Trang hiện tại -->
                    <li class="page-item active">
                        <a class="page-link" href="#">{{ $ngungban->currentPage() }}</a>
                    </li>

                    <!-- Trang sau -->
                    @if ($ngungban->currentPage() < $ngungban->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ $ngungban->url($ngungban->currentPage() + 1) }}">
                                {{ $ngungban->currentPage() + 1 }}
                            </a>
                        </li>
                        @endif

                        <!-- Trang cuối -->
                        <li class="page-item {{ ($ngungban->currentPage() == $ngungban->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $ngungban->url($ngungban->lastPage()) }}" aria-label="Last">Trang cuối</a>
                        </li>
                </ul>
                @endif
            </div>
        </div>

        <!-- Nội dung cho "Sách sắp hết hàng" -->
        <div class="tab-pane fade" id="sap-het-hang" role="tabpanel" aria-labelledby="sap-het-hang-tab">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-primary">Các sách sắp hết hàng</h5>
                    <button class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Xuất file excel</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 220px;">Tên sách</th>
                                    <th style="width: 140px;">Tên tác giả</th>
                                    <th style="width: 140px;">Thể loại</th>
                                    <th>Giá bán</th>
                                    <th>Số lượng tồn</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hethang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="#" class="image-link">{{ $item->TenSach }}</a>
                                        <div class="image-preview">
                                            <img src="{{ asset('img/Sach/'.$item->AnhDaiDien) }}" alt="Image">
                                        </div>
                                    </td>
                                    <td>{{ $item->TenTG }}</td>
                                    <td>{{ $item->TenLoai }}</td>
                                    <td>{{ number_format($item->GiaBan, 0, '.', ',') }}</td>
                                    <td>{{ number_format($item->SoLuongTon) }}</td>
                                    @if($item->SoLuongTon < 10 && $item->SoLuongTon > 0)
                                        <td><span class="badge bg-warning text-dark">Sắp hết hàng</span></td>
                                        @elseif($item->SoLuongTon == 0)
                                        <td><span class="badge bg-danger">Hết hàng</span></td>
                                        @endif
                                        <td>
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></button>
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                @if ($hethang->lastPage() > 1)
                <ul class="pagination">
                    <!-- Trang đầu -->
                    <li class="page-item {{ ($hethang->currentPage() == 1) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $hethang->url(1) }}" aria-label="First">Trang đầu</a>
                    </li>

                    <!-- Trang trước -->
                    @if ($hethang->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $hethang->url($hethang->currentPage() - 1) }}">
                            {{ $hethang->currentPage() - 1 }}
                        </a>
                    </li>
                    @endif

                    <!-- Trang hiện tại -->
                    <li class="page-item active">
                        <a class="page-link" href="#">{{ $hethang->currentPage() }}</a>
                    </li>

                    <!-- Trang sau -->
                    @if ($hethang->currentPage() < $hethang->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ $hethang->url($hethang->currentPage() + 1) }}">
                                {{ $hethang->currentPage() + 1 }}
                            </a>
                        </li>
                        @endif

                        <!-- Trang cuối -->
                        <li class="page-item {{ ($hethang->currentPage() == $hethang->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $hethang->url($hethang->lastPage()) }}" aria-label="Last">Trang cuối</a>
                        </li>
                </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (bao gồm Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gán giá trị tab hiện tại vào hidden input khi người dùng nhấn nút tìm kiếm
            const searchForm = document.getElementById('searchForm');
            const currentTab = document.querySelector('.nav-link.active'); // Lấy tab hiện tại

            if (currentTab) {
                document.getElementById('currentTab').value = currentTab.id; // Gán id của tab vào hidden input
            }

            // Gửi form khi tìm kiếm
            searchForm.addEventListener('submit', function() {
                // Khi người dùng nhấn tìm kiếm, form sẽ gửi giá trị tab hiện tại
                const activeTab = document.querySelector('.nav-link.active');
                if (activeTab) {
                    document.getElementById('currentTab').value = activeTab.id;
                }
            });
        });

    </script>


</div>
@endsection
