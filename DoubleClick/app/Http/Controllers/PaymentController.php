<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

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
        // Kiểm tra trạng thái thanh toán từ session
        $orderSuccess = session()->get('order_success');

        if ($orderSuccess !== null) {
            session()->forget('order_success');
            return redirect()->route('cart.index');
        }

        $cart = json_decode($request->input('cart_data'), true);

        // Kiểm tra xem giỏ hàng có phải là một đối tượng phân trang không
        if (isset($cart['data'])) {
            $cart = $cart['data']; // Lấy giỏ hàng thực tế từ 'data'
        }

        //dd($cart);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        // Lấy danh sách ID sản phẩm từ giỏ hàng
        $productIds = array_keys($cart);

        // Truy vấn bảng 'sach' để lấy thông tin sản phẩm cần thiết
        $products = DB::table('sach')
            ->whereIn('MaSach', $productIds) // Sử dụng đúng tên cột trong bảng 'sach'
            ->select('MaSach', 'TenSach', 'SoLuongTon') // Chỉ lấy các cột cần thiết
            ->get();

        // Kiểm tra số lượng đặt mua với số lượng tồn
        foreach ($products as $product) {
            if (isset($cart[$product->MaSach]) && $cart[$product->MaSach]['quantity'] > $product->SoLuongTon) {
                return redirect()->route('cart.index')
                    ->with('error', "Sản phẩm {$product->TenSach} không đủ số lượng tồn kho.");
            }
        }

        $voucher = $this->getVoucher();
        $khachHang = $this->getKhachHang();

        return view('Payment.thanhToan', compact('khachHang', 'cart', 'voucher'));
    }
    public function thanks($maHD)
    {
        // Kiểm tra trạng thái thanh toán từ session
        $orderSuccess = session('order_success', null);
        $user = session()->get('user', ['MaTK']);
        // Nếu session là null, tức là chưa thanh toán, chuyển hướng về cart.index
        if ($orderSuccess === null) {
            return redirect()->route('cart.index');
        }
        // Nếu thanh toán thất bại (session = 0)
        if ($orderSuccess === 0) {
            $this->clearCart($user); // Gọi phương thức xóa giỏ hàng
            session()->forget('order_success'); // Xóa session sau khi kiểm tra
            return view('Payment.thanks', [
                'title' => 'Thanh toán thất bại',
                'order_success' => $orderSuccess,
                'maHD' => $maHD
            ]);
        }
        $this->clearCart($user); // Gọi phương thức xóa giỏ hàng
        return view('Payment.thanks', [
            'title' => 'Thanh toán thành công',
            'order_success' => $orderSuccess,
            'maHD' => $maHD
        ]);
    }
    // Phương thức xóa giỏ hàng
    public function clearCart($user)
    {
        session(['cart' => []]);
        session(['totalPrice' => 0]);
        session(['cartCount' => 0]);

        $cartKey = 'cart_' . $user['MaTK'];
        session()->forget($cartKey);
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

        return $newHoaDon->MaHD;
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
        $gioHang = json_decode($request->input('cart_data'), true);
        // Kiểm tra xem giỏ hàng có phải là một đối tượng phân trang không
        if (isset($gioHang['data'])) {
            $gioHang = $gioHang['data']; // Lấy giỏ hàng thực tế từ 'data'
        }
        //dd($cart);
        if (empty($gioHang)) {
            return redirect()->route('cart.index');
        }
        // Lấy giỏ hàng từ session

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
            $maHD = $this->processCODCheckout($request, $gioHang, $orderData);
            session(['order_success' => 1]);
            return redirect()->route('payment.thanks', ['maHD' => $maHD]);
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

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
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

            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);

            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }
    //Kiểm tra thanh toán VNPAY
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
                $maHD = $order->MaHD;
                if ($order->TongTien == $vnp_Amount) {
                    if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
                        $order->TrangThai = 1;
                        $order->PhuongThucThanhToan = 'VNPAY';
                        $order->save();
                        session(['order_success' => 1]);
                        return redirect()->route('payment.thanks', ['maHD' => $maHD]);
                    } else {
                        session(['order_success' => 0]);
                        return redirect()->route('payment.thanks', ['maHD' => $maHD]);
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
    //Thay đổi phương thức thanh toán
    public function updatePaymentMethod(Request $request)
    {
        $maHD = $request->input('maHD');
        $paymentMethod = $request->input('paymentMethod');
        $status = $request->input('status');

        // Cập nhật phương thức thanh toán và trạng thái đơn hàng
        $order = HoaDon::where('MaHD', $maHD)->first();

        if ($order) {
            $order->PhuongThucThanhToan = $paymentMethod;
            $order->TrangThai = $status; // Thay đổi trạng thái đơn hàng nếu cần
            $order->save();
            session(['order_success' => 2]);
            return redirect()->route('payment.thanks', ['maHD' => $maHD]); // Chuyển hướng đến trang thành công
        }
        session(['order_success' => 0]);
        return redirect()->route('payment.thanks', ['maHD' => $maHD]); // Nếu không tìm thấy đơn hàng
    }
}
