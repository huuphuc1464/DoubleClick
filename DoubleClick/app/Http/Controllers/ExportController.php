<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\confirm;

class ExportController extends Controller
{
    // Laravel Example
    public function exportData(Request $request)
    {
        $option = $request->get('option');
        $month = $request->get('month');
        $year = $request->get('year');

        if ($option == 1) {
            // Lấy dữ liệu doanh thu, đơn hàng, sách bán chạy, số sách trong kho theo tháng và năm
            $data = $this->getRevenueData($month, $year);
        } elseif ($option == 2) {
            // Lấy dữ liệu tổng số sách, đơn hàng, doanh thu, người dùng
            $data = $this->getTotalData($month, $year);
        } elseif ($option == 3) {
            // Lấy dữ liệu sách sắp hết hàng
            $data = $this->getLowStockBooks($month, $year);
        } elseif ($option == 4) {
            // Lấy danh sách đơn hàng trong tuần/tháng/năm
            $data = $this->getOrders($month, $year);
        } elseif ($option == 5) {
            // Lấy top 10 sách bán chạy nhất
            $data = $this->getTopSellingBooks($month, $year);
        }
        return response()->json($data);
    }

    // Hàm lấy dữ liệu doanh thu theo tháng và năm
    private function getRevenueData($month = null, $year = null)
    {
        // Tổng số sách trong kho
        $booksInStock = DB::table('sach')->where('TrangThai', '=', 1)->sum('SoLuongTon');

        $revenue = DB::table('hoadon')
            ->whereYear('NgayLapHD', $year)
            ->where('TrangThai', '=', 3);
        // Đơn hàng
        $orders = DB::table('hoadon')
            ->whereYear('NgayLapHD', $year)
            ->where('TrangThai', '=', 3);

        if ($month) {
            $revenue = $revenue->whereMonth('NgayLapHD', $month);
            $orders = $orders->whereMonth('NgayLapHD', $month);
        }

        // Sách bán chạy nhất trong tháng và năm đã chọn
        $bestSellers = DB::table('sach')
            ->join('chitiethoadon', 'sach.MaSach', '=', 'chitiethoadon.MaSach')
            ->join('hoadon', 'hoadon.MaHD', '=', 'chitiethoadon.MaHD')
            ->where('hoadon.TrangThai', 3)
            ->whereYear('hoadon.NgayLapHD', $year)
            ->when($month, function ($query) use ($month) {
                return $query->whereMonth('hoadon.NgayLapHD', $month);  // Thêm điều kiện tháng nếu có
            })
            ->select('sach.TenSach')
            ->groupBy('sach.TenSach')
            ->orderByDesc(DB::raw('SUM(chitiethoadon.SLMua)'))
            ->limit(1)  // Lấy sách bán chạy nhất
            ->get();

        return [
            'revenue' => $revenue->sum('TongTien'),  // Tổng doanh thu
            'orders' => $orders->count('MaHD'),  // Số đơn hàng
            'bestSellers' => $bestSellers,
            'booksInStock' => $booksInStock,
            'month' => $month,
            'year' => $year
        ];
    }


    // Hàm lấy dữ liệu tổng quan
    private function getTotalData($month = null, $year = null)
    {
        // Tổng số sách
        $totalBooks = DB::table('sach')->count('MaSach');

        // Truy vấn cho đơn hàng và doanh thu theo năm
        $totalOrdersQuery = DB::table('hoadon')->whereYear('NgayLapHD', $year)->where('TrangThai', '=', 3);
        $totalRevenueQuery = DB::table('hoadon')->whereYear('NgayLapHD', $year)->where('TrangThai', '=', 3);

        // Tổng số người dùng
        $totalUsers = DB::table('taikhoan')->where('MaRole', '=', 3)->count('MaTK');

        // Nếu có tháng, thêm điều kiện tháng
        if ($month) {
            $totalOrders = $totalOrdersQuery->whereMonth('NgayLapHD', $month)->count('MaHD');
            $totalRevenue = $totalRevenueQuery->whereMonth('NgayLapHD', $month)->sum('TongTien');
        } else {
            // Nếu không có tháng, chỉ cần tính tổng theo năm
            $totalOrders = $totalOrdersQuery->count('MaHD');
            $totalRevenue = $totalRevenueQuery->sum('TongTien');
        }

        // Trả về dữ liệu
        return [
            'totalBooks' => $totalBooks,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalUsers' => $totalUsers,
            'month' => $month,
            'year' => $year
        ];
    }


    // Hàm lấy sách sắp hết hàng
    private function getLowStockBooks($month = null, $year = null)
    {
        $data = DB::table('sach')
            ->where('SoLuongTon', '<', 10)
            ->select('MaSach', 'TenSach', 'SoLuongTon', 'TenNCC', 'GiaNhap')
            ->get();
        return response()->json([
            'lowStockBooks' => $data,
            'month' => $month,
            'year' => $year
        ]);
    }

    private function getOrders($month = null, $year = null)
    {
        // Truy vấn danh sách hóa đơn theo năm (và tháng nếu có)
        $query = DB::table('hoadon')->whereYear('NgayLapHD', $year);

        if ($month) {
            $query->whereMonth('NgayLapHD', $month);
        }

        // Lấy danh sách hóa đơn với các trường cần thiết
        $ordersList = $query->get(['MaHD', 'NgayLapHD', 'TongTien', 'PhuongThucThanhToan', 'TrangThai']);

        // Kiểm tra nếu không có dữ liệu
        if ($ordersList->isEmpty()) {
            return response()->json(['message' => 'Không có dữ liệu cho tháng và năm này.'], 404);
        }

        // Ánh xạ dữ liệu
        $formattedOrders = $ordersList->map(function ($order) {
            return [
                'id' => $order->MaHD,
                'date' => \Carbon\Carbon::parse($order->NgayLapHD)->format('Y-m-d'), // Đảm bảo định dạng ngày tháng
                'totalAmount' => $order->TongTien,
                'paymentMethod' => $order->PhuongThucThanhToan,
                'status' => $order->TrangThai
            ];
        });

        // Trả về dữ liệu dưới dạng JSON
        return response()->json([
            'ordersList' => $formattedOrders,
            'month' => $month,
            'year' => $year
        ]);
    }

    // Hàm lấy top 10 sách bán chạy
    private function getTopSellingBooks($month = null, $year = null)
    {
        $query = DB::table('hoadon')
            ->join('chitiethoadon', 'chitiethoadon.MaHD', '=', 'hoadon.MaHD')
            ->join('sach', 'sach.MaSach', '=', 'chitiethoadon.MaSach')
            ->select('sach.MaSach', 'sach.TenSach', DB::raw('SUM(chitiethoadon.SLMua) as `Số Lượng Bán`'))
            ->groupBy('sach.MaSach', 'sach.TenSach')
            ->where('hoadon.TrangThai', '=', 3)
            ->whereYear('hoadon.NgayLapHD', $year);  // Lọc theo năm

        if ($month) {
            $query->whereMonth('hoadon.NgayLapHD', $month);  // Lọc theo tháng
        }

        $data = $query->orderByDesc(DB::raw('SUM(chitiethoadon.SLMua)'))
            ->limit(10)
            ->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'Không có dữ liệu cho tháng và năm này.'], 404);
        }

        return [
            'topSellingBooks' => $data->map(function ($item) {
                return [
                    'name' => $item->TenSach,
                    'sales' => $item->{'Số Lượng Bán'},
                ];
            }),
            'month' => $month,
            'year' => $year
        ];
    }
}