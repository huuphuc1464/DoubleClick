<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\Sach;

class AdminStatisticsController extends Controller
{

    // AdminStatisticsController.php
    public function getAvailableYearsAndMonths()
    {
        // Lấy danh sách năm từ bảng hoá đơn (hoặc bất kỳ bảng liên quan nào)
        $years = HoaDon::selectRaw('YEAR(NgayLapHD) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Tháng cố định (1-12)
        $months = range(1, 12);

        return response()->json([
            'success' => true,
            'years' => $years,
            'months' => $months,
        ]);
    }

    public function statistics()
    {
        $currentMonth = date('m'); // Tháng hiện tại
        $currentYear = date('Y'); //Năm hiện tại
        // Tổng doanh thu tháng này
        $doanhThuThangNay = HoaDon::whereYear('NgayLapHD', $currentYear)
            ->whereMonth('NgayLapHD', $currentMonth)
            ->where('TrangThai', 1) //Chỉ lấy hóa đơn đã thanh toán
            ->sum('TongTien');


        //Tổng số đơn hàng tháng này
        $donHangThangNay = HoaDon::whereYear('NgayLapHD', $currentYear)
            ->whereMonth('NgayLapHD', $currentMonth)
            ->where('TrangThai', 1)
            ->count();

        // Sách bán chạy tháng này
        $sachBanChay = ChiTietHoaDon::selectRaw('chitiethoadon.MaSach, SUM(SLMua) as total')
            ->join('Sach', 'chitiethoadon.MaSach', '=', 'sach.MaSach') // Join bảng Sach
            ->join('HoaDon as hd', 'chitiethoadon.MaHD', '=', 'hd.MaHD') // Join bảng HoaDon với alias 'hd'
            ->whereYear('hd.NgayLapHD', $currentYear) // Sử dụng alias 'hd' cho HoaDon
            ->whereMonth('hd.NgayLapHD', $currentMonth)
            ->groupBy('chitiethoadon.MaSach') // Nhóm theo mã sách
            ->orderBy('total', 'desc') // Sắp xếp theo tổng số lượng
            ->first();


        $tenSachBanChay = $sachBanChay ? Sach::find($sachBanChay->MaSach)->TenSach : 'Chưa có';

        //Tổng số lượng sách trong  kho
        $soLuongSachTrongKho = Sach::sum('SoLuongTon');

        return view('Admin.statistics', [
            'doanhThuThangNay' => $doanhThuThangNay,
            'donHangThangNay' => $donHangThangNay,
            'sachBanChay' => $tenSachBanChay,
            'soLuongSachTrongKho' => $soLuongSachTrongKho
        ]);
    }
    public function getBestSellerChartData($year, $month)
    {
        $data = ChiTietHoaDon::selectRaw('sach.TenSach, SUM(chitiethoadon.SLMua) as total')
            ->join('sach', 'chitiethoadon.MaSach', '=', 'sach.MaSach') // Join với bảng Sach
            ->join('hoadon', 'chitiethoadon.MaHD', '=', 'hoadon.MaHD') // Join với bảng HoaDon
            ->whereYear('hoadon.NgayLapHD', $year) // Sử dụng alias hoadon
            ->whereMonth('hoadon.NgayLapHD', $month)
            ->groupBy('sach.TenSach') // Nhóm theo tên sách
            ->orderBy('total', 'desc')
            ->take(5) // Lấy 5 kết quả
            ->get();


        //Kiểm tra dữ liệu
        if ($data->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'không có dữ liệu cho tháng này',
                'data' => []
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Dữ liệu đã được tải thành công',
            'data' => $data
        ]);
    }
}
