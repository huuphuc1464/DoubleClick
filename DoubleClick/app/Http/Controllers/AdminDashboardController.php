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
            $messages = $this->validationMessages();

            // Validate dữ liệu bao gồm phản hồi khách hàng
            $validatedData = $request->validate([
                'DiaChi' => ['required', 'string', 'max:100'],
                'Website' => ['required', 'string', 'max:50'],
                'SDT' => ['required', 'regex:/^[0-9]{10,11}$/'],
                'Email' => ['required', 'email', 'max:50'],
                'Title' => ['nullable', 'string', 'max:100'],
                'SubTitle' => ['nullable', 'string', 'max:100'],
                'MoTa' => ['nullable', 'string', 'max:500'],
                'MoiGoi' => ['nullable', 'string', 'max:500'],
                'Facebook' => ['nullable', 'string', 'max:100'],
                'Instagram' => ['nullable', 'string', 'max:100'],
                'Twitter' => ['nullable', 'string', 'max:100'],
                'Logo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
                'Image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,avif', 'max:2048'],
                'Video' => ['nullable', 'file', 'mimes:mp4,avi,wmv,mov', 'max:10240'],

                // Phản hồi khách hàng
                'TenKhach1' => ['nullable', 'string', 'max:50'],
                'PhanHoi1' => ['nullable', 'string', 'max:500'],
                'TenKhach2' => ['nullable', 'string', 'max:50'],
                'PhanHoi2' => ['nullable', 'string', 'max:500'],
                'TenKhach3' => ['nullable', 'string', 'max:50'],
                'PhanHoi3' => ['nullable', 'string', 'max:500'],
                'TenKhach4' => ['nullable', 'string', 'max:50'],
                'PhanHoi4' => ['nullable', 'string', 'max:500'],
            ], $messages);

            $website = DB::table('thongtinwebsite')->where('ID', 1)->first();

            if (!$website) {
                return redirect()->route('admin.mainDashboard')->with('error', 'Không tìm thấy thông tin website!');
            }

            // Xử lý upload logo, image, và video nếu có
            $validatedData['Logo'] = $this->handleFileUpload($request, 'Logo', $website->Logo, 'img');
            $validatedData['Image'] = $this->handleFileUpload($request, 'Image', $website->Image, 'img/website');
            $validatedData['Video'] = $this->handleFileUpload($request, 'Video', $website->Video, 'videos');

            // Cập nhật thông tin website
            DB::table('thongtinwebsite')->where('ID', 1)->update($validatedData);

            return redirect()->route('admin.mainDashboard')->with('success', 'Cập nhật thông tin website thành công!')->with('activeTab', 'website');
        } catch (\Exception $e) {
            return redirect()->route('admin.mainDashboard')->with('error', $e->getMessage())->with('activeTab', 'website');
        }
    }

    private function handleFileUpload(Request $request, $fieldName, $oldFile = null, $folder = 'uploads')
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = time() . '_' . $fieldName . '.' . $file->getClientOriginalExtension();

            // Lưu file vào thư mục public/$folder
            $file->move(public_path($folder), $fileName);

            // Xóa file cũ nếu tồn tại
            if ($oldFile && file_exists(public_path("$folder/" . $oldFile))) {
                unlink(public_path("$folder/" . $oldFile));
            }

            return $fileName;
        }

        // Nếu không upload file mới, giữ nguyên file cũ
        return $oldFile;
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
            'Email.max' => 'Email không được vượt quá 50 ký tự.',

            'Logo.image' => 'Logo phải là file hình ảnh.',
            'Logo.mimes' => 'Logo chỉ chấp nhận các định dạng jpg, png, jpeg, gif.',
            'Logo.max' => 'Dung lượng logo không được vượt quá 2MB.',

            'Image.image' => 'Ảnh phải là file hình ảnh.',
            'Image.mimes' => 'Ảnh chỉ chấp nhận các định dạng jpg, png, jpeg, avif.',
            'Image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',

            'Video.file' => 'Video phải là file hợp lệ.',
            'Video.mimes' => 'Video chỉ chấp nhận các định dạng mp4, avi, wmv, mov.',
            'Video.max' => 'Dung lượng video không được vượt quá 10MB.',

            'TenKhach1.max' => 'Tên khách hàng 1 không được vượt quá 50 ký tự.',
            'PhanHoi1.max' => 'Phản hồi 1 không được vượt quá 500 ký tự.',
            'TenKhach2.max' => 'Tên khách hàng 2 không được vượt quá 50 ký tự.',
            'PhanHoi2.max' => 'Phản hồi 2 không được vượt quá 500 ký tự.',
            'TenKhach3.max' => 'Tên khách hàng 3 không được vượt quá 50 ký tự.',
            'PhanHoi3.max' => 'Phản hồi 3 không được vượt quá 500 ký tự.',
            'TenKhach4.max' => 'Tên khách hàng 4 không được vượt quá 50 ký tự.',
            'PhanHoi4.max' => 'Phản hồi 4 không được vượt quá 500 ký tự.',
        ];
    }
}
