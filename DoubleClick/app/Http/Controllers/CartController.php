<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\Sach;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // Hiển thị giỏ hàng

    public function index(Request $request)
    {
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session

        // Chuyển đổi giỏ hàng thành một collection để phân trang
        $cartCollection = collect($cart);

        // Tạo phân trang
        $perPage = 4; // Số lượng sản phẩm trên mỗi trang
        $currentPage = LengthAwarePaginator::resolveCurrentPage(); // Trang hiện tại
        $currentPageItems = $cartCollection->slice(($currentPage - 1) * $perPage, $perPage)->all(); // Dữ liệu trang hiện tại

        $paginatedCart = new LengthAwarePaginator(
            $currentPageItems, // Dữ liệu trang hiện tại
            $cartCollection->count(), // Tổng số sản phẩm
            $perPage, // Số sản phẩm mỗi trang
            $currentPage, // Trang hiện tại
            ['path' => $request->url(), 'query' => $request->query()] // Giữ nguyên query string
        );

        // Truyền đối tượng phân trang sang view
        return view('gioHang', [
            'cart' => $paginatedCart,
        ]);
    }

    // Thêm sản phẩm vào giỏ hàng
   /* public function addToCart(Request $request)
    {


        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = DB::table('sach')->where('MaSach', $productId)->first();

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại!'], 404);
        }

        // Kiểm tra số lượng tồn
        if ($product->SoLuongTon <= 0) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm đã hết hàng!']);
        }

        // Kiểm tra trạng thái sản phẩm
        if ($product->TrangThai == 0) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không khả dụng!']);
        }

        // Lưu sản phẩm vào session giỏ hàng
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->TenSach,
                'price' => $product->GiaBan,
                'quantity' => $quantity,
                'image' => $product->AnhDaiDien,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng!', 'cart' => $cart]);
        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng!', 'cart' => $cart]);

    return response()->json(['success' => true, 'message' => $request]);
}
    */
    public function addToCart(Request $request)
    {
        // Lấy thông tin sản phẩm từ request
        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);

        // Lấy dữ liệu giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$productId])) {
            // Nếu có, tăng số lượng
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Nếu chưa có, thêm sản phẩm mới
            $cart[$productId] = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'quantity' => $quantity,
                'image' => $request->input('image'),
            ];
        }

        // Cập nhật lại giỏ hàng trong session
        session()->put('cart', $cart);

        // Trả về phản hồi JSON
        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            'cart' => $cart,
        ]);
    }




    public function removeFromCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:sach,MaSach',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);

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

    public function clearCart()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Giỏ hàng đã được xóa hoàn toàn!',
        ]);
    }



    public function updateCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:sach,MaSach',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Số lượng sản phẩm đã được cập nhật!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!',
        ]);
    }
    public function prepareCheckout(Request $request)
    {
        $selectedItems = $request->input('selectedItems');
        if (empty($selectedItems)) {
            return response()->json(['success' => false, 'message' => 'Không có sản phẩm nào được chọn.']);
        }

        $cart = session()->get('cart', []);
        $checkoutItems = [];
        Log::info('Session cart:', session()->get('cart'));
        Log::info('Selected items:', $selectedItems);
        Log::info('Checkout items:', $checkoutItems);


        foreach ($selectedItems as $itemId) {
            if (isset($cart[$itemId])) {
                $checkoutItems[$itemId] = $cart[$itemId];
            }
        }

        session()->put('checkoutItems', $checkoutItems);

        return response()->json(['success' => true]);
    }


}
