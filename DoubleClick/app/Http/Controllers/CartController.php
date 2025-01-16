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

        // Cập nhật lại giỏ hàng trong session
        session()->put($cartKey, $cart);

        // Tính lại tổng số sản phẩm trong giỏ hàng (mỗi sản phẩm tính 1 lần)
        $cartCount = count($cart); // Đếm số loại sản phẩm

        // Cập nhật lại tổng số sản phẩm vào session
        session()->put('cartCount', $cartCount);

        // Tính lại tổng tiền sau khi thêm sản phẩm
        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Cập nhật lại tổng tiền vào session
        Session::put('totalPrice',
            $totalPrice
        );

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            'totalPrice' => $totalPrice,  // Trả về tổng tiền mới
            'cartCount' => $cartCount  // Trả về tổng số sản phẩm trong giỏ hàng
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
            // Lưu lại giá trị tiền của sản phẩm bị xóa
            $product = $cart[$request->id];
            $productTotalPrice = $product['price'] * $product['quantity'];

            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$request->id]);
            session()->put($cartKey, $cart);

            // Cập nhật lại tổng số sản phẩm trong giỏ hàng
            $cartCount = count($cart); // Đếm số loại sản phẩm
            session()->put('cartCount', $cartCount);

            // Tính lại tổng tiền sau khi xóa sản phẩm
            $totalPrice = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            // Cập nhật lại tổng tiền vào session
            Session::put('totalPrice', $totalPrice);

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!',
                'cartCount' => $cartCount,  // Trả về tổng số sản phẩm
                'totalPrice' => $totalPrice,  // Trả về tổng tiền sau khi xóa sản phẩm
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

        // Xóa giỏ hàng trong session
        session()->forget($cartKey);

        // Cập nhật lại tổng tiền về 0
        Session::put('totalPrice',
            0
        );

        // Cập nhật lại số lượng sản phẩm trong giỏ hàng về 0
        session()->put('cartCount', 0);

        return response()->json([
            'success' => true,
            'message' => 'Giỏ hàng đã được xóa hoàn toàn!',
            'totalPrice' => 0,  // Trả về tổng tiền là 0 sau khi xóa giỏ hàng
            'cartCount' => 0    // Trả về số lượng sản phẩm là 0 sau khi xóa giỏ hàng
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

            // Cập nhật lại tổng số sản phẩm trong giỏ hàng
            $cartCount = count($cart); // Đếm số loại sản phẩm

            // Cập nhật lại tổng số sản phẩm vào session
            session()->put('cartCount', $cartCount);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công!',
                'cart' => $cart,
                'totalPrice' => $totalPrice,
                'cartCount' => $cartCount,  // Trả về tổng số sản phẩm
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
