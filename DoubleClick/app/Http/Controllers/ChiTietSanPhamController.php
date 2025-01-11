<?php
namespace App\Http\Controllers;

use App\Models\Sach; // Giả sử bạn có model Sach cho sản phẩm sách
use Illuminate\Http\Request;

class ChiTietSanPhamController extends Controller
{
    public function show($id)
    {
        // Lấy sản phẩm theo id từ cơ sở dữ liệu
        $sach = sach::findOrFail(id: $id); // Nếu không tìm thấy sản phẩm sẽ trả lỗi 404

        // Trả về view với dữ liệu sản phẩm
        return view('user.chitietsanpham', compact('sach'));
    }   

}

