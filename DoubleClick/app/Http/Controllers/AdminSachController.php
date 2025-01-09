<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSachController extends Controller
{
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $search = $request->input('search');

        // Truy vấn sách đang bán
        $sach = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->where('sach.TrangThai', '=', 1)
            ->when($search, function ($query, $search) {
                return $query->where('sach.TenSach', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        // Truy vấn sách ngừng bán
        $ngungban = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->where('sach.TrangThai', '=', 0)
            ->when($search, function ($query, $search) {
                return $query->where('sach.TenSach', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        // Truy vấn sách hết hàng
        $hethang = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->where('sach.TrangThai', '=', 1)
            ->where('SoLuongTon', '<', 10)
            ->when($search, function ($query, $search) {
                return $query->where('sach.TenSach', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        // Trả về view với các dữ liệu đã lọc
        return view('Admin.Sach.index', compact('sach', 'ngungban', 'hethang'));
    }
    public function update()
    {
        return view('Admin.Sach.update');
    }
    public function detail()
    {
        return view('Admin.Sach.detail');
    }
    public function insert()
    {
        return view('Admin.Sach.insert');
    }
}
