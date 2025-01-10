<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegisterForm()
{
    return view(view: 'register');  // trả về view đăng ký
}

    public function register(Request $request)
    {
        // Xác thực dữ liệu người dùng
        $validator = Validator::make($request->all(), [
            'TenTK' => 'required|string|max:255',
            'GioiTinh' => 'required|in:Nam,Nữ',
            'NgaySinh' => 'required|date',
            'SDT' => 'required|regex:/^[0-9]{10}$/',
            'DiaChi' => 'required|string|max:255',
            'Username' => 'required|string|unique:taikhoan,Username|max:255',
            'Email' => 'required|email|unique:taikhoan,Email|max:255',
            'Password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register.form')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Tạo tài khoản mới
        TaiKhoan::create([
            'TenTK' => $request->TenTK,
            'GioiTinh' => $request->GioiTinh,
            'NgaySinh' => $request->NgaySinh,
            'SDT' => $request->SDT,
            'DiaChi' => $request->DiaChi,
            'Username' => $request->Username,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'MaRole' => 3, // Guest, bạn có thể thay đổi vai trò nếu cần
            'TrangThai' => 1, // Hoạt động
            'Image' => 'default_guest.png', // Đặt ảnh mặc định cho người dùng mới
        ]);

        // Chuyển hướng đến trang đăng nhập hoặc thông báo thành công
        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công! Bạn có thể đăng nhập ngay.');
    }
}
