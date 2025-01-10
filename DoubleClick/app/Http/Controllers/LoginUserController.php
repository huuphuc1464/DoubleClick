<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Session;

class LoginUserController extends Controller
{
    public function login(Request $request)
{
    // Validate dữ liệu đầu vào
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Lấy thông tin email và password từ request
    $email = $request->input('email');
    $password = $request->input('password');

    // Tìm tài khoản trong cơ sở dữ liệu
    $user = TaiKhoan::where('Email', $email)->first();

    // Kiểm tra email tồn tại
    if (!$user) {
        return redirect()->back()->withErrors(['email' => 'Email không tồn tại.']);
    }

    // Kiểm tra mật khẩu
    if (!Hash::check($password, $user->Password)) {
        return redirect()->back()->withErrors(['password' => 'Mật khẩu không đúng.']);
    }

    // Lưu thông tin người dùng vào session
    Session::put('user', [
        'MaTK' => $user->MaTK,
        'MaRole' => $user->MaRole,
        'Username' => $user->Username,
    ]);

    // Kiểm tra vai trò (MaRole) và chuyển hướng
    if ($user->MaRole == 1 || $user->MaRole == 2) {
        return redirect('/')->with('success', 'Đăng nhập thành công với quyền Admin!');
    } elseif ($user->MaRole == 3) {
        return redirect()->route('user.products')->with([
            'success' => 'Đăng nhập thành công!',
            'Username' => $user->Username,
        ]);
    }

    // Nếu vai trò không hợp lệ
    return redirect()->back()->withErrors(['role' => 'Vai trò không hợp lệ.']);
}

}
