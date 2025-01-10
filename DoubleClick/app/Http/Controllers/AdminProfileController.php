<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function index()
    {
        $Username = session('Username');
        $MaRole = session('MaRole');

        $account = DB::table('taikhoan')
            ->join('role', 'taikhoan.MaRole', '=', 'role.MaRole')
            ->select('taikhoan.*', 'role.TenRole')
            ->where('taikhoan.Username', $Username)
            ->where('taikhoan.MaRole', $MaRole)
            ->first();

        return view('Admin.Profile.index', compact('account'));
    }
    public function DoiMatKhau()
    {
        $MaTK = session('MaTK');
        return view('Admin.Profile.doimatkhau', compact('MaTK'));
    }
    public function updatePass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old-password' => 'required|string',
            'new-password' => 'required|string|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/|confirmed', // Kiểm tra mật khẩu mới phải có ít nhất 1 chữ và 1 số
            'new-password_confirmation' => 'required|string|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        ], [
            'new-password.confirmed' => 'Mật khẩu mới và nhập lại mật khẩu mới không khớp.',
            'new-password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'new-password.max' => 'Mật khẩu mới không được vượt quá 32 ký tự.',
            'new-password.regex' => 'Mật khẩu mới phải chứa ít nhất một chữ cái và một số.',
            'new-password_confirmation.min' => 'Nhập lại mật khẩu mới phải có ít nhất 8 ký tự.',
            'new-password_confirmation.max' => 'Nhập lại mật khẩu mới không được vượt quá 32 ký tự.',
            'new-password_confirmation.regex' => 'Nhập lại mật khẩu phải chứa ít nhất một chữ cái và một số.',
        ]);

        // Kiểm tra xem có lỗi xác thực không
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Tìm người dùng hiện tại (đảm bảo MaTK đúng và có người dùng)
        $user = TaiKhoan::find($request->MaTK)->first();
        if (!$user) {
            return back()->withErrors(['MaTK' => 'Không tìm thấy tài khoản người dùng.'])->withInput();
        }

        // Kiểm tra mật khẩu cũ có đúng không
        if (!Hash::check($request->input('old-password'), $user->Password)) {
            return back()->withErrors(['old-password' => 'Mật khẩu cũ không chính xác.'])->withInput();
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->input('new-password')); // Mã hóa mật khẩu mới
        $user->save();

        return redirect()->route('admin.profile.index')->with('success', 'Mật khẩu đã được thay đổi thành công!');
    }
}
