<?php

namespace App\Http\Controllers;

use App\Models\Sach;
use App\Models\LoaiSach;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $current_time = now()->format('Y-m-d H:i:s');
        $banners = DB::table('banners')
            ->join('sach', 'banners.MaSach', '=', 'sach.MaSach')
            ->get();


        $sach = Sach::all();
        // $bestseller = DB::table('sach')
        //     ->join('chitiethoadon', 'sach.MaSach', '=', 'chitiethoadon.MaSach')
        //     ->groupBy('MaSach')
        //     ->orderBy('chitiethoadon.SLMua', 'desc')
        //     ->select('sach.MaSach')
        //     ->get();
        $bestseller = DB::table('hoadon')
            ->join('chitiethoadon', 'hoadon.MaHD', '=', 'chitiethoadon.MaHD')
            // ->where($current_time - 'chitiethoadon.NgayLapHD', '<=', 30)
            ->whereRaw("DATEDIFF(?, NgayLapHD) <= ?", [$current_time, 30])
            ->groupBy('MaSach')
            ->orderBy('chitiethoadon.SLMua', 'desc')
            ->select('chitiethoadon.MaSach')
            ->get();
        $newproduct = DB::table('sach')
            ->orderBy('MaSach', 'desc')
            ->get();
        $vanhoc = DB::table('sach')
            ->where('MaLoai', '=', 1)
            ->get();


        $loaiSach = LoaiSach::all();

        // Trả về view và truyền dữ liệu banners và sach
        return view('user.products', compact('banners', 'sach', 'bestseller', 'loaiSach', 'newproduct', 'vanhoc'));
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
        $current_time = now()->format('Y-m-d H:i:s');
        // Định dạng lại thời gian        

        $data = DB::table('hoadon')
            ->join('chitiethoadon', 'hoadon.MaHD', '=', 'chitiethoadon.MaHD')
            ->where(`$current_time - chitiethoadon.NgayLapHD`, '<=', 30)
            ->groupBy('MaSach')
            ->orderBy('chitiethoadon.SLMua', 'desc')
            ->select('chitiethoadon.MaSach')
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
