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
        $cart = session()->get('cart', []);

        foreach ($cart as $id => &$item) {
            $product = Sach::find($id);
            if ($product) {
                $item['stock'] = $product->SoLuongTon; // Đồng bộ tồn kho
            } else {
                unset($cart[$id]); // Xóa sản phẩm nếu không tồn tại
            }
        }

        session()->put('cart', $cart);

        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Phân trang giỏ hàng
        $cartCollection = collect($cart);
        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $cartCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedCart = new LengthAwarePaginator(
            $currentPageItems,
            $cartCollection->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Truyền dữ liệu giỏ hàng phân trang và tổng tiền sang view
        return view('gioHang', [
            'cart' => $paginatedCart,
            'totalPrice' => $totalPrice,
        ]);
    }





    public function addToCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:sach,MaSach',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Sach::find($request->id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại!',
            ]);
        }

        $cart = session()->get('cart', []);

        // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
        if (isset($cart[$product->MaSach])) {
            $cart[$product->MaSach]['quantity'] += $request->quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cart[$product->MaSach] = [
                'name' => $product->TenSach,
                'price' => $product->GiaBan,
                'quantity' => $request->quantity,
                'image' => $product->AnhDaiDien,
                'stock' => $product->SoLuongTon, // Đồng bộ số lượng tồn kho
            ];
        }

        session()->put('cart', $cart);

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

        $product = Sach::find($request->id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại!',
            ]);
        }

        // Kiểm tra số lượng tồn kho
        if ($request->quantity > $product->SoLuongTon) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể cập nhật vì vượt quá số lượng tồn kho!',
            ]);
        }

        // Cập nhật số lượng trong session
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            $cart[$request->id]['stock'] = $product->SoLuongTon; // Đồng bộ tồn kho
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
