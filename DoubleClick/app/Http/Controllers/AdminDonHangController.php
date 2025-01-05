<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\Sach;
use App\Models\Voucher;
use App\Models\LichSuHuyHoaDon;
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

        $cancelReason = $request->input('cancel_reason');

        LichSuHuyHoaDon::create([
            'MaHD' => $MaHD,
            'LyDoHuy' => $cancelReason,
            'NgayHuy' => now(),
            'NguoiHuy' => 'Người bán' // Hoặc có thể lấy tên người hủy từ session
        ]);

        if (in_array($cancelReason, ['Khách hàng yêu cầu hủy', 'Đơn hàng sai thông tin', 'Khách hàng không thanh toán'])) {
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
        }
        $hoaDon->TrangThai = 4;
        $hoaDon->save();
        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công và cập nhật số lượng tồn.');
    }

    public function updateStatus(Request $request, $MaHD)
    {
        $hoaDon = HoaDon::where('MaHD', $MaHD)->first();

        if (!$hoaDon) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng!');
        }
        $newStatus = $request->input('status');
        if (!in_array($newStatus, [0, 1, 2, 3, 4])) {
            return redirect()->back()->with('error', 'Trạng thái không hợp lệ!');
        }
        if ($newStatus != $hoaDon->TrangThai + 1) {
            return redirect()->back()->with('error', 'Không thể cập nhật trạng thái theo cách này!');
        }
        if ($hoaDon->TrangThai == 4) {
            return redirect()->back()->with('error', 'Đơn hàng đã hủy, không thể thay đổi trạng thái!');
        }
        $hoaDon->TrangThai = $newStatus;
        $hoaDon->save();
        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
    }

}
