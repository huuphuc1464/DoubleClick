<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    private function getKhachHang()
    {
        return DB::table('taikhoan') 
            ->select('TenTK', 'SDT', 'DiaChi')
            ->where('MaTK', 1) 
            ->first();
    }
    private function getCart()
    {
        $customerId = 1; // Demo ID khách hàng (cần thay đổi nếu sử dụng session hoặc auth)
        return DB::table('giohang')
            ->join('sach', 'giohang.MaSach', '=', 'sach.MaSach')
            ->select(
                'sach.TenSach',
                'sach.GiaBan',
                'sach.AnhDaiDien',
                'giohang.SLMua',
                DB::raw('(sach.GiaBan * giohang.SLMua) as ThanhTien')
            )
            ->where('giohang.MaTK', $customerId)
            ->get();
    }
    private function getVoucher() {
        return DB::table('voucher')
            ->select('MaVoucher','TenVoucher', 'GiamGia', 'NgayBatDau', 'NgayKetThuc', 'GiaTriToiThieu', 'SoLuong', 'TrangThai')
            ->where('TrangThai', 1)
            ->get();
    }

    private function hinhThucThanhToan(){
        $hinhThucThanhToan = [
            ['id'=> 1, 'Tên' => 'Thanh toán trực tuyến VNPAY', 'HinhAnh' => 'img/vnpay.webp'],
            ['id'=> 2, 'Tên' => 'Thanh toán bằng thẻ quốc tế Visa, Master', 'HinhAnh' => 'img/visa.webp'],
            ['id'=> 3, 'Tên' => 'Thẻ ATM nội địa/Internet Banking (Hỗ trợ Internet Banking)', 'HinhAnh' => 'img/atm.webp'],
            ['id'=> 4, 'Tên' => 'Thanh toán khi nhận hàng (COD)', 'HinhAnh' => 'img/cod.webp']
        ];
        return $hinhThucThanhToan;
    }
    public function index()
    {
        $khachHang =$this->getKhachHang();
        $cart = $this->getCart();
        $voucher = $this->getVoucher();
        $hinhThucThanhToan = $this->hinhThucThanhToan();
           
        return view('Payment.thanhToan', 
        compact('hinhThucThanhToan', 'khachHang', 'cart','voucher'));
    }

    public function thanks(){
        $viewData = [
            "title"=>"DoubleClick xin cảm ơn",
        ];
        return view('Payment.thanks', $viewData);
    }
}
