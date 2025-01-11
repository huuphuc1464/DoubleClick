<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoaDon;

class ChartController extends Controller
{
    //Lấy doanh thu theo tháng (revenue: doanh thu)
    public function getRevenueByMonth()
    {
        // Dùng để xem thường thì tháng nào bán được nhiều nhất
        $data = HoaDon::selectRaw('Month(NgayLapHD) as month, Sum(TongTien) as revenue')
            ->where('TrangThai', '!=', 4) //không lấy đơn hủy
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        return response()->json($data);
    }

    public function getOrderByMonth()
    {
        $data = HoaDon::selectRaw('Month(NgayLapHD) as month, COUNT(*) as orders')
            ->where('TrangThai', '!=', 4) // Điều kiện TrangThai khác 4
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json($data);
    }
}
