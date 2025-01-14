<?php
namespace App\Http\Controllers;
use App\Models\DanhGia;
use App\Models\Sach; // Giả sử bạn có model Sach cho sản phẩm sách
use Illuminate\Http\Request;

class ChiTietSanPhamController extends Controller
{
    public function show($id)
    {
        // Lấy sản phẩm theo id từ cơ sở dữ liệu
        $sach = sach::findOrFail(id: $id); // Nếu không tìm thấy sản phẩm sẽ trả lỗi 404

        // Lấy danh sách đánh giá và tải thông tin người dùng
        $danhgia = DanhGia::with('user')->where('MaSach', $id)->get();

        // Tăng số lượt xem của sản phẩm
        $sach->increment('luot_xem');
        $relatedProducts = sach::where('MaLoai', $sach->MaLoai)
                            ->where('MaSach', '!=', $id) // Loại trừ sản phẩm hiện tại
                            ->take(6) // Lấy tối đa 6 sản phẩm liên quan
                            ->get();

        // Trả về view với dữ liệu sản phẩm
        return view('user.chitietsanpham', compact('sach', 'danhgia', 'relatedProducts'));
    }
    public function getRealTimeStats($id)
    {
        $sach = Sach::find($id);
        $luot_xem = $sach->luot_xem;
        $luot_tim = $sach->luot_tim ?? 0;
        //$avg_rating = $sach->danhGia()->avg('SoSao');

        return response()->json([
            'luot_xem' => $luot_xem,
            'luot_tim' => $luot_tim,
            //'avg_rating' => $avg_rating,
        ]);
    }
    public function store(Request $request)
    {
        // Kiểm tra xác thực người dùng (bạn có thể thay đổi logic này theo cách bạn quản lý người dùng)
        if (!session()->has(key: 'MaTK')) {
            return redirect()->back()->withErrors('Bạn cần đăng nhập để thực hiện đánh giá.');
        }

        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'SoSao' => 'required|integer|min:1|max:5',
            'DanhGia' => 'required|string|max:255',
            'MaSach' => 'required|exists:sach,id', // Đảm bảo sách tồn tại
        ]);

        // Tạo đánh giá mới
        DanhGia::create([
            'MaTK' => session(key: 'MaTK'), // ID người dùng từ session
            'MaSach' => $validated['MaSach'], // ID sách
            'SoSao' => $validated['SoSao'], // Số sao được đánh giá
            'DanhGia' => $validated['DanhGia'], // Nội dung đánh giá
            'NgayDang' => now(), // Ngày đăng đánh giá
        ]);

        // Trả về với thông báo thành công
        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi!');
    }



}

