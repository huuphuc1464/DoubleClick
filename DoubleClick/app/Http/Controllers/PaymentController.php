<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\TaiKhoan;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class PaymentController extends Controller
{
    private function getKhachHang()
    {
        return DB::table('taikhoan') 
            ->select('MaTK','TenTK', 'SDT', 'DiaChi')
            ->where('MaTK', 1) 
            ->first();
    }
    private function getCart()
    {
        $customerId = 1; // Demo ID khách hàng (cần thay đổi nếu sử dụng session hoặc auth)
        return DB::table('giohang')
            ->join('sach', 'giohang.MaSach', '=', 'sach.MaSach')
            ->select(
                'sach.MaSach',
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
    private function checkSoLuongTon($maSach){
        //Kiểm tra số lượng....
        return true;
    }
    private function useVoucher($maVouCher){
        return true;
    }
    public function index()
    {
        $khachHang =$this->getKhachHang();
        $cart = $this->getCart();
        $voucher = $this->getVoucher();
    
        return view('Payment.thanhToan', 
        compact('khachHang', 'cart','voucher'));
    }
    public function thanks(){
        $viewData = [
            "title"=>"DoubleClick xin cảm ơn",
        ];
        return view('Payment.thanks', $viewData);
    }
    public function checkout(Request $request)
    {
        // Lấy các dữ liệu từ request
        $maTK = $request->input('MaTK');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $province = $request->input('provinceName');
        $district = $request->input('districtName');
        $ward = $request->input('wardName');
        $paymentMethod = $request->input('paymentMethod');
        $shippingFee = preg_replace('/[^0-9.]/', '', $request->input('shippingFee'));
        $totalPrice = preg_replace('/[^0-9.]/', '', $request->input('totalPrice'));
        $discountAmount = preg_replace('/[^0-9.]/', '', $request->input('discountAmount', null));
        $voucher = $request->input('voucher',null); // Nếu có voucher
        $fullAddress = $address . ', ' . $ward . ', ' . $district . ', ' . $province;
        
        // 1. Lưu thông tin đơn hàng vào bảng orders
        $newHoaDon = new HoaDon();
        $newHoaDon->setMaTK($maTK);
        $newHoaDon->setNgayLapHoaDon(now());
        $newHoaDon->setSDT($phone);
        $newHoaDon->setDiaChi($fullAddress);
        $newHoaDon->setTienShip($shippingFee); // Đã sửa lỗi ở đây
        $newHoaDon->setTongTien($totalPrice);
        $newHoaDon->setKhuyenMai($discountAmount);
        $newHoaDon->setPhuongThucThanhToan($paymentMethod);
        $newHoaDon->setMaVoucher($voucher);
        $newHoaDon->setTrangThai(1);
        $newHoaDon->save();
        // 2. Lưu các chi tiết đơn hàng vào bảng order_details
        $gioHang = DB::table('giohang')
                ->where('MaTK', $maTK)
                ->get();

        foreach ($gioHang as $item) {
            // Tính thành tiền cho mỗi sản phẩm
            $donGia = DB::table('sach')->where('MaSach', $item->MaSach)->value('GiaBan'); // Lấy giá bán của sách
            $thanhTien = $donGia * $item->SLMua;

            // Lưu chi tiết vào bảng chitiethoadon
            DB::table('chitiethoadon')->insert([
                'MaHD' => $newHoaDon->MaHD,
                'MaSach' => $item->MaSach,
                'DonGia' => $donGia,
                'SLMua' => $item->SLMua,
                'GhiChu' => null, // Nếu có ghi chú, bạn có thể lấy từ request
                'ThanhTien' => $thanhTien,
                'TrangThai' => 1, // Trạng thái của chi tiết đơn hàng
            ]);
        }
        // 3. Trả về kết quả hoặc chuyển hướng
        return redirect()->route('Payment.thanks'); // Chuyển đến trang cảm ơn
    }

    private function processVNPAYPayment($amount)
    {
        // Xử lý thanh toán MoMo ở đây
        // Bạn cần tích hợp API MoMo để thực hiện giao dịch
        // Giả sử trả về true nếu thanh toán thành công, false nếu thất bại
        return true;
    }

}
