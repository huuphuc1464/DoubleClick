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
        // Lấy toàn bộ giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Tính tổng tiền của toàn bộ giỏ hàng (không phụ thuộc phân trang)
        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Phân trang giỏ hàng
        $cartCollection = collect($cart);
        $perPage = 4; // Số sản phẩm trên mỗi trang
        $currentPage = LengthAwarePaginator::resolveCurrentPage(); // Lấy trang hiện tại
        $currentPageItems = $cartCollection->slice(($currentPage - 1) * $perPage, $perPage)->all(); // Lấy dữ liệu của trang hiện tại

        $paginatedCart = new LengthAwarePaginator(
            $currentPageItems, // Dữ liệu của trang hiện tại
            $cartCollection->count(), // Tổng số sản phẩm trong giỏ hàng
            $perPage, // Số sản phẩm mỗi trang
            $currentPage, // Trang hiện tại
            ['path' => $request->url(), 'query' => $request->query()] // Đường dẫn và query string
        );

        // Truyền dữ liệu giỏ hàng phân trang và tổng tiền sang view
        return view('gioHang', [
            'cart' => $paginatedCart,
            'totalPrice' => $totalPrice, // Tổng tiền của toàn bộ giỏ hàng
        ]);
    }




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

        // Lấy sản phẩm từ database
        $product = Sach::find($request->id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại!',
            ]);
        }

        // Kiểm tra số lượng tồn
        if ($request->quantity > $product->SoLuongTon) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể thêm bởi vì số lượng đã hết.',
            ]);
        }

        // Cập nhật số lượng trong giỏ hàng
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


}
