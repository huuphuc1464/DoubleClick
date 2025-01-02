<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\Sach;
use App\Models\Voucher;
use Illuminate\Http\Request;

class AdminDonHangController extends Controller
{
    private function getHoaDon()
    {
        return HoaDon::with(['taiKhoan', 'voucher'])
            ->paginate(5);
    } 
    public function index(){
        $listHoaDon = $this->getHoaDon();
        $viewData =[
            "title"=>"Đơn hàng",
            "subtitle"=>"Danh sách đơn hàng",
            "listHoaDon"=>$listHoaDon
        ];
        return view('Admin.DonHang.index', $viewData);
    }
    public function cancel(Request $request, $MaHD)
    {
        $hoaDon = HoaDon::where('MaHD', $MaHD)
            ->whereIn('TrangThai', [0, 1]) 
            ->first();

        if (!$hoaDon) {
            return redirect()->back()->with('error', 'Hóa đơn không thể hủy!');
        }
        $chiTietHoaDon = ChiTietHoaDon::where('MaHD', $MaHD)->get();

        foreach ($chiTietHoaDon as $chiTiet) {
            $sach = Sach::find($chiTiet->MaSach);

            if ($sach) {
                $sach->SoLuongTon += $chiTiet->SLMua;
                $sach->save();
            }
        }
        if ($hoaDon->MaVoucher) {
            $voucher = Voucher::where('MaVoucher', $hoaDon->MaVoucher)->first();

            if ($voucher) {
                $voucher->SoLuong += 1; 
                $voucher->save();
            }
           
        }
        $hoaDon->TrangThai = 4;
        $hoaDon->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công và cập nhật số lượng tồn.');
    }
}
