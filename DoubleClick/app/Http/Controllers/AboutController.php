<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiSach;
use App\Models\Sach;



class AboutController extends Controller
{
    public function index()
    {

        return view('about');
    }

    public function top3LoaiSach()
    {
        // Truy vấn 3 loại sách có nhiều cuốn sách nhất với TrangThai = 1
        $top3LoaiSach = LoaiSach::withCount('sach') // Đếm số lượng sách liên quan
            ->where('TrangThai', 1)               // Lọc chỉ các loại sách đang hoạt động
            ->orderBy('sach_count', 'desc')       // Sắp xếp giảm dần theo số lượng sách
            ->limit(3)                             // Giới hạn kết quả trả về 3 loại sách
            ->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json([
            'status' => 'success',
            'data' => $top3LoaiSach
        ], 200);
    }
    public function getNewestBooks(Request $request)
    {
        // Lấy tham số 'count' từ query string, mặc định là 5 nếu không truyền
        $count = $request->input('count', 5);

        // Kiểm tra xem 'count' có phải là số nguyên dương không
        if (!is_numeric($count) || intval($count) <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tham số "count" phải là một số nguyên dương.'
            ], 400);
        }

        $count = intval($count);

        // Truy vấn các cuốn sách mới nhất dựa trên 'MaSach' giảm dần (giả sử 'MaSach' tăng theo thời gian thêm sách)
        $newestBooks = Sach::orderBy('MaSach', 'desc') // Sắp xếp giảm dần theo 'MaSach'
            ->limit($count)                           // Giới hạn số lượng sách
            ->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json([
            'status' => 'success',
            'data' => $newestBooks
        ], 200);
    }
}
