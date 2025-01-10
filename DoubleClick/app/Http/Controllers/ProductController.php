<?php

namespace App\Http\Controllers;

use App\Models\Sach;
use Illuminate\Support\Facades\DB;
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
            ['imagebanner' => 'banner1.png', 'contactlink' => '/san-pham/10', 'discount' => $discount1],
            ['imagebanner' => 'banner2.png', 'contactlink' => '/san-pham/11', 'discount' => $discount2],
            ['imagebanner' => 'banner3.png', 'contactlink' => '/san-pham/12', 'discount' => $discount3],
            ['imagebanner' => 'banner4.png', 'contactlink' => '/san-pham/13', 'discount' => $discount4],
            ['imagebanner' => 'banner1.png', 'contactlink' => '/san-pham/10', 'discount' => $discount1],
            ['imagebanner' => 'banner2.png', 'contactlink' => '/san-pham/11', 'discount' => $discount2],
            ['imagebanner' => 'banner3.png', 'contactlink' => '/san-pham/12', 'discount' => $discount3],
            ['imagebanner' => 'banner4.png', 'contactlink' => '/san-pham/13', 'discount' => $discount4],
        ];
        $sach = Sach::all(); // Truy vấn tất cả sản phẩm sách
        $loaiSach = LoaiSach::all();

        // Trả về view và truyền dữ liệu banners và sach
        return view('user.products', compact('banners', 'sach', 'loaiSach'));
    }
}
