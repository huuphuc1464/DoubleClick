<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Session;

class LoginUserController extends Controller
{
    // Phương thức đăng nhập
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

        // Kiểm tra người dùng trong cơ sở dữ liệu
        $user = TaiKhoan::where('Email', $email)->first();

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
        ]);
        return redirect()->route('user')->with([
            'success' => 'Đăng nhập thành công!',
        ]);
    }
}
