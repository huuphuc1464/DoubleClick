@extends('Admin.layout')

@section('title', 'Trang thống kê')

@section('content')
    <!-- Tổng Quan thống kê -->
    <div class="row">
        <!-- Doanh thu tháng này -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Doanh thu tháng này</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($doanhThuThangNay) }} VND
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Đơn hàng tháng này -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đơn hàng tháng này</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $donHangThangNay }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-receipt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sách bán chạy -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sách bán chạy tháng này
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sachBanChay }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Số lượng sách trong kho -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Số sách trong kho</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $soLuongSachTrongKho }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hiển thị tháng hiện tại -->
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h5 class="m-0">Hiện tại đang là <span id="currentMonth"></span> năm <span id="currentYear"></span>.</h5>
            </div>
        </div>
    </div>

    <!-- Biểu đồ thống kê sách bán chạy -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sách bán chạy theo tháng</h6>
                </div>
                <div class="card-body">
                    <!-- Dropdown chọn năm -->
                    <div class="form-group">
                        <label for="yearSelect">Chọn năm</label>
                        <select id="yearSelect" class="form-control">
                            <!-- Tùy chọn sẽ được render từ backend -->
                        </select>
                    </div>

                    <!-- Dropdown chọn tháng -->
                    <div class="form-group">
                        <label for="monthSelect">Chọn tháng</label>
                        <select id="monthSelect" class="form-control">
                            <!-- Tùy chọn sẽ được render từ backend -->
                        </select>
                    </div>

                    <!-- Biểu đồ cột sách bán chạy -->
                    <canvas id="bestSellerChart" width="100%" height="50"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Lấy phần tử select từ DOM
        const yearSelect = document.getElementById('yearSelect');
        const monthSelect = document.getElementById('monthSelect');

        // Hàm tạo tùy chọn cho dropdown
        function populateDropdown(selectElement, data) {
            // Xóa các tùy chọn cũ
            selectElement.innerHTML = '';
            // Thêm các tùy chọn mới
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item;
                option.textContent = item;
                selectElement.appendChild(option);
            });
        }

        // Lấy tháng và năm hiện tại từ hệ thống
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1;
        const currentYear = currentDate.getFullYear();

        // Hiển thị tháng và năm hiện tại trong giao diện
        document.getElementById('currentMonth').textContent = `Tháng ${currentMonth}`;
        document.getElementById('currentYear').textContent = currentYear;

        // Gọi API để lấy danh sách năm và tháng
        fetch('/admin/statistics/years-and-months')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Render dropdown cho năm
                    populateDropdown(yearSelect, data.years);

                    // Render dropdown cho tháng
                    populateDropdown(monthSelect, data.months);

                    // Thiết lập giá trị mặc định (năm và tháng hiện tại)
                    yearSelect.value = currentYear;
                    monthSelect.value = currentMonth;

                    // Cập nhật biểu đồ với dữ liệu của tháng và năm hiện tại
                    updateBestSellerChart(currentYear, currentMonth);
                } else {
                    alert('Không thể tải dữ liệu năm và tháng.');
                }
            })
            .catch(error => {
                console.error('Lỗi khi tải dữ liệu năm và tháng:', error);
                alert('Có lỗi xảy ra khi tải danh sách năm và tháng.');
            });

        // Biểu đồ bán chạy (giữ nguyên từ trước)
        const ctx = document.getElementById('bestSellerChart').getContext('2d');
        const bestSellerChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Số lượng bán',
                    data: [],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Chỉ định khoảng cách giữa các nhãn là 1
                            callback: function(value) {
                                return Number.isInteger(value) ? value : null; // Chỉ hiển thị số nguyên
                            }
                        }
                    },
                },
            },
        });

        // Cập nhật biểu đồ khi thay đổi năm/tháng
        yearSelect.addEventListener('change', function() {
            updateBestSellerChart(this.value, monthSelect.value);
        });

        monthSelect.addEventListener('change', function() {
            updateBestSellerChart(yearSelect.value, this.value);
        });

        // Hàm cập nhật biểu đồ từ backend
        function updateBestSellerChart(year, month) {
            fetch(`/admin/statistics/chart-data/${year}/${month}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data.length > 0) {
                        bestSellerChart.data.labels = data.data.map(item => item.TenSach);
                        bestSellerChart.data.datasets[0].data = data.data.map(item => item.total);
                        bestSellerChart.update();
                    } else {
                        bestSellerChart.data.labels = [];
                        bestSellerChart.data.datasets[0].data = [];
                        bestSellerChart.update();
                        alert(data.message || 'chưa dữ liệu cho tháng này.');
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi tải dữ liệu biểu đồ:', error);
                    alert('Có lỗi xảy ra khi tải dữ liệu biểu đồ.');
                });
        }
    </script>

@endsection
