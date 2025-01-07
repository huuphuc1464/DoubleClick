<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginUserController extends Controller
{
<<<<<<< HEAD
    // Phương thức đăng nhập

=======
>>>>>>> 80b50e973a8a86ba22f864cec51643e163045078
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tìm tài khoản trong cơ sở dữ liệu
        $user = TaiKhoan::where('Email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        // Kiểm tra mật khẩu
        if (!Hash::check($request->password, $user->Password)) {
            return redirect()->back()->withErrors(['password' => 'Mật khẩu không đúng.']);
        }

        // Lưu thông tin người dùng vào session
        Session::put('user', [
            'MaTK' => $user->MaTK,
            'MaRole' => $user->MaRole,
<<<<<<< HEAD
            'Username' => $user->Username
        ]);
        return redirect()->route(route: 'user.products')->with([
            'success' => 'Đăng nhập thành công!',
=======
            'Username' => $user->Username,
>>>>>>> 80b50e973a8a86ba22f864cec51643e163045078
        ]);

        return redirect()->route('user')->with('success', 'Đăng nhập thành công!');
    }
    

}












