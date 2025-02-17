<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\LichSuHuyHoaDon;
use App\Models\Sach;
use App\Models\TaiKhoan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $title = "Trang cá nhân";
        return view('Profile.profile', compact('title'));
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

            // Lưu ảnh vào thư mục public/img/Profile - Storage
            //Storage::disk('public')->put('img/Profile/' . $fileName, file_get_contents($request->file('Image')->getRealPath()));

            $destinationPath = public_path('img/Profile');
            // Kiểm tra và tạo thư mục nếu không tồn tại
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Tạo thư mục với quyền truy cập đầy đủ
            }

            // Di chuyển file vào thư mục public/img/Profile
            $request->file('Image')->move($destinationPath, $fileName);

            // Lưu đường dẫn vào cơ sở dữ liệu
            $user->Image = $fileName;
            $user->save();
        }

        return back()->with('success', 'Thông tin đã được cập nhật thành công.');
    }

    public function DoiMatKhau()
    {
        $title = "Đổi mật khẩu";
        return view('Profile.doiMatKhau', compact('title'));
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
        $user = TaiKhoan::find($request->MaTK);
        if (!$user) {
            return back()->withErrors(['MaTK' => 'Không tìm thấy tài khoản người dùng.'])->withInput();
        }

        // Kiểm tra mật khẩu cũ có đúng không
        if (!Hash::check($request->input('old-password'), $user->Password)) {
            return back()->withErrors(['old-password' => 'Mật khẩu cũ không chính xác.'])->withInput();
        }

        // Cập nhật mật khẩu mới
        $user->Password = Hash::make($request->input('new-password')); // Mã hóa mật khẩu mới
        if ($user->save()) {
            return redirect()->route('profile.index')->with('success', 'Mật khẩu đã được thay đổi thành công!');
        } else {
            return back()->withErrors(['error' => 'Không thể lưu mật khẩu mới.'])->withInput();
        }
    }

    public function dsDonHang(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('search');
        $MaTK = Session::get('user')['MaTK'];
        $title = "Danh sách đơn hàng";
        $orders = DB::table('hoadon')
            ->join('chitiethoadon', 'hoadon.MaHD', '=', 'chitiethoadon.MaHD')
            ->join('sach', 'chitiethoadon.MaSach', '=', 'sach.MaSach')
            ->leftJoin('danhgia', function ($join) use ($MaTK) {
                $join->on('chitiethoadon.MaSach', '=', 'danhgia.MaSach')
                    ->where('danhgia.MaTK', '=', $MaTK); // Kiểm tra đánh giá bởi tài khoản hiện tại
            })
            ->select(
                'hoadon.MaHD',
                'hoadon.TongTien',
                'hoadon.TrangThai',
                'chitiethoadon.MaSach',
                'chitiethoadon.DonGia',
                'chitiethoadon.SLMua',
                'sach.TenSach',
                'sach.AnhDaiDien',
                DB::raw('IF(danhgia.MaSach IS NOT NULL, true, false) as DaDanhGia') // Kiểm tra đã đánh giá
            )
            ->where('hoadon.MaTK', '=', $MaTK);

        // Thêm điều kiện lọc trạng thái
        if ($status !== null) {
            $orders = $orders->where('hoadon.TrangThai', $status);
        }

        // Thêm điều kiện tìm kiếm
        if ($search) {
            $orders = $orders->where(function ($query) use ($search) {
                $query->where('hoadon.MaHD', 'like', '%' . $search . '%')
                    ->orWhere('sach.TenSach', 'like', '%' . $search . '%');
            });
        }

        $orders = $orders->orderByDesc('MaHD')->get();
        $groupedOrders = $orders->groupBy('MaHD');

        return view('Profile.dsdonhang', compact('groupedOrders', 'title'));
    }

    public function chiTietDonHang($id)
    {
        $MaTK = Session::get('user')['MaTK'];
        $title = "Chi tiết đơn hàng " . $id;
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

        return view('Profile.chiTietDonHang', compact('order', 'details', 'title'));
    }
    public function chiTietHuyDon($id)
    {
        $title = "Chi tiết hủy đơn hàng " . $id;
        $CTHuy = DB::table('ChiTietHoaDon')
            ->join('Sach', 'ChiTietHoaDon.MaSach', '=', 'Sach.MaSach')
            ->join('HoaDon', 'ChiTietHoaDon.MaHD', '=', 'HoaDon.MaHD')
            ->join('LichSuHuyHoaDon', 'HoaDon.MaHD', '=', 'LichSuHuyHoaDon.MaHD')
            ->where('LichSuHuyHoaDon.MaHD', $id)
            ->select(
                'ChiTietHoaDon.SLMua',
                'ChiTietHoaDon.DonGia',
                'Sach.TenSach',
                'Sach.GiaBan',
                'Sach.AnhDaiDien',
                'HoaDon.PhuongThucThanhToan',
                'LichSuHuyHoaDon.NguoiHuy',
                'LichSuHuyHoaDon.NgayHuy',
                'LichSuHuyHoaDon.LyDoHuy',
                'HoaDon.MaHD'
            )
            ->get();
        return view('Profile.chitiethuydon', compact('CTHuy', 'title'));
    }
    public function huyDonHang($id)
    {
        $title = "Hủy đơn hàng " . $id;
        return view('Profile.huydonhang', compact('id', 'title'));
    }
    public function luuHuyDonHang(Request $request)
    {
        //Lưu vào bảng LichSuLyDoHuy
        $lydo = $request->input('LyDoHuy');
        $mahd = $request->input('MaHD');
        $thoigian = Carbon::now('Asia/Ho_Chi_Minh');
        $huyDon = new LichSuHuyHoaDon();
        $huyDon->MaHD = $mahd;
        $huyDon->LyDoHuy = $lydo;
        $huyDon->NguoiHuy = "Người mua";
        $huyDon->NgayHuy = $thoigian;
        $huyDon->save();

        //Cập nhật số lượng sách đã mua vào kho
        $chitiethd = DB::table('chitiethoadon')->where('MaHD', '=', $mahd)->get();
        foreach ($chitiethd as $chiTiet) {
            $sach = Sach::find($chiTiet->MaSach);
            if ($sach) {
                $sach->SoLuongTon += $chiTiet->SLMua;
                $sach->save();
            }
        }

        //Cập nhật trạng thái thành đã hủy (4)
        $hoaDon = HoaDon::find($mahd);
        if ($hoaDon) {
            $hoaDon->TrangThai = 4;
            $hoaDon->save();
        }
        return redirect()->route('profile.dsdonhang')->with('success', 'Đơn hàng đã được hủy thành công.');
    }



//nhat
    public function themSachYeuThich(Request $request)
    {
        $MaTK = Session::get('user')['MaTK'];
        $MaSach = $request->input('MaSach');

        // Kiểm tra sách đã tồn tại trong danh sách yêu thích chưa
        $exists = DB::table('dsyeuthich')->where('MaTK', $MaTK)->where('MaSach', $MaSach)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Sách đã có trong danh sách yêu thích!'
            ]);
        }

        // Thêm sách vào danh sách yêu thích
        DB::table('dsyeuthich')->insert([
            'MaTK' => $MaTK,
            'MaSach' => $MaSach,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thêm sách vào danh sách yêu thích thành công!'
        ]);
    }   

//end nhat


    public function dsSachYeuThich()
    {
        $MaTK = Session::get('user')['MaTK'];
        $title = "Sách yêu thích";
        $wishlist = DB::table('dsyeuthich')
            ->join('sach', 'dsyeuthich.MaSach', '=', 'sach.MaSach')
            ->where('dsyeuthich.MaTK', '=', $MaTK)
            ->select('sach.TenSach', 'sach.GiaBan', 'sach.AnhDaiDien', 'dsyeuthich.*')
            ->paginate(5);
        return view('Profile.sachyeuthich', compact('wishlist', 'title'));
    }

    public function xoaSachYeuThich(Request $request)
    {
        $MaTK = Session::get('user')['MaTK'];
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
        $MaTK = Session::get('user')['MaTK'];
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
        $MaTK = Session::get('user')['MaTK'];
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
        $MaTK = Session::get('user')['MaTK'];
        $title = "Đánh giá sách " . $id;
        $daDanhGia = DB::table('danhgia')
            ->where('danhgia.MaTK', '=', $MaTK)
            ->where('danhgia.MaSach', '=', $id)
            ->first();

        // Kiểm tra sách đã đánh giá chưa
        if ($daDanhGia) {
            return redirect()->route('profile.dsdonhang')->with('error', 'Bạn đã đánh giá sách này rồi.');
        }

        // Kiểm tra sách có thuộc đơn hàng của tài khoản không
        $sach = DB::table('sach')
            ->join('chitiethoadon', 'sach.MaSach', '=', 'chitiethoadon.MaSach')
            ->join('hoadon', 'chitiethoadon.MaHD', '=', 'hoadon.MaHD')
            ->select(
                'sach.MaSach',
                'sach.TenSach',
                'sach.AnhDaiDien'
            )
            ->where('sach.MaSach', '=', $id)
            ->where('hoadon.MaTK', '=', $MaTK)
            ->where('hoadon.TrangThai', '=', 3)
            ->first();

        // Nếu sách không thuộc quyền sở hữu của tài khoản hoặc chưa giao đơn hàng
        if (!$sach) {
            return redirect()->route('profile.dsdonhang')->with('error', 'Không tìm thấy sách hoặc sách này không thuộc đơn hàng của bạn.');
        }

        // Chuyển đến trang đánh giá với thông tin sách
        return view('Profile.danhgiasach', compact('sach', 'MaTK', 'title'));
    }

    public function luuDanhGia(Request $request)
    {
        $MaTK = $request->input('MaTK');
        $MaSach = $request->input('MaSach');
        $DanhGia = $request->input('DanhGia');
        $SoSao = $request->input('SoSao');
        $gioHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('danhgia')->insert([
            'MaTK' => $MaTK,
            'MaSach' => $MaSach,
            'DanhGia' => $DanhGia,
            'SoSao' => $SoSao,
            'NgayDang' => $gioHienTai,
        ]);

        return redirect()->route('profile.dsdonhang')->with('success', 'Đánh giá của bạn đã được gửi thành công.');
    }

    public function danhSachDanhGia()
    {
        $title = "Danh sách đánh giá";
        $MaTK = Session::get('user')['MaTK'];
        $danhgia = DB::table('danhgia')
            ->join('sach', 'sach.MaSach', '=', 'danhgia.MaSach')
            ->where('danhgia.MaTK', '=', $MaTK)
            ->select(
                'danhgia.MaSach',
                'danhgia.MaTK',
                'danhgia.SoSao',
                'danhgia.DanhGia',
                'danhGia.NgayDang',
                'sach.TenSach',
                'sach.AnhDaiDien'
            )
            ->paginate(5);
        return view('Profile.dsdanhgia', compact('danhgia', 'title'));
    }

    public function xoaDanhGia($id)
    {
        $MaTK = Session::get('user')['MaTK'];
        // Kiểm tra đánh giá có tồn tại không
        $danhgia = DB::table('danhgia')
            ->where('MaTK', '=', $MaTK)
            ->where('MaSach', '=', $id)
            ->first();

        if (!$danhgia) {
            return response()->json(['success' => false, 'message' => 'Đánh giá không tồn tại.'], 404);
        }

        // Xóa đánh giá
        DB::table('danhgia')
            ->where('MaTK', '=', $MaTK)
            ->where('MaSach', '=', $id)
            ->delete();

        return response()->json(['success' => true, 'message' => 'Đánh giá đã được xóa thành công.']);
    }
}
