<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    private function getKhachHang()
    {
        return DB::table('taikhoan') 
            ->select('TenTK', 'SDT', 'DiaChi')
            ->where('MaTK', 3) //Lấy demo id là 3 từ CSDL -> sẽ thay đổi
            ->first();
    }
    public function index()
    {
        $title = "Thanh toán | Double Click";
        $khachHang =$this->getKhachHang();
        $hinhThucThanhToan = [
            ['id'=> 1, 'Tên' => 'Thanh toán trực tuyến VNPAY', 'HinhAnh' => 'img/vnpay.webp'],
            ['id'=> 2, 'Tên' => 'Thanh toán bằng thẻ quốc tế Visa, Master', 'HinhAnh' => 'img/visa.webp'],
            ['id'=> 3, 'Tên' => 'Thẻ ATM nội địa/Internet Banking (Hỗ trợ Internet Banking)', 'HinhAnh' => 'img/atm.webp'],
            ['id'=> 4, 'Tên' => 'Thanh toán khi nhận hàng (COD)', 'HinhAnh' => 'img/cod.webp']
        ];
        return view('Payment.thanhToan', compact('title', 'hinhThucThanhToan','khachHang'));
    }
    public function thanks(){
        $viewData = [
            "title"=>"DoubleClick xin cảm ơn",

        ];
        return view('Payment.thanks', $viewData);
    }
}
