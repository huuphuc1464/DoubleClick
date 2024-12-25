<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThanhToanController extends Controller
{
    public function index()
    {
        $title = "Thanh toán | Double Click";
        $hinhThucThanhToan = [
            [''=> 1, 'Tên' => 'Thanh toán trực tuyến VNPAY', 'HinhAnh' => 'img/vnpay.webp'],
            [''=> 2, 'Tên' => 'Thanh toán bằng thẻ quốc tế Visa, Master', 'HinhAnh' => 'img/visa.webp'],
            [''=> 3, 'Tên' => 'Thẻ ATM nội địa/Internet Banking (Hỗ trợ Internet Banking)', 'HinhAnh' => 'img/atm.webp'],
            [''=> 4, 'Tên' => 'Thanh toán khi nhận hàng (COD)', 'HinhAnh' => 'img/cod.webp']
        ];
        return view('thanhToan', compact('title', 'hinhThucThanhToan'));
    }

}
