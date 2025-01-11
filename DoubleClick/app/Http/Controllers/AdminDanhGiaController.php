<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\Sach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use KitLoong\MigrationsGenerator\Schema\Models\Index;

class AdminDanhGiaController extends Controller
{
    public function index()
    {
        $title = "Danh sách đánh giá";
        $danhgia = DB::table('danhgia')
            ->join('taikhoan', 'taikhoan.MaTK', '=', 'danhgia.MaTK')
            ->join('sach', 'sach.MaSach', '=', 'danhgia.MaSach')
            ->select('danhgia.*', 'sach.TenSach', 'taikhoan.TenTK')
            ->paginate(5);
        return view('Admin.DanhGia.index', compact('danhgia', 'title'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('searchQuery'); // Lấy từ khóa tìm kiếm từ request

        $danhgia = DB::table('danhgia')
        ->join('sach', 'sach.MaSach', '=','danhgia.MaSach')
        ->where('TenSach', 'like', '%' . $searchQuery . '%')
        ->get();
        // Kiểm tra nếu có kết quả
        if ($danhgia->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy kết quả',
                'data' => []
            ]);
        }

        // Trả về dữ liệu tìm kiếm dưới dạng JSON
        return response()->json([
            'success' => true,
            'message' => 'Tìm kiếm thành công',
            'data' => $danhgia
        ]);
    }

    public function filter(Request $request)
    {
        $query = DanhGia::query();

        // Kiểm tra nếu có số sao được gửi lên
        if ($request->has('star') && $request->star != '') {
            $query->where('SoSao', $request->star); // Lọc theo số sao
        }

        $danhgia = $query->get();

        return response()->json([
            'success' => true,
            'data' => $danhgia,
        ]);
    }

    public function destroy($matk, $masach, Request $request)
    {
        // Kiểm tra xem yêu cầu có phải là AJAX không
        if ($request->ajax()) {
            $item = DB::table('danhgia')
                ->where('MaSach', '=', $masach)
                ->where('MaTK', '=', $matk)
                ->first();

            if ($item) {
                // Xóa dữ liệu
                DB::table('danhgia')->where('MaSach', '=', $masach)->where('MaTK', '=', $matk)->delete();

                // Trả về phản hồi JSON
                return response()->json([
                    'success' => true,
                    'message' => 'Xóa đánh giá thành công'
                ]);
            }

            // Nếu không tìm thấy item
            return response()->json([
                'success' => false,
                'message' => 'Đánh giá không tồn tại'
            ]);
        }

        // Nếu yêu cầu không phải là AJAX
        return response()->json([
            'success' => false,
            'message' => 'Yêu cầu không hợp lệ'
        ], 400); // 400 Bad Request
    }
}