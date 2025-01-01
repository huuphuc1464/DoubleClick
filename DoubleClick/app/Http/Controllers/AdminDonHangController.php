<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Illuminate\Http\Request;

class AdminDonHangController extends Controller
{
    private function getHoaDon()
    {
        // Truy vấn hóa đơn với phân trang và lấy thông tin liên quan về tài khoản và voucher
        return HoaDon::with(['taiKhoan', 'voucher'])
            ->paginate(5); // Lấy 10 hóa đơn mỗi trang (có thể thay đổi số lượng theo yêu cầu)
    }

    function index(){
        $listHoaDon = $this->getHoaDon();
        $viewData =[
            "title"=>"Đơn hàng",
            "subtitle"=>"Danh sách đơn hàng",
            "listHoaDon"=>$listHoaDon
        ];
        return view('Admin.DonHang.index', $viewData);
    }
}
