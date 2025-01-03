<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStaffController extends Controller
{
    function index()
    {
        $nhanVienList = $this->getNhanVien();
        $viewData = [
            "title" => "Quản lý nhân viên",
            "subtitle" => "Quản Lý Nhân Viên",
            "nhanVienList" => $nhanVienList
        ];
        return view('admin.staff.index', $viewData); // Đảm bảo đường dẫn view chính xác
    }

    private function getNhanVien()
    {
        return DB::table('taikhoan')
            ->join('role', 'taikhoan.MaRole', '=', 'role.MaRole')
            ->select(
                'taikhoan.MaTK',
                'taikhoan.TenKH',
                'taikhoan.Email',
                'taikhoan.SDT',
                'taikhoan.DiaChi',
                'taikhoan.Image',
                'role.TenRole'
            )
            ->where('taikhoan.MaRole', 2) // Role Nhân viên
            ->where('taikhoan.TrangThai', 1) // Trạng thái hoạt động
            ->get();
    }

    public function create()
    {
        $roles = DB::table('role')->select('MaRole', 'TenRole')->get();
        $viewData = [
            "title" => "Thêm nhân viên",
            "subtitle" => "Thông tin nhân viên",
            "roles" => $roles
        ];
        return view('admin.staff.create', $viewData);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'TenKH' => 'required|max:50',
            'GioiTinh' => 'required',
            'NgaySinh' => 'required|date',
            'Email' => 'required|email|unique:taikhoan,Email',
            'SDT' => 'required|digits:11',
            'DiaChi' => 'required|max:50',
            'Image' => 'nullable|image|max:1024',
            'Username' => 'required|max:30|unique:taikhoan,Username',
            'Password' => 'required|min:6',
            'MaRole' => 'required|exists:role,MaRole',
            'TrangThai' => 'nullable|boolean',
        ]);

        // Lưu ảnh nếu có
        if ($request->hasFile('Image')) {
            $imageName = $request->file('Image')->store('images', 'public');
        } else {
            $imageName = null;
        }

        // Lưu thông tin nhân viên
        TaiKhoan::create([
            'TenKH' => $validated['TenKH'],
            'GioiTinh' => $validated['GioiTinh'],
            'NgaySinh' => $validated['NgaySinh'],
            'Email' => $validated['Email'],
            'SDT' => $validated['SDT'],
            'DiaChi' => $validated['DiaChi'],
            'Image' => $imageName,
            'Username' => $validated['Username'],
            'Password' => bcrypt($validated['Password']),
            'MaRole' => $validated['MaRole'],
            'TrangThai' => $validated['TrangThai'] ?? 0,
        ]);

        return redirect()->route('staff.index')->with('success', 'Thêm nhân viên thành công');
    }
}
