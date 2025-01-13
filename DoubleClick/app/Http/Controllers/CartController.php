<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GioHang;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    // Hiển thị giỏ hàng
    public function index()
    {
        // Lấy dữ liệu giỏ hàng từ session
        $cart = session()->get('cart', []); // Nếu giỏ hàng rỗng, trả về mảng rỗng
        return view('gioHang', compact('cart')); // Truyền dữ liệu giỏ hàng sang view
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request)
    {
        // Lấy giỏ hàng hiện tại từ session
        $cart = session()->get('cart', []);

        // Lấy thông tin sản phẩm từ request
        $productId = $request->input('id');
        $productName = $request->input('name');
        $productPrice = $request->input('price');
        $productImage = $request->input('image');
        $productQuantity = $request->input('quantity', 1); // Số lượng mặc định là 1

        // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $productQuantity; // Tăng số lượng sản phẩm
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cart[$productId] = [
                'name' => $productName,
                'price' => $productPrice,
                'image' => $productImage,
                'quantity' => $productQuantity,
            ];
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            'cart' => $cart,
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Kiểm tra nếu sản phẩm tồn tại trong giỏ hàng
        if (isset($cart[$request->MaSach])) {
            unset($cart[$request->MaSach]); // Xóa sản phẩm khỏi giỏ
            session()->put('cart', $cart); // Cập nhật lại session

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!',
        ]);
    }
    public function removeMultiple(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->selected as $productId) {
            if (isset($cart[$productId])) {
                unset($cart[$productId]); // Xóa sản phẩm khỏi giỏ
            }
        }

        session()->put('cart', $cart); // Cập nhật lại giỏ hàng trong session

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa các sản phẩm được chọn!',
        ]);
    }


    /*
    public function index()
    {
        $MaTK = 1; // Giả sử bạn đang đăng nhập với tài khoản có MaTK = 1
        $cart = GioHang::with('sach')->where('MaTK', $MaTK)->get();
        return view('gioHang', compact('cart'));
    }


    public function remove($id)
    {
        $userId = 1; // Giả định người dùng hiện tại

        $deletedRows = GioHang::where('MaTK', $userId)->where('MaSach', $id)->delete();

        if ($deletedRows > 0) {
            return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.']);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng.']);
    }
    */

    /*
    public function removeMultiple(Request $request)
    {
        $selectedItems = $request->input('selected', []);

        if (!empty($selectedItems)) {
            GioHang::whereIn('MaSach', $selectedItems)->delete();
            return response()->json(['success' => true, 'message' => 'Các sản phẩm đã được xóa khỏi giỏ hàng.']);
        }

        return response()->json(['success' => false, 'message' => 'Vui lòng chọn ít nhất một sản phẩm để xóa.']);
    }
    */

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
