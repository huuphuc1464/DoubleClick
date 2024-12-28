<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        session([
            'Username' => 'admin',
            'MaRole' => 1
        ]);
        $Username = session('Username');
        $MaRole = session('MaRole');

        $account = DB::table('taikhoan')
            ->join('role', 'taikhoan.MaRole', '=', 'role.MaRole')
            ->select('taikhoan.*', 'role.TenRole')
            ->where('taikhoan.Username', $Username)
            ->where('taikhoan.MaRole', $MaRole)
            ->first();

        return view('Proflie.profile', compact('account'));
    }

    public function update(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào và cập nhật thông tin người dùng
        $request->validate([
            'TenTK' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'DiaChi' => 'required|string|max:255',
            'SDT' => 'required|string|max:15',
            'GioiTinh' => 'required|string|in:Nam,Nữ',
            'dob_day' => 'required|integer|min:1|max:31',
            'dob_month' => 'required|integer|min:1|max:12',
            'dob_year' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        // Cập nhật thông tin người dùng
        $user = TaiKhoan::find($request->MaTK);
        $user->TenTK = $request->TenTK;
        $user->Email = $request->Email;
        $user->DiaChi = $request->DiaChi;
        $user->SDT = $request->SDT;
        $user->GioiTinh = $request->GioiTinh;
        $user->NgaySinh = "{$request->dob_year}-{$request->dob_month}-{$request->dob_day}";
        $user->save();
        // Cập nhật ảnh đại diện nếu có
        if ($request->hasFile('Image')) {
            $extension = $request->file('Image')->extension();

            // Lấy giá trị MaTK từ form
            $maTK = $request->input('MaTK');

            // Tạo tên file mới theo định dạng MaTK + đuôi
            $fileName = $maTK . '.' . $extension;

            // Lưu ảnh vào thư mục public/img/Profile
            Storage::disk('public')->put('img/Profile/' . $fileName, file_get_contents($request->file('Image')->getRealPath()));

            // Lưu đường dẫn vào cơ sở dữ liệu
            $user->Image = $fileName;
            $user->save();
        }

        return back()->with('success', 'Thông tin đã được cập nhật thành công.');
    }
}
