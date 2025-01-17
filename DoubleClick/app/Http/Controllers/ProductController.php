<?php

namespace App\Http\Controllers;

use App\Models\Sach;
use App\Models\ChiTietHoaDon;
use App\Models\LoaiSach;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
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
        $bestseller = DB::table('hoadon')
            ->join('chitiethoadon', 'hoadon.MaHD', '=', 'chitiethoadon.MaHD')
            ->whereRaw("DATEDIFF(?, NgayLapHD) <= ?", [$current_time, 30])
            ->groupBy('MaSach')
            ->select('chitiethoadon.MaSach', DB::raw('SUM(chitiethoadon.SLMua) as total_SLMua'))
            ->orderBy('total_SLMua', 'desc')
            ->get();
        $newproduct = DB::table('sach')
            ->orderBy('MaSach', 'desc')
            ->get();
        $cate = DB::table('loaisach')->select('MaLoai')->take(3)->get();
        $arr = [];
        foreach ($cate as $item) {
            $arr[] = $item->MaLoai;
        }
        $data = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->whereIn('sach.MaLoai', $arr)
            ->select('sach.*', 'loaisach.TenLoai')
            ->get()
            ->groupBy('MaLoai');  // Nhóm theo MaLoai

        $loaiSach = LoaiSach::all();

        // Trả về view và truyền dữ liệu banners và sach
        return view('user.products', compact('banners', 'sach', 'bestseller', 'loaiSach', 'newproduct', 'data'));
    }

    public function dsSachYeuThich()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem danh sách yêu thích');
        }
        $title = "Sách yêu thích";
        $wishlist = DB::table('dsyeuthich')->join('sach', 'dsyeuthich.MaSach', '=', 'sach.MaSach')->where('dsyeuthich.MaTK', '=', $user->id)->select('sach.TenSach', 'sach.GiaBan', 'sach.AnhDaiDien', 'dsyeuthich.*')->paginate(5);
        return view('Profile.sachyeuthich', compact('wishlist', 'title'));
    }

    public function addToFavorites(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->input('bookId');
        if (!$user) {
            return response()
                ->json(['error' => 'Bạn cần đăng nhập để thêm yêu thích'], 403);
        } // Kiểm tra nếu sách đã được yêu thích
        $favorite = DB::table('dsyeuthich')
            ->where('MaTK', $user->id)
            ->where('MaSach', $bookId)->first();
        if ($favorite) {
            return response()->json(['message' => 'Sách này đã được yêu thích']);
        } // Thêm sách vào danh sách yêu thích
        DB::table('dsyeuthich')
            ->insert(['MaTK' => $user->id, 'MaSach' => $bookId,]);
        return response()->json(['message' => 'Sách đã được thêm vào danh sách yêu thích']);
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

    public function getBestSeller($soLuong)
    {
        $data = DB::table('sach')
            ->join('chitiethoadon', 'sach.MaSach', '=', 'chitiethoadon.MaSach')
            ->select('sach.MaSach', 'sach.TenSach', 'sach.TenTG', 'sach.AnhDaiDien', 'sach.MoTa', 'Sach.GiaBan', DB::raw('SUM(chitiethoadon.SLMua) as TotalSold'))
            ->groupBy('sach.MaSach', 'sach.TenSach', 'sach.TenTG', 'sach.AnhDaiDien', 'sach.MoTa', 'Sach.GiaBan')
            ->orderBy('TotalSold', 'desc')
            ->take($soLuong)
            ->get();

        return response()->json($data);
    }
}
