<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUserController extends Controller
{
    public function showContactForm()
    {
        return view('lienHe');
    }

    public function submitContactForm(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'HoTen' => [
                'required',
                'max:30',
                'regex:/^[\p{L}\s]+$/u', // Chỉ cho phép chữ cái và khoảng trắng (hỗ trợ Unicode)
            ],
            'Email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]{1,40}@gmail\.com$/', // Giới hạn 40 ký tự cho phần tên và kết thúc bằng @gmail.com
                'max:50',
            ],
            'SDT' => [
                'required',
                'regex:/^0\d{9}$/', // Số điện thoại phải bắt đầu bằng 0 và có đúng 10 chữ số
            ],
            'NoiDung' => [
                'required',
                'max:500',
            ],
        ]);

        \App\Models\DanhSachLienHe::create([
            'HoTen' => $request->HoTen,
            'Email' => $request->Email,
            'SDT' => $request->SDT,
            'NoiDung' => $request->NoiDung,
            'TrangThai' => 2,
        ]);

        return redirect()->back()->with('success', 'Yêu cầu liên hệ của bạn đã được gửi thành công!');

    }
}
