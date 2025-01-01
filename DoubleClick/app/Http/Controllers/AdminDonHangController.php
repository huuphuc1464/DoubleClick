<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Illuminate\Http\Request;

class AdminDonHangController extends Controller
{
    private function getHoaDon()
    {
        return HoaDon::with(['taiKhoan', 'voucher'])
            ->paginate(5);
    }
    function index(){
        $listHoaDon = $this->getHoaDon();
        $viewData =[
            "title"=>"Đơn hàng",
            "subtitle"=>"Danh sách đơn hàng",
            "listHoaDon"=>$listHoaDon
        ];
        return view('Admin.DonHang.index', $viewData);
    }
    public function cancel($id)
    {
        $hoaDon = HoaDon::findOrFail($id);
        if (in_array($hoaDon->TrangThai, [0, 1])) {
            $hoaDon->TrangThai = 4; 
            $hoaDon->save();
            //Sẽ bổ sung cộng về số lượng tồn kho
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công!');
        }
        return redirect()->back()->with('error', 'Không thể hủy đơn hàng này!');
    }
}
