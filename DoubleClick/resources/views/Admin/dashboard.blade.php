<!-- Tổng Quan -->
<div class="row">
    <!-- Tổng số sách -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng số sách</div>
                        {{-- Hiển thị tổng số sách --}}
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tongSoSach }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tổng số đơn hàng -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng số đơn hàng</div>
                        {{-- Hiển thị tổng số đơn hàng --}}
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tongSoDonHang }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-receipt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tổng doanh thu -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng doanh thu</div>
                        {{-- Hiển thị tổng doanh thu --}}
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tongDoanhThu }}VND</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tổng số người dùng -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tổng số người dùng</div>
                        {{-- Tổng số người dùng --}}
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tongSoNguoiDung }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Biểu đồ doanh thu -->
<div class="row">
    <div class="col-xl-6 col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Biểu đồ doanh thu theo tháng</h6>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" width="100%" height="100"></canvas>
                <!-- Giảm chiều cao xuống còn 100px -->
            </div>
        </div>
    </div>

    <!-- Biểu đồ đơn hàng -->
    <div class="col-xl-6 col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thống kê đơn hàng theo tháng</h6>
            </div>
            <div class="card-body">
                <canvas id="orderChart" width="100%" height="100"></canvas> <!-- Giảm chiều cao xuống còn 100px -->
            </div>
        </div>
    </div>
</div>

<!-- CDN Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js từ CDN -->

<script>
    // Biểu đồ doanh thu theo tháng
    fetch('/api/revenue-by-month')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => `Tháng ${item.month}`);
            const revenues = data.map(item => item.revenue);

            const ctx = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Doanh thu (VND)',
                        data: revenues,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString() + ' VND';
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Lỗi khi tải dữ liệu doanh thu:', error));


    // Biểu đồ đơn hàng theo tháng
    fetch('/api/orders-by-month')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => `Tháng ${item.month}`);
            const orders = data.map(item => item.orders);

            const orderCtx = document.getElementById('orderChart').getContext('2d');
            new Chart(orderCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Đơn hàng',
                        data: orders,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Lỗi khi tải dữ liệu đơn hàng:', error));
</script>
