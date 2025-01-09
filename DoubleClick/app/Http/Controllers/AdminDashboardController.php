<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\HoaDon;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    public function index()
    {
        //Tổng số sách
        $tongSoSach = Sach::count(); // Tính tổng số sách

        //Tổng số đơn hàng
        $tongSoDonHang = HoaDon::count();

        //Tổng doanh thu
        $tongDoanhThu = HoaDon::where('TrangThai', 1)->sum('TongTien');

        //Số người dùng (khách hàng)

        $tongSoNguoiDung = TaiKhoan::where('MaRole', 3)->count();

        return view('Admin.dashbroad', [
            'tongSoSach' => $tongSoSach,
            'tongSoDonHang' => $tongSoDonHang,
            'tongDoanhThu' => $tongDoanhThu,
            'tongSoNguoiDung' => $tongSoNguoiDung
        ]);
    }
    public function editInfomationOfWebsite(Request $request)
    {
        try {
            // Validate dữ liệu
            $validatedData = $request->validate([
                'DiaChi' => 'required|string|max:100',
                'Website' => 'required|string|max:50',
                'SDT' => 'required|regex:/^[0-9]{10,11}$/',
                'Email' => 'required|email|max:100',
                'Facebook' => 'required|string|max:100',
                'Logo' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            ]);

            // Kiểm tra file Logo
            if ($request->hasFile('Logo')) {
                // Lấy file từ request
                $file = $request->file('Logo');
                $fileName = time() . '.' . $file->getClientOriginalExtension();

                // Lưu file vào thư mục 'public/img'
                $file->move(public_path('img'), $fileName);

                // Lưu tên file vào dữ liệu để cập nhật
                $validatedData['Logo'] = $fileName;

                // Xóa logo cũ nếu cần (nếu có logo cũ và file tồn tại)
                $website = DB::table('thongtinwebsite')->where('ID', 1)->first();
                if ($website && $website->Logo && file_exists(public_path('img/' . $website->Logo))) {
                    unlink(public_path('img/' . $website->Logo));
                }
            }

            // Cập nhật thông tin trong database
            DB::table('thongtinwebsite')->where('ID', 1)->update([
                'DiaChi' => $validatedData['DiaChi'],
                'Website' => $validatedData['Website'],
                'SDT' => $validatedData['SDT'],
                'Email' => $validatedData['Email'],
                'Facebook' => $validatedData['Facebook'],
                'Logo' => $validatedData['Logo'] ?? $website->Logo, // Nếu không có logo mới, giữ logo cũ
            ]);

            // Trả về thông báo thành công
            return redirect()->back()->with('success', 'Thông tin website đã được cập nhật thành công!');
        } catch (\Exception $e) {
            // Trả về lỗi nếu có
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật thông tin website: ' . $e->getMessage());
        }
    }
}
