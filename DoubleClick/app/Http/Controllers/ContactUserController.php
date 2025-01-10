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
        $request->validate([
            'HoTen' => 'required|max:255',
            'Email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'],
            'SDT' => ['required', 'regex:/^0\d{9}$/'],
            'NoiDung' => 'required|max:1000',
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
