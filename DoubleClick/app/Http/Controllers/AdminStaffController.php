<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan; // Đảm bảo rằng bạn đã tạo model TaiKhoan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class AdminStaffController extends Controller
{
    public function index()
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
                'taikhoan.TenTK', // Sử dụng TenTK thay vì TenKH
                'taikhoan.Email',
                'taikhoan.SDT',
                'taikhoan.DiaChi',
                'taikhoan.Image',
                'role.TenRole'
            )
            ->where('taikhoan.TrangThai', 1) // Trạng thái hoạt động
            ->simplePaginate(5); // Sử dụng simplePaginate để chỉ hiển thị Previous và Next
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
            'TenTK' => 'required|max:50',
            'GioiTinh' => 'required|max:3',
            'NgaySinh' => 'required|date',
            'Email' => 'required|email|unique:taikhoan,Email',
            'SDT' => 'required|digits:11',
            'DiaChi' => 'required|max:50',
            'Image' => 'nullable|image|max:1024',
            'Username' => 'required|max:30|unique:taikhoan,Username',
            'Password' => 'required|min:6',
            'MaRole' => 'required|exists:role,MaRole',
            'TrangThai' => 'nullable|boolean'
        ]);

        // Lưu ảnh nếu có
        if ($request->hasFile('Image')) {
            $imageName = $request->file('Image')->store('img/storage', 'public');
        } else {
            $imageName = null;
        }

        // Lưu thông tin nhân viên
        TaiKhoan::create([
            'TenTK' => $validated['TenTK'],
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
    public function listDeleted()
    {
        $nhanVienListDeleted = DB::table('taikhoan')->where('TrangThai', 0)->get();
        $viewData = [
            "title" => "Quản lý nhân viên",
            "subtitle" => "Quản Lý Nhân Viên",
            "nhanVienListDeleted" => $nhanVienListDeleted
        ];
        return view('admin.staff.delete', $viewData); // Đảm bảo đường dẫn view chính xác

    }
    public function delete($id)
    {
        $nhanVienListDeleted = DB::table('taikhoan')->where('MaTK', $id)->update(['TrangThai' => 0]);
        return back();
    }


    public function restore($id)
    {
        // Kiểm tra nếu tài khoản tồn tại
        $taiKhoan = DB::table('taikhoan')->where('MaTK', $id)->first();

        if ($taiKhoan) {
            // Khôi phục tài khoản
            DB::table('taikhoan')->where('MaTK', $id)->update(['TrangThai' => 1]);

            // Lấy danh sách nhân viên sau khi khôi phục tài khoản với phân trang
            $nhanVienList = DB::table('taikhoan')->paginate(10);
            $nhanVienListDeleted = DB::table('taikhoan')->where('TrangThai', 0)->paginate(10);

            $viewData = [
                "title" => "Quản lý nhân viên",
                "subtitle" => "Quản Lý Nhân Viên",
                "nhanVienList" => $nhanVienList,
                "nhanVienListDeleted" => $nhanVienListDeleted
            ];

            // Chuyển về trang index với dữ liệu mới và thông báo thành công
            return back()->with('success', 'Khôi phục tài khoản thành công');
            // return redirect()->route('staff.index')->with('success', 'Khôi phục tài khoản thành công');
        } else {
            // Chuyển về trang trước với thông báo lỗi
            return back()->with('error', 'Không tìm thấy tài khoản');
        }
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $nhanVienList = DB::table('taikhoan')
            ->join('role', 'taikhoan.MaRole', '=', 'role.MaRole')
            ->select(
                'taikhoan.MaTK',
                'taikhoan.TenTK',
                'taikhoan.Email',
                'taikhoan.SDT',
                'taikhoan.DiaChi',
                'taikhoan.Image',
                'role.TenRole'
            )
            ->where('taikhoan.TrangThai', 1) // Trạng thái hoạt động
            ->where('taikhoan.TenTK', 'LIKE', "%{$query}%") // Tìm kiếm theo tên nhân viên
            ->simplePaginate(5); // Sử dụng simplePaginate để chỉ hiển thị Previous và Next

        $viewData = [
            "title" => "Quản lý nhân viên",
            "subtitle" => "Quản Lý Nhân Viên",
            "nhanVienList" => $nhanVienList
        ];

        return view('admin.staff.index', $viewData);
    }

    public function infoNhanVien($id)
    {
        // Lấy dữ liệu nhân viên theo ID
        $staff = DB::table('taikhoan')
            ->where('MaTK', $id)
            ->first();
        // Lấy danh sách role
        $roles = DB::table('role')->get();

        // Kiểm tra nếu không tìm thấy nhân viên
        if (!$staff) {
            return redirect()->route('staff.index')->with('error', 'Nhân viên không tồn tại.');
        }
        $viewData = [
            "title" => "Quản lý nhân viên",
            "subtitle" => "Quản Lý Nhân Viên",
            "staff" => $staff
        ];

        return view('admin.staff.index', $viewData);
    }



    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        // Lấy dữ liệu nhân viên theo ID
        $staff = DB::table('taikhoan')
            ->where('MaTK', $id)
            ->first();

        // Lấy danh sách role
        $roles = DB::table('role')->get();

        // Kiểm tra nếu không tìm thấy nhân viên
        if (!$staff) {
            return redirect()->route('staff.index')->with('error', 'Nhân viên không tồn tại.');
        }

        return view('Admin.Staff.edit', [
            'title' => 'Chỉnh sửa nhân viên',
            'subtitle' => 'Cập nhật thông tin',
            'staff' => $staff,
            'roles' => $roles,
        ]);
    }

    // Lưu thay đổi vào cơ sở dữ liệu
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'TenTK' => 'required|string|max:255',
            'GioiTinh' => 'required|in:Nam,Nữ',
            'NgaySinh' => 'required|date',
            'Email' => 'required|email',
            'SDT' => 'required|string|max:15',
            'DiaChi' => 'required|string|max:255',
            'Username' => 'required|string|max:50|unique:taikhoan,Username,' . $id . ',MaTK',
            'Password' => 'nullable|string|min:6',
            'MaRole' => 'required|exists:role,MaRole',
            'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'TrangThai' => 'nullable|boolean',
        ]);

        // Xử lý upload hình ảnh (nếu có)
        $imagePath = null;
        if ($request->hasFile('Image')) {
            $imagePath = $request->file('Image')->store('uploads/staff', 'public');
        }

        // Cập nhật dữ liệu
        $updateData = [
            'TenTK' => $validated['TenTK'],
            'GioiTinh' => $validated['GioiTinh'],
            'NgaySinh' => $validated['NgaySinh'],
            'Email' => $validated['Email'],
            'SDT' => $validated['SDT'],
            'DiaChi' => $validated['DiaChi'],
            'Username' => $validated['Username'],
            'MaRole' => $validated['MaRole'],
            'TrangThai' => $request->has('TrangThai') ? 1 : 0,
        ];

        // Nếu có mật khẩu mới
        if ($request->filled('Password')) {
            $updateData['Password'] = bcrypt($validated['Password']);
        }

        // Nếu có hình ảnh mới
        if ($imagePath) {
            $updateData['Image'] = $imagePath;
        }

        // Cập nhật vào cơ sở dữ liệu
        $updated = DB::table('taikhoan')
            ->where('MaTK', $id)
            ->update($updateData);

        if ($updated) {
            return redirect()->route('staff.index')->with('success', 'Cập nhật thông tin nhân viên thành công.');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
    }
}
