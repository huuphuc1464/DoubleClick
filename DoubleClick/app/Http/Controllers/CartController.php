<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\Sach;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    // Hiển thị giỏ hàng

    public function index(Request $request)
    {
        $user = session('user'); // Lấy thông tin người dùng từ session
        $cartKey = 'cart_' . $user['MaTK']; // Key giỏ hàng theo MaTK

        $cart = session()->get($cartKey, []);

        foreach ($cart as $id => &$item) {
            $product = Sach::find($id);
            if ($product) {
                $item['price'] = $product->GiaBan; // Đồng bộ giá từ cơ sở dữ liệu
                $item['stock'] = $product->SoLuongTon; // Đồng bộ tồn kho
            } else {
                unset($cart[$id]); // Xóa sản phẩm nếu không tồn tại
            }
        }
        session()->put($cartKey, $cart);

        $totalPrice = session('totalPrice', 0); // Lấy tổng tiền từ session

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
            'totalPrice' => $totalPrice, // Sử dụng tổng tiền từ session
        ]);
    }

    public function getTotalPrice(Request $request)
    {
        $user = session('user');
        $cartKey = 'cart_' . $user['MaTK'];
        $cart = session()->get($cartKey, []);

        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return response()->json(['totalPrice' => $totalPrice]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:sach,MaSach',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Sach::find($request->id);
        $user = session('user'); // Lấy thông tin người dùng từ session
        $cartKey = 'cart_' . $user['MaTK']; // Key giỏ hàng theo MaTK

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
                'message' => 'Không thể thêm sản phẩm vì đã hết hàng hoặc không đủ số lượng tồn!',
            ]);
        }

        $cart = session()->get($cartKey, []);

        if (isset($cart[$product->MaSach])) {
            // Cộng dồn số lượng nếu sản phẩm đã tồn tại
            $cart[$product->MaSach]['quantity'] += $request->quantity;
            if ($cart[$product->MaSach]['quantity'] > $product->SoLuongTon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể thêm sản phẩm vì đã hết hàng hoặc không đủ số lượng tồn!',
                ]);
            }
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cart[$product->MaSach] = [
                'name' => $product->TenSach,
                'price' => $product->GiaBan,
                'quantity' => $request->quantity,
                'image' => $product->AnhDaiDien,
                'stock' => $product->SoLuongTon,
            ];
        }

        session()->put($cartKey, $cart);

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
        ]);
    }


    public function syncCart(Request $request)
    {
        $user = session('user');
        $cartKey = 'cart_' . $user['MaTK'];
        $cart = session()->get($cartKey, []);

        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return response()->json(['cart' => $cart, 'totalPrice' => $totalPrice]);
    }




    public function removeFromCart(Request $request)
    {

        $request->validate([
            'id' => 'required|integer|exists:sach,MaSach',
        ]);
        $user = session('user'); // Lấy thông tin người dùng từ session
        $cartKey = 'cart_' . $user['MaTK']; // Key giỏ hàng theo MaTK

        $cart = session()->get($cartKey, []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put($cartKey, $cart);

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
        $user = session('user'); // Lấy thông tin người dùng từ session
        $cartKey = 'cart_' . $user['MaTK']; // Key giỏ hàng theo MaTK

        session()->forget($cartKey);

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

        $user = session('user');
        $cartKey = 'cart_' . $user['MaTK'];
        $cart = session()->get($cartKey, []);

        $product = Sach::find($request->id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại!',
            ]);
        }

        // Kiểm tra tồn kho
        if ($request->quantity > $product->SoLuongTon) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể cập nhật vì vượt quá số lượng tồn kho!',
            ]);
        }

        // Cập nhật số lượng
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            $cart[$request->id]['stock'] = $product->SoLuongTon;
            session()->put($cartKey, $cart);

            // Tính lại tổng tiền
            $totalPrice = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            // Cập nhật lại tổng tiền vào session
            Session::put('totalPrice', $totalPrice);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công!',
                'cart' => $cart,
                'totalPrice' => $totalPrice,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!',
        ]);
    }



    public function getCartSummary()
    {
        $cart = Session::get('cart', []);
        $totalPrice = session('totalPrice', 0); // Lấy tổng tiền từ session

        return response()->json([
            'totalItems' => count($cart),
            'totalPrice' => $totalPrice,
        ]);
    }

}
