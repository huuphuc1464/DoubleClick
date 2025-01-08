<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\Sach;
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
    public function index()
    {
        $khachHang =$this->getKhachHang();
        $cart = $this->getCart();
        $voucher = $this->getVoucher();
        if ($cart->isEmpty()) {
            // Chuyển hướng về trang giỏ hàng hoặc thông báo lỗi
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }
        return view('Payment.thanhToan', 
        compact('khachHang', 'cart','voucher'));
    }
    public function thanks()
    {
        // Kiểm tra trạng thái đặt hàng
        if (!session('order_success')) {
            return redirect()->route('cart.index'); // Chuyển hướng về trang chủ nếu chưa đặt hàng
        }

        // Xóa trạng thái đặt hàng sau khi truy cập trang cảm ơn
        session()->forget('order_success');

        $viewData = [
            "title" => "DoubleClick xin cảm ơn",
        ];
        return view('Payment.thanks', $viewData);
    }
    //Hàm kiểm tra số lượng mua < số lượng tồn
    private function checkSoLuongTon($maSach, $soLuongMua)
    {
        $soLuongTon = DB::table('sach')->where('MaSach', $maSach)->value('SoLuongTon');
        return $soLuongTon >= $soLuongMua;
    }
    //Hàm kiểm tra nếu có voucher nào sử dụng thì số lượng voucher đó giảm đi 1.
    private function useVoucher($maVoucher)
    {
        $voucher = DB::table('voucher')
            ->where('MaVoucher', $maVoucher)
            ->where('NgayKetThuc', '>=', now()) // Kiểm tra ngày hết hạn
            ->where('SoLuong', '>', 0) // Kiểm tra còn số lượng
            ->first();

        if ($voucher) {
            // Giảm số lượng voucher đi 1
            DB::table('voucher')
                ->where('MaVoucher', $maVoucher)
                ->decrement('SoLuong', 1);
            return true;
        }

        return false; // Voucher không hợp lệ hoặc đã hết hạn
    }
    //Check out xử lý thanh toán: Nếu phương thức thanh toán: COD thì thêm vào hoadon và chitiethoadon, nếu VNPAY thì chuyển đến cổng thanh toán, sau đó lưu thông tin thanh toán.
    public function checkout(Request $request)
    {
        // Lấy các dữ liệu từ request và gộp chúng vào một mảng hoặc đối tượng
        $orderData = [
            'MaTK' => $request->input('MaTK'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'province' => $request->input('provinceName'),
            'district' => $request->input('districtName'),
            'ward' => $request->input('wardName'),
            'paymentMethod' => $request->input('paymentMethod'),
            'shippingFee' => preg_replace('/[^0-9.]/', '', $request->input('shippingFee')),
            'totalPrice' => preg_replace('/[^0-9.]/', '', $request->input('totalPrice')),
            'discountAmount' => preg_replace('/[^0-9.]/', '', $request->input('discountAmount', null)),
            'voucher' => $request->input('voucher', null),
        ];
        
        // Tạo full address từ các thành phần địa chỉ
        $orderData['fullAddress'] = $orderData['address'] . ', ' . $orderData['ward'] . ', ' . $orderData['district'] . ', ' . $orderData['province'];

        // Lấy giỏ hàng của khách hàng
        $gioHang = DB::table('giohang')
            ->join('sach', 'giohang.MaSach', '=', 'sach.MaSach')
            ->where('giohang.MaTK', $orderData['MaTK'])
            ->select('giohang.*', 'sach.TenSach', 'sach.GiaBan') 
            ->get();

        $insufficientProducts = [];
        foreach ($gioHang as $item) {
            if (!$this->checkSoLuongTon($item->MaSach, $item->SLMua)) {
                $insufficientProducts[] = $item->TenSach;
            }
        }

        if (!empty($insufficientProducts)) {
            return redirect()->route('cart.index')->with('error', 'Số lượng tồn kho không đủ cho các sản phẩm:')->with('insufficientProducts', $insufficientProducts);
        }

        // Kiểm tra voucher nếu có
        if ($orderData['voucher'] && !$this->useVoucher($orderData['voucher'])) {
            return redirect()->back()->with('error', 'Voucher không hợp lệ hoặc đã hết hạn.');
        }

        // Nếu phương thức thanh toán là COD
        if ($orderData['paymentMethod'] == "COD") {
            // Chuyển dữ liệu sang phương thức processCODCheckout
            $this->processCODCheckout($request, $gioHang, $orderData);
            
            // Lưu trạng thái đặt hàng thành công vào session
            session(['order_success' => true]);

            // Chuyển hướng đến trang cảm ơn
            return redirect()->route('payment.thanks');
        }

        // Các phương thức thanh toán khác (nếu có)
        else{
            // Xử lý phương thức thanh toán khác
        }
    }
    //Thanh toán khi nhận hàng
    private function processCODCheckout(Request $request, $gioHang, $orderData)
    {
        // Tạo hóa đơn với dữ liệu từ mảng $orderData
        $newHoaDon = new HoaDon();
        $newHoaDon->setMaTK($orderData['MaTK']);
        $newHoaDon->setNgayLapHoaDon(now());
        $newHoaDon->setSDT($orderData['phone']);
        $newHoaDon->setDiaChi($orderData['fullAddress']);
        $newHoaDon->setTienShip($orderData['shippingFee']);
        $newHoaDon->setTongTien($orderData['totalPrice']);
        $newHoaDon->setKhuyenMai($orderData['discountAmount']);
        $newHoaDon->setPhuongThucThanhToan($orderData['paymentMethod']);
        $newHoaDon->setMaVoucher($orderData['voucher']);
        $newHoaDon->setTrangThai(1); // Trạng thái "Đang chờ xử lý"
        $newHoaDon->save();

        // Lưu chi tiết hóa đơn và cập nhật tồn kho
        foreach ($gioHang as $item) {
            // Lấy đơn giá và tính thành tiền
            $donGia = DB::table('sach')->where('MaSach', $item->MaSach)->value('GiaBan');
            $thanhTien = $donGia * $item->SLMua;

            // Lưu chi tiết hóa đơn
            DB::table('chitiethoadon')->insert([
                'MaHD' => $newHoaDon->MaHD,
                'MaSach' => $item->MaSach,
                'DonGia' => $donGia,
                'SLMua' => $item->SLMua,
                'ThanhTien' => $thanhTien,
                'TrangThai' => 1,
            ]);

            // Cập nhật tồn kho
            DB::table('sach')->where('MaSach', $item->MaSach)->decrement('SoLuongTon', $item->SLMua);
        }

        // Xóa giỏ hàng
        DB::table('giohang')->where('MaTK', $orderData['MaTK'])->delete();
    }
    //Thanh toán VNPAY
    private function processVNPAYPayment($amount)
    {
        // Xử lý thanh toán MoMo ở đây
        // Bạn cần tích hợp API MoMo để thực hiện giao dịch
        // Giả sử trả về true nếu thanh toán thành công, false nếu thất bại
        return true;
    }
}
