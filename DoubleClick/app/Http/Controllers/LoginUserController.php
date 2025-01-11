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
        'username' => 'required|string',  // Thay đổi từ email sang username
        'password' => 'required|string',
    ]);

    // Lấy thông tin username và password từ request
    $username = $request->input('username');  // Lấy username thay vì email
    $password = $request->input('password');

    // Tìm tài khoản trong cơ sở dữ liệu theo username
    $user = TaiKhoan::where('Username', $username)->first();  // Tìm kiếm theo Username

    // Kiểm tra username tồn tại
    if (!$user) {
        return redirect()->back()->withErrors(['username' => 'Username không tồn tại.']);
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
        return redirect()->route('admin.layout')->with('success', 'Đăng nhập thành công với quyền Admin!');
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
