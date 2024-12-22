<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
{
    $contacts = \App\Models\DanhSachLienHe::all(); // Lấy toàn bộ dữ liệu từ bảng danhSachLienHe
    return view('danhSachLienHe', compact('contacts'));
}


}
