<?php

namespace App\Http\Controllers;

use App\Models\AnhSach;
use App\Models\DanhGia;
use App\Models\Sach; // Giả sử bạn có model Sach cho sản phẩm sách
use Database\Seeders\AnhSachSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChiTietSanPhamController extends Controller
{
    public function show($id)
    {

        $sach = sach::findOrFail(id: $id);

        $danhgia = DanhGia::with('user')->where('MaSach', $id)->get();

        $anhsach = DB::table('anhsach')->where('MaSach', $id)->get();
        //dd($anhsach);
        // Tăng số lượt xem của sản phẩm
        $sach->increment('luot_xem');

        $relatedProducts = sach::where('MaLoai', $sach->MaLoai)
            ->where('MaSach', '!=', $id) // Loại trừ sản phẩm hiện tại
            ->take(6) // Lấy tối đa 6 sản phẩm liên quan
            ->get();

        // Trả về view với dữ liệu sản phẩm

        return view('user.chitietsanpham', compact('sach', 'anhsach', 'danhgia', 'relatedProducts'));
    }
    public function getRealTimeStats($id)
    {
        $sach = Sach::find($id);
        $luot_xem = $sach->luot_xem;
        $luot_tim = $sach->luot_tim ?? 0;
        //$avg_rating = $sach->danhGia()->avg('SoSao');

        return response()->json([
            'luot_xem' => $luot_xem,
            'luot_tim' => $luot_tim,
            //'avg_rating' => $avg_rating,
        ]);
    }
    public function store(Request $request)
    {
        // Kiểm tra xác thực người dùng (bạn có thể thay đổi logic này theo cách bạn quản lý người dùng)
        if (!session('user') || !session('user')['MaTK']) {
            return redirect()->back()->withErrors('Bạn cần đăng nhập để thực hiện đánh giá.');
        }

        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'SoSao' => 'required|integer|min:1|max:5',
            'DanhGia' => 'required|string|max:255',
            'MaSach' => 'required|exists:sach', // Đảm bảo sách tồn tại
        ]);

        $maTK = session('user')['MaTK'];
        $maSach = $request->input('MaSach');
        $tontai = DB::table('hoadon')
            ->join('chitiethoadon', 'chitiethoadon.MaHD', '=', 'hoadon.MaHD')
            ->where('chitiethoadon.MaSach', '=', $maSach)
            ->where('hoadon.MaTK', '=', $maTK)
            ->where('hoadon.TrangThai', '=', 3)
            ->first();

        if ($tontai == null) {
            return redirect()->back()->with('error', 'Bạn chưa mua sách này nên không thể đánh giá!');
        }

        $daDanhGia = DB::table('danhgia')
            ->where('MaSach', '=', $maSach)
            ->where('MaTK', '=', $maTK)
            ->first();
        if ($daDanhGia != null) {
            return redirect()->back()->with('error', 'Bạn đã đánh giá sách này rồi!');
        }
        DB::table('DanhGia')->insert([
            'MaTK' => $maTK,
            'MaSach' => $maSach,
            'SoSao' => $validated['SoSao'],
            'DanhGia' => $validated['DanhGia'],
            'NgayDang' => now(),
        ]);

        // Trả về với thông báo thành công
        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi!');
    }
    public function getImagesByBook($id)
    {
        // Lấy danh sách hình ảnh theo MaSach
        $anhsach = AnhSach::where('MaSach', $id)->get();

        if ($anhsach->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy hình ảnh cho sách này'], 404);
        }
        dd($anhsach);

        return response()->json($anhsach, 200);
    }
}
