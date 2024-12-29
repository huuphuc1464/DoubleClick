<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\HoaDon;
use App\Models\TaiKhoan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        //Tổng số sách
        $tongSoSach = Sach::count(); // Tính tổng số sách

        //Tổng số đơn hàng
        $tongSoDonHang = HoaDon::count();

        //Tổng doanh thu
        $tongDoanhThu = HoaDon::where('TrangThai', 1)->sum('TongTien');

        //Số người dùng (khách hàng)

        $tongSoNguoiDung = TaiKhoan::where('MaRole', 3)->count();

        return view('Admin.dashbroad', [
            'tongSoSach' => $tongSoSach,
            'tongSoDonHang' => $tongSoDonHang,
            'tongDoanhThu' => $tongDoanhThu,
            'tongSoNguoiDung' => $tongSoNguoiDung
        ]);
    }

    public function  statistics()
    {
        return view('Admin.statistics');
    }
}
