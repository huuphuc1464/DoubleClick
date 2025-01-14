<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    private function getKhachHang()
    {
        $user = session()->get('user');
        if ($user) {
            $maTk = $user['MaTK']; // Lấy MaTK từ session
            $khachHang = TaiKhoan::where('MaTK', $maTk)->first();
            if ($khachHang) {
                return $khachHang; // Trả về đối tượng người dùng
            }
        }
        return null;
    }
    private function getCart()
    {
        $khachHang = $this->getKhachHang();
        if ($khachHang) {
            $customerId = $khachHang->MaTK;
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
        return collect(); // Trả về collection rỗng nếu không tìm thấy khách hàng
    }
    private function getVoucher()
    {
        return DB::table('voucher')
            ->select('MaVoucher', 'TenVoucher', 'GiamGia', 'NgayBatDau', 'NgayKetThuc', 'GiaTriToiThieu', 'SoLuong', 'TrangThai')
            ->where('TrangThai', 1)
            ->where('SoLuong', '>', 0)
            ->get();
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
    public function index(Request $request)
    {
        $khachHang = $this->getKhachHang();
        $cart = json_decode($request->input('cart_data'), true);  // $cart là mảng
        $voucher = $this->getVoucher();

        // Kiểm tra nếu giỏ hàng trống
        if (empty($cart) || count($cart) === 0) {
            // Chuyển hướng về trang giỏ hàng hoặc thông báo lỗi
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        return view('Payment.thanhToan', compact('khachHang', 'cart', 'voucher'));
    }
    public function thanks()
    {
        // Kiểm tra trạng thái đặt hàng
        $orderSuccess = session('order_success', false);  // Mặc định false nếu không có session

        // Xóa session sau khi kiểm tra
        session()->forget('order_success');

        // Truyền giá trị session vào view
        $viewData = [
            'title' => $orderSuccess ? 'Thanh toán thành công' : 'Thanh toán thất bại',
            'order_success' => $orderSuccess,  // Truyền vào view
        ];

        return view('Payment.thanks', $viewData);
    }

    //Check out xử lý thanh toán: Nếu phương thức thanh toán: COD thì thêm vào hoadon và chitiethoadon, nếu VNPAY thì chuyển đến cổng thanh toán, sau đó lưu thông tin thanh toán.
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
        foreach ($gioHang as $productId => $item) {
            // Lấy đơn giá và tính thành tiền
            $donGia = DB::table('sach')->where('MaSach', $productId)->value('GiaBan');
            $thanhTien = $donGia * $item['quantity'];

            // Lưu chi tiết hóa đơn
            DB::table('chitiethoadon')->insert([
                'MaHD' => $newHoaDon->MaHD,
                'MaSach' => $productId,
                'DonGia' => $donGia,
                'SLMua' => $item['quantity'],
                'ThanhTien' => $thanhTien,
                'TrangThai' => 1,
            ]);

            // Cập nhật tồn kho
            DB::table('sach')->where('MaSach', $productId)->decrement('SoLuongTon', $item['quantity']);
        }

        // Xóa giỏ hàng sau khi thanh toán thành công
        session(['cart' => []]);
    }
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

        // Lấy giỏ hàng từ session
        $gioHang = session('cart', []);  // Lấy giỏ hàng từ session

        // Mảng lưu trữ các sản phẩm thiếu hàng
        $insufficientProducts = [];

        foreach ($gioHang as $productId => $item) {
            // Lấy thông tin sản phẩm từ DB
            $product = DB::table('sach')->where('MaSach', $productId)->first();

            // Kiểm tra tồn kho
            if ($product && $product->SoLuongTon < $item['quantity']) {
                // Nếu không đủ số lượng, thêm tên sản phẩm vào mảng
                $insufficientProducts[] = $item['name'];
            }
        }

        // Kiểm tra nếu có sản phẩm thiếu hàng
        if (!empty($insufficientProducts)) {
            return redirect()->route('cart.index')
                ->with('error', 'Số lượng tồn kho không đủ cho các sản phẩm:')
                ->with('insufficientProducts', $insufficientProducts);
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
        } elseif ($orderData['paymentMethod'] == "VNPAY") {
            $this->processVNPAYPayment($request, $gioHang, $orderData);
        }
        // Các phương thức thanh toán khác (nếu có)
        else {
            // Xử lý phương thức thanh toán khác
        }
    }
    //Thanh toán VNPAY
    public function processVNPAYPayment(Request $request, $gioHang, $orderData)
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
        $newHoaDon->setTrangThai(0); // Trạng thái "Đang chờ xử lý"
        $newHoaDon->save();

        // Lưu chi tiết hóa đơn và cập nhật tồn kho
        foreach ($gioHang as $productId => $item) {
            // Lấy đơn giá và tính thành tiền
            $donGia = DB::table('sach')->where('MaSach', $productId)->value('GiaBan');
            $thanhTien = $donGia * $item['quantity'];

            // Lưu chi tiết hóa đơn
            DB::table('chitiethoadon')->insert([
                'MaHD' => $newHoaDon->MaHD,
                'MaSach' => $productId,
                'DonGia' => $donGia,
                'SLMua' => $item['quantity'],
                'ThanhTien' => $thanhTien,
                'TrangThai' => 1,
            ]);

            // Cập nhật tồn kho
            DB::table('sach')->where('MaSach', $productId)->decrement('SoLuongTon', $item['quantity']);
        }

        // Xóa giỏ hàng
        session(['cart' => []]);

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        /**
         * 
         *
         * @author CTT VNPAY
         */
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_TmnCode = "IZYK2ZSF"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "GZ42HGHZ3N3K30CWHFVY5L71VSJSLQUH"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payment.handle-ipn');
        //$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        //$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";


        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_TxnRef = $newHoaDon->getMaHD() . "-" . date('YmdHis');  // Ví dụ: 1234-20250110123456
        $vnp_Amount = intval($newHoaDon->TongTien * 100);
        //dd($vnp_Amount);
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = 'VNBANK'; //Thẻ ATM - Tài khoản ngân hàng nội địa
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD: " . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        );


        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }
    //Kiểm tra thanh toán
    public function handleVNPAYIPN(Request $request)
    {
        // Lấy dữ liệu từ URL
        $inputData = array();
        foreach ($request->query() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        // Lấy chữ ký từ URL và loại bỏ khỏi dữ liệu
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);

        // Sắp xếp lại dữ liệu để tạo chữ ký
        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        // Tạo chữ ký từ dữ liệu
        $vnp_HashSecret = 'GZ42HGHZ3N3K30CWHFVY5L71VSJSLQUH';
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $vnpTranId = $inputData['vnp_TransactionNo']; // Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; // Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán
        $orderId = $inputData['vnp_TxnRef']; // Mã đơn hàng
        $response = [];

        if ($secureHash == $vnp_SecureHash) {
            $order = HoaDon::where('MaHD', $orderId)->first();
            if ($order) {
                if ($order->TongTien == $vnp_Amount) {
                    if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
                        $order->TrangThai = 1;
                        $order->PhuongThucThanhToan = 'VNPAY';
                        $order->save();
                        session(['cart' => []]);
                        session(['order_success' => true]);
                        return redirect()->route('payment.thanks');
                    } else {
                        //session(['order_success' => false, 'error_message' => $response['Message']]);
                        // Chuyển hướng đến trang cảm ơn với thông báo thất bại
                        session(['cart' => []]);

                        return redirect()->route('payment.thanks');
                    }
                } else {
                    $response['RspCode'] = '04';
                    $response['Message'] = 'Invalid amount';
                }
            } else {
                $response['RspCode'] = '01';
                $response['Message'] = 'Order not found';
            }
        } else {
            $response['RspCode'] = '97';
            $response['Message'] = 'Invalid signature';
        }

        return response()->json($response);
    }
}