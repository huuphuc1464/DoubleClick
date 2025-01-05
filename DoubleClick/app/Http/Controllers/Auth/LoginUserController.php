<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;

class LoginUserController extends Controller
{
    /**
     * Xử lý đăng nhập.
     */
    public function login(Request $request)
{
    // Validate dữ liệu đầu vào
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('username', 'password');

    $user = TaiKhoan::where('Username', $credentials['username'])->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Tên đăng nhập không tồn tại.',
        ], 404);
    }

    // Kiểm tra mật khẩu
    if (!Hash::check($credentials['password'], $user->Password)) {
        return response()->json([
            'success' => false,
            'message' => 'Mật khẩu không đúng.',
        ], 401);
    }

    // Đăng nhập thành công
    return response()->json([
        'success' => true,
        'message' => 'Đăng nhập thành công!',
        'user' => $user,
    ]);
}


}
