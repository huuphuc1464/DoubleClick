@extends('Admin.layout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
<div class="container-fluid my-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row">
                <div class="header" style="flex: 0 0 25%; background-color: #f8f9fa; padding: 15px;">
                    <div class="d-none d-md-block">
                        <a href="{{ route('quanlynhanvien.index') }}" class="btn btn-secondary w-100 mb-2">Nhân viên</a>
                        <a href="{{ route('quanlynhanvien.create') }}" class="btn btn-primary w-100 mb-2">Thêm Nhân Viên</a>
                        <a href="{{ route('quanlynhanvien.create') }}" class="btn btn-danger w-100 mb-2">Nhân viên đã xóa</a>
                    </div>
                    <div class="d-block d-md-none">
                        <a href="{{ route('quanlynhanvien.index') }}" class="btn btn-secondary w-100 mb-2">Nhân viên</a>
                        <a href="{{ route('quanlynhanvien.create') }}" class="btn btn-primary w-100 mb-2"><i class="fa fa-user-plus"> Thêm nhân viên</i></a>
                        <a href="{{ route('quanlynhanvien.create') }}" class="btn btn-danger w-100 mb-2"><i class="fa fa-trash"></i> Nhân viên đã xóa</a>
                    </div>
                </div>
                <div class="subcontent" style="flex: 1 0 75%; padding: 15px;">
                    @yield('subcontent')
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<Style>
    /* Styles chung */
    .container-fluid {
        padding: 0;
        width: 1200px; /* Để chiều rộng tự động điều chỉnh */
    }

    .list-group-item, .list-group-item span {
        font-size: 12px;
    }
    .list-group-item h4 {
        font-size: 14px;
    }
    .dropdown-menu {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-action {
        gap: 10px;
    }

    .btn-action a {
        font-size: 20px;
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .container-fluid {
            width: 100%; /* Đảm bảo container chiếm toàn bộ chiều rộng */
            padding: 0 15px; /* Thêm khoảng cách bên trong */
        }

        .btn-action a {
            font-size: 16px; /* Giảm kích thước biểu tượng */
            width: 30px;
            height: 30px;
        }
        .list-group-item, .list-group-item h4 {
            font-size: 11px; /* Giảm kích thước văn bản cho màn hình nhỏ */
        }
    }

    @media (max-width: 480px) {
        .btn-action a {
            font-size: 14px; /* Giảm thêm kích thước biểu tượng */
            width: 25px;
            height: 25px;
        }

        .list-group-item, .list-group-item h4 {
            font-size: 10px; /* Giảm kích thước văn bản để phù hợp màn hình nhỏ hơn */
        }
    }
</Style>
@endsection
