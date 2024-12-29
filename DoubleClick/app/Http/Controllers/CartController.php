<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\GioHang;
class CartController extends Controller
{

    public function index()
    {
        // Giả sử bạn đang đăng nhập với tài khoản có MaTK = 1
        $MaTK = 1;

        // Lấy dữ liệu từ bảng `giohang` và join với bảng `sach`
        $cart = GioHang::with('sach')->where('MaTK', $MaTK)->get();

        // Trả về view `gioHang.blade.php`
        return view('gioHang', compact('cart'));
    }


    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
{
    $MaTK = 1; // Giả sử tài khoản hiện tại có MaTK = 1
    $MaSach = $request->input('MaSach');
    $SLMua = $request->input('quantity', 1);

    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
    $cartItem = GioHang::where('MaTK', $MaTK)->where('MaSach', $MaSach)->first();

    if ($cartItem) {
        // Nếu đã tồn tại, tăng số lượng
        $cartItem->SLMua += $SLMua;
        $cartItem->save();
    } else {
        // Nếu chưa tồn tại, thêm mới
        GioHang::create([
            'MaTK' => $MaTK,
            'MaSach' => $MaSach,
            'SLMua' => $SLMua,
        ]);
    }

    return redirect()->route('cart.index');
}

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove(Request $request)
{
    $MaTK = 1; // Giả sử tài khoản hiện tại có MaTK = 1
    $MaSach = $request->input('MaSach');

    // Xóa sản phẩm khỏi giỏ hàng
    GioHang::where('MaTK', $MaTK)->where('MaSach', $MaSach)->delete();

    return redirect()->route('cart.index');
}

    // Cập nhật số lượng sản phẩm
    public function update(Request $request)
{
    $MaTK = 1; // Giả sử tài khoản hiện tại có MaTK = 1
    $MaSach = $request->input('MaSach');
    $SLMua = $request->input('quantity');

    // Tìm sản phẩm và cập nhật số lượng
    $cartItem = GioHang::where('MaTK', $MaTK)->where('MaSach', $MaSach)->first();

    if ($cartItem) {
        $cartItem->SLMua = $SLMua;
        $cartItem->save();
    }

    return redirect()->route('cart.index');
}
}
