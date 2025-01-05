<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GioHang;

class CartController extends Controller
{
    public function index()
    {
        $MaTK = 1; // Giả sử bạn đang đăng nhập với tài khoản có MaTK = 1
        $cart = GioHang::with('sach')->where('MaTK', $MaTK)->get();
        return view('gioHang', compact('cart'));
    }

    public function add(Request $request)
    {
        $MaTK = 1;
        $MaSach = $request->input('MaSach');
        $SLMua = $request->input('quantity', 1);

        $cartItem = GioHang::where('MaTK', $MaTK)->where('MaSach', $MaSach)->first();

        if ($cartItem) {
            $cartItem->SLMua += $SLMua;
            $cartItem->save();
        } else {
            GioHang::create([
                'MaTK' => $MaTK,
                'MaSach' => $MaSach,
                'SLMua' => $SLMua,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.']);
    }

    public function remove($id)
    {
        $MaTK = 1; // Giả định người dùng hiện tại
        \Log::info("Xóa sản phẩm với MaTK: {$MaTK}, MaSach: {$id}");

        $cartItem = GioHang::where('MaTK', $MaTK)->where('MaSach', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
            \Log::info("Xóa thành công sản phẩm với MaSach: {$id}");
            return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.']);
        }

        \Log::error("Không tìm thấy sản phẩm với MaTK: {$MaTK}, MaSach: {$id}");
        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng.']);
    }



    public function removeMultiple(Request $request)
    {
        $selectedItems = $request->input('selected', []);

        if (!empty($selectedItems)) {
            GioHang::whereIn('MaSach', $selectedItems)->delete();
            return response()->json(['success' => true, 'message' => 'Các sản phẩm đã được xóa khỏi giỏ hàng.']);
        }

        return response()->json(['success' => false, 'message' => 'Vui lòng chọn ít nhất một sản phẩm để xóa.']);
    }

    public function update(Request $request)
    {
        $MaTK = 1;
        $MaSach = $request->input('MaSach');
        $SLMua = $request->input('quantity');

        $cartItem = GioHang::where('MaTK', $MaTK)->where('MaSach', $MaSach)->first();

        if ($cartItem) {
            $cartItem->SLMua = $SLMua;
            $cartItem->save();
            return response()->json(['success' => true, 'message' => 'Số lượng sản phẩm đã được cập nhật.']);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng.']);
    }
}
