<?php

namespace App\Http\Controllers;

use App\Models\Sach;
use App\Models\LoaiSach;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $discount1 = (int)Sach::where('MaSach', '=', 10)->pluck('KhuyenMai')->first();
        $discount2 = (int)Sach::where('MaSach', '=', 11)->pluck('KhuyenMai')->first();
        $discount3 = (int)Sach::where('MaSach', '=', 12)->pluck('KhuyenMai')->first();
        $discount4 = (int)Sach::where('MaSach', '=', 13)->pluck('KhuyenMai')->first();

        $banners = [
            ['imagebanner' => 'banner1.png', 'contactlink' => '', 'discount' => $discount1],
            ['imagebanner' => 'banner2.png', 'contactlink' => '', 'discount' => $discount2],
            ['imagebanner' => 'banner3.png', 'contactlink' => '', 'discount' => $discount3],
            ['imagebanner' => 'banner4.png', 'contactlink' => '', 'discount' => $discount4],
        ];

        // Lấy danh sách sách từ cơ sở dữ liệu
        $sach = Sach::all(); // Truy vấn tất cả sản phẩm sách

        $loaiSach = LoaiSach::all();

        // Trả về view và truyền dữ liệu banners và sach
        return view('user.products', compact('banners', 'sach', 'loaiSach'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
