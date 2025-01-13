<?php

namespace App\Http\Controllers;

use App\Models\Sach;
use App\Models\ChiTietHoaDon;
use App\Models\LoaiSach;
use Illuminate\Support\Facades\DB;
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
        ];

        $sach = Sach::all();
        $bestseller = DB::table('sach')
            ->join('chitiethoadon', 'sach.MaSach', '=', 'chitiethoadon.MaSach')
            ->groupBy('MaSach')
            ->orderBy('chitiethoadon.SLMua', 'desc')
            ->select('sach.MaSach')
            ->get();
        $loaiSach = LoaiSach::all();

        // Trả về view và truyền dữ liệu banners và sach
        return view('user.products', compact('banners', 'sach', 'bestseller', 'loaiSach'));
    }

    public function vanHoc()
    {
        $sach = Sach::all(); // Truy vấn tất cả sản phẩm sách
        $data = DB::table('sach')
            ->where('MaLoai', '=', 1)
            ->get();
        $title = "Danh Sách Sách Văn Học";
        return view('user.viewall', compact('sach', 'data', 'title'));
    }
    public function truyenTranh()
    {
        $sach = Sach::all(); // Truy vấn tất cả sản phẩm sách
        $data = DB::table('sach')
            ->join('loaisach', 'sach.MaLoai', '=', 'loaisach.MaLoai')
            ->where('loaisach.MaLoai', '=', 4)
            ->get();
        $title = "Danh Sách Truyện Tranh";
        return view('user.viewall', compact('sach', 'data', 'title'));
    }

    public function bestSeller()
    {
        $sach = Sach::all(); // Truy vấn tất cả sản phẩm sách
        $data = DB::table('sach')
            ->join('chitiethoadon', 'sach.MaSach', '=', 'chitiethoadon.MaSach')
            ->groupBy('MaSach')
            ->orderBy('chitiethoadon.SLMua', 'desc')
            ->select('sach.MaSach')
            ->get();

        $title =  "Danh Sách Sản Phẩm Bán Chạy";

        // Trả về view và truyền dữ liệu banners và sach
        return view('user.viewall', compact('sach', 'data', 'title'));
    }

    public function newBook()
    {
        $sach = Sach::all(); // Truy vấn tất cả sản phẩm sách
        $data = DB::table('sach')
            ->orderBy('MaSach', 'desc')
            ->get();
        $title =  "Danh Sách Sản Phẩm Mới";
        // Trả về view và truyền dữ liệu banners và sach
        return view('user.viewall', compact('sach', 'data', 'title'));
    }

    public function  laySachTheoMaLoai($maLoai)
    {
        if ($maLoai == "getAll") {
            $sach = Sach::all();
        } else {
            $sach = Sach::where('MaLoai', $maLoai)->get();
        }

        return response()->json($sach);
    }

    public function timSachTheoTen($name)
    {

        if ($name === "getAll") {
            $sach = Sach::all();
        } else {
            $sach = Sach::where('TenSach', 'like', '%' . $name . '%')
                ->orWhere('TenTG', 'like', '%' . $name . '%')
                ->orWhere('MoTa', 'like', '%' . $name . '%')
                ->get();
        }

        return response()->json($sach);
    }

    public function getBestSellerFooter()
    {
        $data = DB::table('sach')
            ->join('chitiethoadon', 'sach.MaSach', '=', 'chitiethoadon.MaSach')
            ->select('sach.MaSach', 'sach.TenSach', 'sach.TenTG', 'sach.AnhDaiDien', DB::raw('SUM(chitiethoadon.SLMua) as TotalSold'))
            ->groupBy('sach.MaSach', 'sach.TenSach', 'sach.TenTG', 'sach.AnhDaiDien')
            ->orderBy('TotalSold', 'desc')
            ->take(3)
            ->get();

        return response()->json($data);
    }
}
