<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan; // Giả sử bạn có model TaiKhoan tương ứng với bảng người dùng.

class ForgotPasswordController extends Controller
{
    // Hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('forgot-password'); // Tạo view forgot-password.blade.php
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email|exists:TaiKhoan,Email',  // Kiểm tra email tồn tại trong bảng người dùng
            'new_password' => 'required|string|min:6|confirmed', // Kiểm tra mật khẩu đủ điều kiện và xác nhận
        ]);

        // Tìm người dùng theo email
        $user = TaiKhoan::where('Email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        // Cập nhật mật khẩu mới
        $user->Password = Hash::make($request->new_password);
        $user->save();

        // Chuyển hướng và thông báo thành công
        return redirect()->route('forgotpass.form')->with('success', 'Mật khẩu đã được đặt lại thành công. Vui lòng đăng nhập!');
    }
}
