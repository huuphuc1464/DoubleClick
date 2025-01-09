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
            // Custom validation messages
            $messages = [
                'DiaChi.required' => 'Vui lòng nhập địa chỉ.',
                'DiaChi.string' => 'Địa chỉ phải là chuỗi ký tự.',
                'DiaChi.max' => 'Địa chỉ không được vượt quá 100 ký tự.',

                'Website.required' => 'Vui lòng nhập tên website.',
                'Website.string' => 'Tên website phải là chuỗi ký tự.',
                'Website.max' => 'Tên website không được vượt quá 50 ký tự.',

                'SDT.required' => 'Vui lòng nhập số điện thoại.',
                'SDT.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập từ 10 đến 11 chữ số.',

                'Email.required' => 'Vui lòng nhập địa chỉ email.',
                'Email.email' => 'Email không hợp lệ.',
                'Email.max' => 'Email không được vượt quá 100 ký tự.',

                'Facebook.required' => 'Vui lòng nhập đường dẫn Facebook.',
                'Facebook.string' => 'Đường dẫn Facebook phải là chuỗi ký tự.',
                'Facebook.max' => 'Đường dẫn Facebook không được vượt quá 100 ký tự.',

                'Logo.image' => 'Logo phải là file hình ảnh.',
                'Logo.mimes' => 'Logo chỉ chấp nhận các định dạng jpg, png, jpeg, gif.',
                'Logo.max' => 'Dung lượng logo không được vượt quá 2MB.',
            ];

            // Validate dữ liệu
            $validatedData = $request->validate([
                'DiaChi' => ['required', 'string', 'max:100'],
                'Website' => ['required', 'string', 'max:50'],
                'SDT' => ['required', 'regex:/^[0-9]{10,11}$/'],
                'Email' => ['required', 'email', 'max:100'],
                'Facebook' => ['required', 'string', 'max:100'],
                'Logo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            ], $messages);

            // Lấy thông tin website hiện tại
            $website = DB::table('thongtinwebsite')->where('ID', 1)->first();

            // Kiểm tra nếu không tìm thấy website
            if (!$website) {
                return redirect()->back()->with('error', 'Không tìm thấy thông tin website!');
            }

            // Xử lý upload logo (nếu có)
            $validatedData['Logo'] = $this->handleLogoUpload($request, $website->Logo);

            // Cập nhật thông tin vào database
            DB::table('thongtinwebsite')->where('ID', 1)->update([
                'DiaChi' => $validatedData['DiaChi'],
                'Website' => $validatedData['Website'],
                'SDT' => $validatedData['SDT'],
                'Email' => $validatedData['Email'],
                'Facebook' => $validatedData['Facebook'],
                'Logo' => $validatedData['Logo'], // Logo mới hoặc logo cũ
            ]);

            // Trả về thông báo thành công
            return redirect()->back()->with('success', 'Thông tin website đã được cập nhật thành công!');
        } catch (\Exception $e) {
            // Trả về thông báo lỗi chi tiết
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    private function handleLogoUpload(Request $request, $oldLogo = null)
    {
        if ($request->hasFile('Logo')) {
            $file = $request->file('Logo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Lưu file vào thư mục 'public/img'
            $file->move(public_path('img'), $fileName);

            // Xóa logo cũ nếu cần
            if ($oldLogo && file_exists(public_path('img/' . $oldLogo))) {
                unlink(public_path('img/' . $oldLogo));
            }

            return $fileName;
        }

        // Nếu không upload file mới, giữ nguyên logo cũ
        return $oldLogo;
    }
}
