<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\table;

class ProfileController extends Controller
{
    public function index()
    {
        session([
            'Username' => 'admin',
            'MaTK' => 2,
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

        return view('Profile.profile', compact('account'));
    }

    public function update(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào và cập nhật thông tin người dùng
        $request->validate([
            'TenTK' => 'required|string|max:255',
            'Email' => 'required|email|unique:taikhoan,email,' . $request->MaTK . ',MaTK|max:255',
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

    public function DoiMatKhau()
    {
        $MaTK = session('MaTK');
        return view('Profile.doiMatKhau', compact('MaTK'));
    }
    public function updatePass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old-password' => 'required|string',
            'new-password' => 'required|string|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/|confirmed', // Kiểm tra mật khẩu mới phải có ít nhất 1 chữ và 1 số
            'new-password_confirmation' => 'required|string|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        ], [
            'new-password.confirmed' => 'Mật khẩu mới và nhập lại mật khẩu mới không khớp.',
            'new-password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'new-password.max' => 'Mật khẩu mới không được vượt quá 32 ký tự.',
            'new-password.regex' => 'Mật khẩu mới phải chứa ít nhất một chữ cái và một số.',
            'new-password_confirmation.min' => 'Nhập lại mật khẩu mới phải có ít nhất 8 ký tự.',
            'new-password_confirmation.max' => 'Nhập lại mật khẩu mới không được vượt quá 32 ký tự.',
            'new-password_confirmation.regex' => 'Nhập lại mật khẩu phải chứa ít nhất một chữ cái và một số.',
        ]);

        // Kiểm tra xem có lỗi xác thực không
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Tìm người dùng hiện tại (đảm bảo MaTK đúng và có người dùng)
        $user = TaiKhoan::find($request->MaTK)->first();
        if (!$user) {
            return back()->withErrors(['MaTK' => 'Không tìm thấy tài khoản người dùng.'])->withInput();
        }

        // Kiểm tra mật khẩu cũ có đúng không
        if (!Hash::check($request->input('old-password'), $user->Password)) {
            return back()->withErrors(['old-password' => 'Mật khẩu cũ không chính xác.'])->withInput();
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->input('new-password')); // Mã hóa mật khẩu mới
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Mật khẩu đã được thay đổi thành công!');
    }

    public function dsDonHang(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('search');
        $MaTK = session('MaTK');

        $orders = DB::table('hoadon')
            ->join('chitiethoadon', 'hoadon.MaHD', '=', 'chitiethoadon.MaHD')
            ->join('sach', 'chitiethoadon.MaSach', '=', 'sach.MaSach')
            ->select(
                'hoadon.MaHD',
                'hoadon.TongTien',
                'hoadon.TrangThai',
                'chitiethoadon.MaSach',
                'chitiethoadon.DonGia',
                'chitiethoadon.SLMua',
                'sach.TenSach',
                'sach.AnhDaiDien'
            )
            ->where('hoadon.MaTK', '=', $MaTK);

        // Nếu có status, thêm điều kiện vào truy vấn
        if ($status !== null) {
            $orders = $orders->where('hoadon.TrangThai', $status);
        }

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào truy vấn
        if ($search) {
            $orders = $orders->where(function ($query) use ($search) {
                $query->where('hoadon.MaHD', 'like', '%' . $search . '%')
                    ->orWhere('sach.TenSach', 'like', '%' . $search . '%');
            });
        }

        $orders = $orders->get();
        $groupedOrders = $orders->groupBy('MaHD');
        return view('Profile.dsdonhang', compact('groupedOrders'));
    }

    public function chiTietDonHang($id)
    {
        $MaTK = session('MaTK');
        $order = DB::table('hoadon')
            ->join('taikhoan', 'hoadon.MaTK', '=', 'taikhoan.MaTK')
            ->select(
                'hoadon.MaHD',
                'hoadon.TongTien',
                'hoadon.DiaChi',
                'hoadon.SDT',
                'hoadon.NgayLapHD',
                'hoadon.TienShip',
                'hoadon.TrangThai',
                'hoadon.KhuyenMai',
                'hoadon.PhuongThucThanhToan',
                'taikhoan.TenTK',
            )
            ->where('hoadon.MaTK', '=', $MaTK)
            ->where('hoadon.MaHD', '=', $id)
            ->first();

        $details = DB::table('chitiethoadon')
            ->join('sach', 'chitiethoadon.MaSach', '=', 'sach.MaSach')
            ->select(
                'chitiethoadon.MaSach',
                'chitiethoadon.DonGia',
                'chitiethoadon.SLMua',
                'chitiethoadon.GhiChu',
                'chitiethoadon.ThanhTien',
                'sach.TenSach',
                'sach.AnhDaiDien'
            )
            ->where('chitiethoadon.MaHD', '=', $id)
            ->get();

        return view('Profile.chiTietDonHang', compact('order', 'details'));
    }

    public function dsSachYeuThich()
    {
        $MaTK = session('MaTK');
        $wishlist = DB::table('dsyeuthich')
            ->join('sach', 'dsyeuthich.MaSach', '=', 'sach.MaSach')
            ->where('dsyeuthich.MaTK', '=', $MaTK)
            ->select('sach.TenSach', 'sach.GiaBan', 'sach.AnhDaiDien', 'dsyeuthich.*')
            ->get();
        return view('Profile.sachyeuthich', compact('wishlist'));
    }

    public function xoaSachYeuThich(Request $request)
    {
        $MaTK = session('MaTK');
        $MaSach = $request->MaSach;

        // Kiểm tra xem sách có trong danh sách yêu thích của người dùng không
        $deleted = DB::table('dsyeuthich')
            ->where('MaTK', $MaTK)
            ->where('MaSach', $MaSach)
            ->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Xóa sách khỏi danh sách yêu thích thành công.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Không thể xóa sách.']);
        }
    }

    public function addToCart(Request $request)
    {
        $MaTK = session('MaTK'); // Lấy mã tài khoản từ session
        $MaSach = $request->input('MaSach'); // Lấy mã sách từ yêu cầu

        // Kiểm tra xem sách đã có trong giỏ hàng chưa
        $cartItem = DB::table('GioHang')
            ->where('MaTK', $MaTK)
            ->where('MaSach', $MaSach)
            ->first();

        if ($cartItem) {
            // Nếu sách đã có trong giỏ hàng, tăng số lượng lên 1
            DB::table('GioHang')
                ->where('MaTK', $MaTK)
                ->where('MaSach', $MaSach)
                ->increment('SLMua', 1); // Tăng số lượng

            // Thêm thông báo vào session
            session()->flash('success', 'Số lượng sách đã được cập nhật vào giỏ hàng.');

            // Trả về JSON
            return response()->json(['success' => true, 'message' => 'Số lượng sách đã được cập nhật vào giỏ hàng.'], 200);
        } else {
            // Nếu sách chưa có trong giỏ hàng, thêm mới vào giỏ
            DB::table('GioHang')->insert([
                'MaTK' => $MaTK,
                'MaSach' => $MaSach,
                'SLMua' => 1,
            ]);

            // Thêm thông báo vào session
            session()->flash('success', 'Sách đã được thêm vào giỏ hàng.');

            // Trả về JSON
            return response()->json(['success' => true, 'message' => 'Sách đã được thêm vào giỏ hàng.'], 200);
        }
    }

    public function addAllToCart(Request $request)
    {
        $MaTK = session('MaTK'); // Lấy mã tài khoản từ session
        $MaSachList = $request->input('MaSachList'); // Lấy danh sách mã sách từ yêu cầu

        foreach ($MaSachList as $MaSach) {
            $cartItem = DB::table('GioHang')
                ->where('MaTK', $MaTK)
                ->where('MaSach', $MaSach)
                ->first();

            if ($cartItem) {
                // Nếu sách đã có trong giỏ hàng, tăng số lượng lên 1
                DB::table('GioHang')
                    ->where('MaTK', $MaTK)
                    ->where('MaSach', $MaSach)
                    ->increment('SLMua', 1);
            } else {
                // Nếu sách chưa có trong giỏ hàng, thêm mới
                DB::table('GioHang')->insert([
                    'MaTK' => $MaTK,
                    'MaSach' => $MaSach,
                    'SLMua' => 1,
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Tất cả sách đã được thêm vào giỏ hàng.']);
    }

    public function danhGiaSach($id)
    {
        return view('Profile.danhgiasach');
    }
    public function danhSachDanhGia()
    {
        return view('Profile.dsdanhgia');
    }
}
