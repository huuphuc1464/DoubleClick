@extends('Profile.sublayout')

@section('css_sub')
<link rel="stylesheet" href="{{ asset('css/dsdonhang.css') }}">
@endsection
@section('title')
    {{ $title }}
@endsection
@section('content_sub')
<div class="mt-4">
    <h2>
        Đơn hàng của tôi
    </h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request('status') === null ? 'active' : '' }}" href="{{ route('profile.dsdonhang', ['status' => null]) }}">
                Tất cả đơn
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === '0' ? 'active' : '' }}" href="{{ route('profile.dsdonhang', ['status' => '0']) }}">
                Chờ thanh toán
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === '1' ? 'active' : '' }}" href="{{ route('profile.dsdonhang', ['status' => '1']) }}">
                Đang xử lý
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === '2' ? 'active' : '' }}" href="{{ route('profile.dsdonhang', ['status' => '2']) }}">
                Đang vận chuyển
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === '3' ? 'active' : '' }}" href="{{ route('profile.dsdonhang', ['status' => '3']) }}">
                Đã giao
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === '4' ? 'active' : '' }}" href="{{ route('profile.dsdonhang', ['status' => '4']) }}">
                Đã huỷ
            </a>
        </li>
    </ul>

    <div class="mt-3">
        <form action="{{ route('profile.dsdonhang') }}" method="get" id="searchForm">
            <div class="input-group">
                <input class="form-control search-bar" placeholder="Tìm đơn hàng theo Mã đơn hàng hoặc Tên sách" type="text" name="search" value="{{ request('search') }}" id="searchInput" />

                @if(request('status') !== null)
                <!-- Chỉ thêm status khi có giá trị -->
                <input type="hidden" name="status" value="{{ request('status') }}" />
                @endif
                <button class="btn btn-primary" type="submit" id="searchButton">
                    Tìm đơn hàng
                </button>
            </div>
        </form>
    </div>

    <div class="mt-4">
        @forelse ($groupedOrders as $maHD => $orders)
        <div class="order-group">
            <h4>Mã hóa đơn: #{{ $maHD }}</h4>

            {{-- @php
            // Tính tổng tiền cho nhóm hóa đơn
            $totalAmount = $orders->sum('TongTien');
            @endphp --}}

            <div class="order-status">
                @if($orders->first()->TrangThai == '3')
                <i class="fas fa-check-circle text-success"></i> Đã giao
                @elseif($orders->first()->TrangThai == '1')
                <i class="fas fa-cogs text-warning"></i> Đang xử lý
                @elseif($orders->first()->TrangThai == '0')
                <i class="fas fa-clock text-info"></i> Chờ thanh toán
                @elseif($orders->first()->TrangThai == '2')
                <i class="fas fa-truck text-primary"></i> Đang vận chuyển
                @elseif($orders->first()->TrangThai == '4')
                <i class="fas fa-times-circle text-danger"></i> Đã hủy
                @else
                <i class="fas fa-question-circle text-muted"></i> Trạng thái không xác định
                @endif
            </div>

            @foreach($orders as $order)
            <div class="order-item mt-3 d-flex align-items-center">
                <img alt="Book cover" height="80" src="https://storage.googleapis.com/a1aa/image/TfwcXIeKESrJlUwj8IjeDQ9hzYxSmzhcJqft46qowUv8IqefE.jpg" width="60" />

                <div class="order-info flex-grow-1 ms-3">
                    <p class="order-title">
                        {{ $order->TenSach }}
                    </p>
                    <p class="order-price">
                        {{ number_format($order->DonGia, 0, ',', '.') }} ₫
                    </p>
                    <p class="order-quanlity">
                        x {{ $order->SLMua }}
                    </p>
                </div>

                @if ($order->TrangThai == '3')
                @if (!$order->DaDanhGia)
                <a href="{{ route('profile.danhgiasach', ['id' => $order->MaSach]) }}" class="btn btn-outline-danger">Đánh giá</a>
                @else
                <span class="text-success">Đã đánh giá</span>
                @endif
                @endif
            </div>
            @endforeach

            <div class="d-flex justify-content-end mt-3">
                <p class="me-3 pt-2">
                    Tổng tiền:
                    <strong>
                        {{ number_format($order->TongTien, 0, ',', '.') }} ₫
                    </strong>
                </p>
                <button class="btn btn-outline-primary me-2">
                    Mua lại
                </button>
                <a href="{{ route('profile.dsdonhang.chitiet', ['id' => $order->MaHD]) }}" class="btn btn-outline-primary me-2">
                    Xem chi tiết
                </a>
                @if($orders->first()->TrangThai == '0' || $orders->first()->TrangThai == '1')
                <a href="{{ route('profile.dsdonhang.huy', ['id' => $order->MaHD]) }}" class="btn btn-outline-danger"> Hủy đơn hàng</a>
                @endif
                @if($orders->first()->TrangThai == '4')
                <a href="{{ route('profile.dsdonhang.chitiethuydon', ['id' => $order->MaHD]) }}" class="btn btn-outline-danger"> Chi tiết hủy đơn</a>
                @endif
            </div>
        </div>
        <hr>
        @empty
        <p>Không có đơn hàng phù hợp.</p>
        @endforelse
    </div>
</div>

<script>
    // Xử lý sự kiện submit form
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        var searchValue = document.getElementById('searchInput').value.trim();
        if (searchValue === '') {
            document.getElementById('searchInput').name = '';
        } else {
            document.getElementById('searchInput').name = 'search';
        }
    });

</script>
@endsection
