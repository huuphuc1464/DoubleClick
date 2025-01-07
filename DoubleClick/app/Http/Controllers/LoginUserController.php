<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;

use Illuminate\Support\Facades\Auth;
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

        // Tìm tài khoản trong cơ sở dữ liệu
        $user = TaiKhoan::where('Email', $request->email)->first();

        // Lấy thông tin email và password từ request
        $email = $request->input('email');
        $password = $request->input('password');

        $user = TaiKhoan::where('Email', $request->email)->first();


        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại.']);
        }


        if (!Hash::check($password, $user->Password)) {
            return redirect()->back()->withErrors(['password' => 'Mật khẩu không đúng.']);
        }

        // Lưu thông tin người dùng vào session
        Session::put('user', [
            'MaTK' => $user->MaTK,
            'MaRole' => $user->MaRole,
            'Username' => $user->Username
        ]);
        return redirect()->route(route: 'user.products')->with([
            'success' => 'Đăng nhập thành công!',
            'Username' => $user->Username,
        ]);

        return redirect()->route('user')->with('success', 'Đăng nhập thành công!');
    }
}

