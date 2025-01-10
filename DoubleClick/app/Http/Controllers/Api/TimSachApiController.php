<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiSach;
use App\Models\Sach;

class TimSachApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $type = $request->get('type');

        // Chuẩn hóa chuỗi tìm kiếm: Loại bỏ khoảng trắng thừa
        $search = trim(preg_replace('/\s+/', ' ', $search));

        $query = LoaiSach::query();

        if ($search) {
            $query->whereHas('sach', function ($q) use ($search, $type) {
                if ($type === 'ten_sach') {
                    $q->where('TenSach', 'like', "%$search%");
                } elseif ($type === 'ten_tac_gia') {
                    $q->where('TenTG', 'like', "%$search%");
                }
            });
        }

        $loaiSach = $query->with(['sach' => function ($q) use ($search, $type) {
            if ($type === 'ten_sach') {
                $q->where('TenSach', 'like', "%$search%");
            } elseif ($type === 'ten_tac_gia') {
                $q->where('TenTG', 'like', "%$search%");
            }
        }])->paginate(10);

        return response()->json($loaiSach);
    }

    public function laySachTheoLoai($idLoai)
    {
        // Lấy tất cả các sách thuộc loại sách có mã $idLoai
        if ($idLoai == "getAll") {
            $sachs = Sach::all();
        } else {
            $sachs = Sach::where('MaLoai', $idLoai)->get();
        }

        // Trả về kết quả dưới dạng JSON
        return response()->json($sachs);
    }
}
