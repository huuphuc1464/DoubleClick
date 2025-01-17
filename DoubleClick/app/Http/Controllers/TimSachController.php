<?php

namespace App\Http\Controllers;

use App\Models\LoaiSach;
use App\Models\Sach;
use Illuminate\Http\Request;

class TimSachController extends Controller
{
    public function index()
    {
        $categories = LoaiSach::whereHas('sach', function ($query) {
            $query->where('TrangThai', 1);
        })->get();
        return view('timSach', compact('categories'));
    }

    public function laySachTheoMaLoai($maLoai, Request $request)
    {
        $perPage = 6; // Số lượng sách mỗi trang
        if ($maLoai === "getAll") {
            $query = Sach::query();
        } else {
            $query = Sach::where('MaLoai', $maLoai);
        }

        $sach = $query->where('TrangThai', 1)->paginate($perPage); // Chỉ lấy sách có trạng thái = 1

        return response()->json($sach);
    }

    public function timSachTheoTen(Request $request, $name = "getAll")
    {
        $perPage = 6; // Số lượng sách mỗi trang

        if ($name === "getAll") {
            $query = Sach::query();
        } else {
            $query = Sach::where('TenSach', 'like', '%' . $name . '%')
                ->orWhere('TenTG', 'like', '%' . $name . '%')
                ->orWhere('MoTa', 'like', '%' . $name . '%');
        }

        // Phân trang kết quả
        $sach = $query->where('TrangThai', 1)->paginate($perPage);

        return response()->json($sach);
    }

    public function locSachTheoGia(Request $request)
    {
        $perPage = 6; // Số lượng sách mỗi trang
        $priceRanges = explode(',', $request->input('khoangGia', ''));

        $query = Sach::query();

        foreach ($priceRanges as $range) {
            if (strpos($range, '-') !== false) {
                [$min, $max] = explode('-', $range);
                $query->orWhereBetween('GiaBan', [(int)$min, (int)$max]);
            } else {
                $query->orWhere('GiaBan', '>=', (int)$range);
            }
        }

        $sach = $query->where('TrangThai', 1)->paginate($perPage);

        return response()->json($sach);
    }
}
