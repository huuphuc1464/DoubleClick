@extends('Admin.layout')

@section('title', 'Xuất thống kê')

@section('content')
<form id="exportForm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <select id="exportOption" class="form-control">
                    <option value="1">Doanh thu, Đơn hàng, Sách bán chạy, Số sách trong kho</option>
                    <option value="2">Tổng số sách, Tổng số đơn hàng, Tổng doanh thu, Tổng số người dùng</option>
                    <option value="3">Sách sắp hết hàng</option>
                    <option value="4">Danh sách đơn hàng</option>
                    <option value="5">Top 10 sách bán chạy</option>
                </select>
            </div>
            <div class="col-2">
                <!-- Thêm chọn tháng -->
                <select id="month" class="form-control">
                    <option value="">Chọn tháng</option>
                    <option value="1">Tháng 1</option>
                    <option value="2">Tháng 2</option>
                    <option value="3">Tháng 3</option>
                    <option value="4">Tháng 4</option>
                    <option value="5">Tháng 5</option>
                    <option value="6">Tháng 6</option>
                    <option value="7">Tháng 7</option>
                    <option value="8">Tháng 8</option>
                    <option value="9">Tháng 9</option>
                    <option value="10">Tháng 10</option>
                    <option value="11">Tháng 11</option>
                    <option value="12">Tháng 12</option>
                </select>
            </div>
            <div class="col-2">
                <!-- Thêm chọn năm -->
                <select id="year" class="form-control">
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <!-- Thêm các năm bạn cần -->
                </select>
            </div>
            <button type="button" id="exportExcel" class="btn btn-primary col-2">Xuất Excel</button>

        </div>

    </div>






</form>



<!-- Thêm thư viện html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<!-- Thêm thư viện xlsx -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>


<script>
    document.getElementById('exportExcel').addEventListener('click', function() {
        const selectedOption = document.getElementById('exportOption').value;
        const selectedMonth = document.getElementById('month').value;
        const selectedYear = document.getElementById('year').value;

        // Xử lý dữ liệu tháng và năm, nếu không có thì truyền null
        const params = new URLSearchParams();
        params.append('option', selectedOption);
        if (selectedMonth) params.append('month', selectedMonth);
        if (selectedYear) params.append('year', selectedYear);

        fetch(`/export-data?${params.toString()}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Lỗi khi tải dữ liệu từ server');
                }
                return response.json();
            })
            .then(data => {
                // Kiểm tra nếu không có dữ liệu
                if (data.original && data.original.message && data.original.message === 'Không có dữ liệu cho tháng và năm này.') {
                    alert('Không có dữ liệu cho tháng và năm này.');
                    return; // Dừng lại nếu không có dữ liệu
                }
                const wb = XLSX.utils.book_new();
                console.log(data);

                if (selectedOption == 1) {
                    const sheetData = [
                        ['Doanh thu tháng này', data.revenue]
                        , ['Đơn hàng tháng này', data.orders]
                        , ['Sách bán chạy', data.bestSellers.length > 0?data.bestSellers[0].TenSach : 'Không có dữ liệu']
                        , ['Số sách trong kho', data.booksInStock]

                    ];
                    const ws = XLSX.utils.aoa_to_sheet(sheetData);
                    XLSX.utils.book_append_sheet(wb, ws, 'Doanh Thu');
                } else if (selectedOption == 2) {
                    const sheetData = [
                        ['Tổng số sách', data.totalBooks !== undefined?data.totalBooks : 0]
                        , ['Tổng số đơn hàng', data.totalOrders !== undefined?data.totalOrders : 0]
                        , ['Tổng doanh thu', data.totalRevenue !== undefined?data.totalRevenue : 0]
                        , ['Tổng số người dùng', data.totalUsers !== undefined?data.totalUsers : 0]
                    ];
                    const ws = XLSX.utils.aoa_to_sheet(sheetData);
                    XLSX.utils.book_append_sheet(wb, ws, 'Tổng Quan');

                } else if (selectedOption == 3) {
                    const sheetData = data.original.lowStockBooks?data.original.lowStockBooks.map(book => [book.MaSach, book.TenSach, book.TenNCC, book.GiaNhap, book.SoLuongTon]) : [];
                    const ws = XLSX.utils.aoa_to_sheet(sheetData);
                    XLSX.utils.book_append_sheet(wb, ws, 'Sách Sắp Hết Hàng');
                } else if (selectedOption == 4) {
                    console.log(data.original.ordersList);
                    const sheetData = data.original.ordersList?data.original.ordersList.map(order => [order.id, order.date, order.totalAmount, order.paymentMethod, order.status]) : [];
                    const ws = XLSX.utils.aoa_to_sheet(sheetData);
                    XLSX.utils.book_append_sheet(wb, ws, 'Danh Sách Đơn Hàng');
                } else if (selectedOption == 5) {
                    const sheetData = data.topSellingBooks?data.topSellingBooks.map(book => [book.name, book.sales]) : [];
                    const sheetName = 'Top 10 Sách Bán Chạy';
                    const ws = XLSX.utils.aoa_to_sheet(sheetData);
                    XLSX.utils.book_append_sheet(wb, ws, sheetName);
                }

                // Xuất file Excel
                XLSX.writeFile(wb, 'exported_data.xlsx');
            })
            .catch(error => {
                console.error('Lỗi khi tải dữ liệu:', error);
                alert('Đã có lỗi xảy ra khi tải dữ liệu.');
            });
    });

</script>
@endsection
