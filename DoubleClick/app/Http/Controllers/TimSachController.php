<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiSach;

class TimSachController extends Controller
{
    public function index()
    {
        // Lấy tất cả loại sách và các sách liên quan
        $loaiSach = LoaiSach::with('sach')->get();

        return view('timSach', compact('loaiSach'));
    }
}
