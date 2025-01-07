<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;
<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
=======
>>>>>>> 2549eae (Sửa lỗi cho trang thêm voucher)
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 229cf5f8bb80bbaeaada5e54047a12fe3c41100a
use Illuminate\Support\Facades\Session;

class LoginUserController extends Controller
{
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    // Phương thức đăng nhập

=======
>>>>>>> 765b735 (Thêm xác thực Auth vào trang web, sửa lại popup đăng nhập, Thêm các model và middleware cần thiết)
=======
    // Phương thức đăng nhập
>>>>>>> 2549eae (Sửa lỗi cho trang thêm voucher)
=======
    // Phương thức đăng nhập

=======
>>>>>>> 80b50e973a8a86ba22f864cec51643e163045078
>>>>>>> 229cf5f8bb80bbaeaada5e54047a12fe3c41100a
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

<<<<<<< HEAD
<<<<<<< HEAD
        // Tìm tài khoản trong cơ sở dữ liệu
        $user = TaiKhoan::where('Email', $request->email)->first();
=======
        // Lấy thông tin email và password từ request
        $email = $request->input('email');
        $password = $request->input('password');

        // Kiểm tra người dùng trong cơ sở dữ liệu
        $user = TaiKhoan::where('Email', $email)->first();
>>>>>>> 2549eae (Sửa lỗi cho trang thêm voucher)
=======
        // Tìm tài khoản trong cơ sở dữ liệu
        $user = TaiKhoan::where('Email', $request->email)->first();
>>>>>>> 229cf5f8bb80bbaeaada5e54047a12fe3c41100a

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        // Kiểm tra mật khẩu
<<<<<<< HEAD
<<<<<<< HEAD
        if (!Hash::check($request->password, $user->Password)) {
=======
        if (!Hash::check($password, $user->Password)) {
>>>>>>> 2549eae (Sửa lỗi cho trang thêm voucher)
=======
        if (!Hash::check($request->password, $user->Password)) {
>>>>>>> 229cf5f8bb80bbaeaada5e54047a12fe3c41100a
            return redirect()->back()->withErrors(['password' => 'Mật khẩu không đúng.']);
        }

        // Lưu thông tin người dùng vào session
        Session::put('user', [
            'MaTK' => $user->MaTK,
            'MaRole' => $user->MaRole,
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 229cf5f8bb80bbaeaada5e54047a12fe3c41100a
            'Username' => $user->Username
        ]);
        return redirect()->route(route: 'user.products')->with([
            'success' => 'Đăng nhập thành công!',
=======
            'Username' => $user->Username,
<<<<<<< HEAD
>>>>>>> 765b735 (Thêm xác thực Auth vào trang web, sửa lại popup đăng nhập, Thêm các model và middleware cần thiết)
=======
>>>>>>> 80b50e973a8a86ba22f864cec51643e163045078
>>>>>>> 229cf5f8bb80bbaeaada5e54047a12fe3c41100a
        ]);

        return redirect()->route('user')->with('success', 'Đăng nhập thành công!');
    }
    

}












=======
            'Username' => $user->Username
        ]);
        return redirect()->route('user')->with([
            'success' => 'Đăng nhập thành công!',
        ]);
    }
}
>>>>>>> 2549eae (Sửa lỗi cho trang thêm voucher)
