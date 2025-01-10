<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\HoaDon;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function showMainDashboard()
    {
        // Truyền dữ liệu cần thiết bằng Eloquent
        $tongSoSach = Sach::count();
        $tongSoDonHang = HoaDon::count();
        $tongDoanhThu = HoaDon::where('TrangThai', 1)->sum('TongTien');
        $tongSoNguoiDung = TaiKhoan::where('MaRole', 3)->count();

        // Lấy thông tin website bằng DB::table
        $website = DB::table('thongtinwebsite')->where('ID', 1)->first();
        return view('Admin.mainDashboard', compact(
            'tongSoSach',
            'tongSoDonHang',
            'tongDoanhThu',
            'tongSoNguoiDung',
            'website'
        ));
    }

    public function editInfomationOfWebsite(Request $request)
    {
        try {
            // Custom validation messages
            $messages = $this->validationMessages();

            // Validate dữ liệu
            $validatedData = $request->validate([
                'DiaChi' => ['required', 'string', 'max:100'],
                'Website' => ['required', 'string', 'max:50'],
                'SDT' => ['required', 'regex:/^[0-9]{10,11}$/'],
                'Email' => ['required', 'email', 'max:100'],
                'Facebook' => ['required', 'string', 'max:100'],
                'Logo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            ], $messages);

            $website = DB::table('thongtinwebsite')->where('ID', 1)->first();

            if (!$website) {
                return redirect()->route('admin.mainDashboard')->with('error', 'Không tìm thấy thông tin website!');
            }

            // Xử lý upload logo nếu có
            $validatedData['Logo'] = $this->handleLogoUpload($request, $website->Logo);

            // Cập nhật thông tin website
            DB::table('thongtinwebsite')->where('ID', 1)->update([
                'DiaChi' => $validatedData['DiaChi'],
                'Website' => $validatedData['Website'],
                'SDT' => $validatedData['SDT'],
                'Email' => $validatedData['Email'],
                'Facebook' => $validatedData['Facebook'],
                'Logo' => $validatedData['Logo'] ?? $website->Logo,
            ]);

            // Sau khi cập nhật, thay đổi activeTab thành 'website'
            return redirect()->route('admin.mainDashboard')->with('success', 'Cập nhật thông tin website thành công!')->with('activeTab', 'website');
        } catch (\Exception $e) {
            return redirect()->route('admin.mainDashboard')->with('error', $e->getMessage())->with('activeTab', 'website');
        }
    }

    private function handleLogoUpload(Request $request, $oldLogo = null)
    {
        if ($request->hasFile('Logo')) {
            $file = $request->file('Logo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Lưu file vào thư mục 'public/img'
            $file->move(public_path('img'), $fileName);

            // Xóa logo cũ nếu tồn tại
            if ($oldLogo && file_exists(public_path('img/' . $oldLogo))) {
                unlink(public_path('img/' . $oldLogo));
            }

            return $fileName;
        }

        // Nếu không upload file mới, giữ nguyên logo cũ
        return $oldLogo;
    }

    private function validationMessages()
    {
        return [
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
    }
}
