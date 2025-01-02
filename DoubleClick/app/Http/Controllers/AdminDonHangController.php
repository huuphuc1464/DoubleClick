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
    //Bổ sung chức năng hủy hàng: Sẽ cập nhật lại số lượng sản phẩm trong hóa đơn về lại số lượng tồn trong bảng sach.
    public function cancel1($id)
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
    public function cancel(Request $request, $MaHD)
    {
        // Validate hóa đơn tồn tại và trạng thái hợp lệ
        $hoaDon = HoaDon::where('MaHD', $MaHD)
            ->whereIn('TrangThai', [0, 1]) // Chỉ hủy khi trạng thái là 0 hoặc 1
            ->first();

        if (!$hoaDon) {
            return redirect()->back()->with('error', 'Hóa đơn không thể hủy!');
        }

        // Lấy danh sách chi tiết hóa đơn
        $chiTietHoaDon = ChiTietHoaDon::where('MaHD', $MaHD)->get();

        foreach ($chiTietHoaDon as $chiTiet) {
            // Lấy sách tương ứng
            $sach = Sach::find($chiTiet->MaSach);

            if ($sach) {
                // Cập nhật số lượng tồn
                $sach->SoLuongTon += $chiTiet->SLMua;
                $sach->save();
            }
        }
         // Kiểm tra và cập nhật voucher nếu có
        if ($hoaDon->MaVoucher) {
            $voucher = Voucher::where('MaVoucher', $hoaDon->MaVoucher)->first();

            if ($voucher) {
                // Cập nhật số lượng voucher
                $voucher->SoLuong += 1; // Tăng lại số lượng voucher
                $voucher->save();
            }
        }

        // Cập nhật trạng thái hóa đơn thành "đã hủy" (giả sử 4 là trạng thái hủy)
        $hoaDon->TrangThai = 4;
        $hoaDon->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công và cập nhật số lượng tồn.');
    }
}
