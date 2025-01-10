<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiSach;

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
}
