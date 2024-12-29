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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Doanh thu tháng này
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10,000,000 VND</div> <!-- Dữ liệu giả -->
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đơn hàng tháng này
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">250</div> <!-- Dữ liệu giả -->
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sách bán chạy</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Lược sử loài người</div>
                            <!-- Dữ liệu giả -->
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Số sách trong kho
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">500</div> <!-- Dữ liệu giả -->
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ thống kê sách bán chạy theo tháng -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sách bán chạy theo tháng</h6>
                </div>
                <div class="card-body">
                    <!-- Dropdown chọn tháng -->
                    <div class="form-group">
                        <label for="monthSelect">Chọn tháng</label>
                        <select id="monthSelect" class="form-control">
                            <option value="1">Tháng 1</option>
                            <option value="2">Tháng 2</option>
                            <option value="3">Tháng 3</option>
                            <option value="4">Tháng 4</option>
                            <option value="5">Tháng 5</option>
                            <option value="6">Tháng 6</option>
                        </select>
                    </div>

                    <!-- Biểu đồ cột sách bán chạy -->
                    <canvas id="bestSellerChart" width="100%" height="50"></canvas> <!-- Biểu đồ cột -->
                </div>
            </div>
        </div>
    </div>

    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js từ CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Plugin để hiển thị phần trăm -->
    <script>
        // Dữ liệu cho các tháng (Dữ liệu giả cho sách bán chạy)
        const dataByMonth = {
            1: {
                labels: ['Lược sử loài người', 'Thế giới như tôi thấy', 'Sapiens', 'Tiểu thuyết X',
                    'Những kẻ xuất chúng'
                ],
                data: [120, 100, 80, 60, 50], // Dữ liệu bán
            },
            2: {
                labels: ['Lược sử loài người', 'Sapiens', 'Tiểu thuyết Y', 'Tiểu thuyết Z', 'Nhà giả kim'],
                data: [130, 110, 90, 70, 60], // Dữ liệu bán
            },
            3: {
                labels: ['Tiểu thuyết A', 'Lược sử loài người', 'Tiểu thuyết B', 'Sapiens', 'Cuộc đời như thế nào'],
                data: [150, 130, 110, 90, 70], // Dữ liệu bán
            },
            // Thêm dữ liệu cho các tháng khác nếu cần
        };

        // Cập nhật biểu đồ sách bán chạy theo tháng
        function updateBestSellerChart(month) {
            const monthData = dataByMonth[month];
            if (monthData) {
                bestSellerChart.data.labels = monthData.labels;
                bestSellerChart.data.datasets[0].data = monthData.data;
                bestSellerChart.update();
            }
        }

        // Khởi tạo biểu đồ cột
        var bestSellerCtx = document.getElementById('bestSellerChart').getContext('2d');
        var bestSellerChart = new Chart(bestSellerCtx, {
            type: 'bar', // Biểu đồ cột
            data: {
                labels: [], // Sẽ cập nhật sau
                datasets: [{
                    data: [], // Sẽ cập nhật sau
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString() + ' cuốn (' +
                                    (tooltipItem.raw / tooltipItem.dataset.data.reduce((a, b) => a + b)) * 100 +
                                    '%)';
                            }
                        }
                    },
                    datalabels: {
                        display: true,
                        formatter: function(value, ctx) {
                            let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = (value / sum * 100).toFixed(2);
                            return percentage + '%'; // Hiển thị phần trăm
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 12
                        }
                    }
                }
            }
        });

        // Xử lý sự kiện chọn tháng
        document.getElementById('monthSelect').addEventListener('change', function() {
            const selectedMonth = parseInt(this.value);
            updateBestSellerChart(selectedMonth); // Cập nhật biểu đồ khi chọn tháng
        });

        // Cập nhật biểu đồ mặc định cho tháng 1
        updateBestSellerChart(1); // Mặc định chọn tháng 1

        // Thêm class 'active' cho mục thống kê trong sidebar
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.remove('active'); // Xóa class active cũ
        });
    </script>


@endsection
