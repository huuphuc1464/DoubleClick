<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\Sach;
use App\Models\Voucher;
use App\Models\LichSuHuyHoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class AdminDonHangController extends Controller
{ 
    // Các biến tĩnh cho trạng thái và phương thức thanh toán
    public static $trangThai = [
        ['maTrangThai' => 0, 'tenTrangThai' => "Chờ thanh toán"],
        ['maTrangThai' => 1, 'tenTrangThai' => "Đang xử lý"],
        ['maTrangThai' => 2, 'tenTrangThai' => "Đang vận chuyển"],
        ['maTrangThai' => 3, 'tenTrangThai' => "Đã giao"],
    ];
    public static $phuongThucThanhToan = [
        ['idPayment' => "COD", 'paymentName' => "Thanh toán khi nhận hàng (COD)"],
        ['idPayment' => "VNPAY", 'paymentName' => "Thanh toán qua VNPAY"],
        ['idPayment' => "Banking", 'paymentName' => "Thanh toán chuyển khoản ngân hàng"],
    ];
    //Lấy tất cả hóa đơn trừ hóa đơn có trạng thái là 4 (Hủy).
    public function index()
    {
        $listHoaDon = HoaDon::with('taiKhoan', 'voucher')
            ->where('TrangThai', '!=', 4) 
            ->orderBy('MaHD', 'desc')
            ->paginate(10);

        return view('Admin.DonHang.index', [
            "title" => "Quản lý đơn hàng - Tất cả hóa đơn",
            "subtitle" => "Danh sách tất cả hóa đơn",
            "listHoaDon" => $listHoaDon,
            "trangThai" => self::$trangThai,
            "phuongThucThanhToan" => self::$phuongThucThanhToan,
        ]);
    }
    //Lất danh sách hóa đơn theo trạng thái truyền vào
    public function getHoaDonTrangThai($trangThai)
    {
        $hoaDons = HoaDon::with('taikhoan','voucher')
        ->where('TrangThai',$trangThai)
        ->orderBy('MaHD','desc')
        ->paginate(10);

        $trangThaiName = '';  
        foreach (self::$trangThai as $status) {
            // Kiểm tra kiểu dữ liệu để so sánh
            if ((int)$status['maTrangThai'] === (int)$trangThai) {
                $trangThaiName = $status['tenTrangThai'];  
                break;
            }
        }
        $viewData = [
            "title" => "Quản lý đơn hàng - ".$trangThaiName,
            "subtitle" => "Danh sách hóa đơn - ".$trangThaiName ,
            "listHoaDon" => $hoaDons,
            "trangThai" => self::$trangThai,
            "phuongThucThanhToan" => self::$phuongThucThanhToan,
        ];
        return view('Admin.DonHang.index', $viewData);
    }
    //Lấy danh sách hóa đơn theo phương thức thanh toán và có trạng thái khác 4.
    public function filterByPaymentMethod($paymentMethod)
    {
        $listHoaDon = HoaDon::with('taiKhoan', 'voucher')
            ->where('TrangThai', '!=', 4) 
            ->where('PhuongThucThanhToan', $paymentMethod)
            ->orderBy('MaHD', 'desc')
            ->paginate(10);
        $paymentName = '';
        foreach (self::$phuongThucThanhToan as $payment) {
            if ($payment['idPayment'] === $paymentMethod) {
                $paymentName = $payment['paymentName'];
                break;
            }
        }
        return view('Admin.DonHang.index', [
            "title" => "Quản lý đơn hàng - ".$paymentName,
            "subtitle" => "Danh sách hóa đơn - ".$paymentName,
            "listHoaDon" => $listHoaDon,
            "trangThai" => self::$trangThai,
            "phuongThucThanhToan" => self::$phuongThucThanhToan,
        ]);
    }
    //Lấy danh sách hóa đơn hủy
    public function hoaDonHuy()
    {
        $listHoaDonHuy = HoaDon::with('taiKhoan', 'voucher')
            ->where('TrangThai', 4) // Chỉ lấy hóa đơn hủy
            ->orderBy('MaHD', 'desc')
            ->paginate(10);
        return view('Admin.DonHang.index', [
            "title" => "Quản lý đơn hàng - Hóa đơn hủy",
            "subtitle" => "Danh sách hóa đơn đã bị hủy",
            "listHoaDon" => $listHoaDonHuy,
            "trangThai" => self::$trangThai,
            "phuongThucThanhToan" => self::$phuongThucThanhToan,
        ]);
    }
    //Lấy danh sách hóa đơn theo ngày
    public function filterByDate(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $startDateFormatted = null;
        $endDateFormatted = null;

        if ($startDate && $endDate) {
            $startDateFormatted = Carbon::parse($startDate)->startOfDay();
            $endDateFormatted = Carbon::parse($endDate)->endOfDay();
           
            $listHoaDon = HoaDon::whereBetween('NgayLapHD', [$startDateFormatted, $endDateFormatted])
                                ->with(['taiKhoan', 'voucher'])
                                ->orderBy('MaHD', 'desc')
                                ->paginate(10);
        } 
        elseif ($startDate) {
            // Nếu có start mà không có end, lấy các đơn hàng từ ngày startDate trở đi
            $startDateFormatted = Carbon::parse($startDate)->startOfDay();
            
            $listHoaDon = HoaDon::where('NgayLapHD', '>=', $startDateFormatted)
                                ->with(['taiKhoan', 'voucher'])
                                ->orderBy('MaHD', 'desc')
                                ->paginate(10);
        }
        elseif ($endDate) {
            // Nếu có end mà không có start, lấy các đơn hàng đến ngày endDate
            $endDateFormatted = Carbon::parse($endDate)->endOfDay();
            
            $listHoaDon = HoaDon::where('NgayLapHD', '<=', $endDateFormatted)
                                ->with(['taiKhoan', 'voucher'])
                                ->orderBy('MaHD', 'desc')
                                ->paginate(10);
        }
        else {
            // Nếu không có ngày bắt đầu hoặc ngày kết thúc, lấy tất cả đơn hàng
            $listHoaDon = HoaDon::with(['taiKhoan', 'voucher'])
                                ->orderBy('MaHD', 'desc')
                                ->paginate(10);
        }
        // Nếu có ngày bắt đầu và ngày kết thúc, format lại chúng cho hiển thị
        if ($startDate && $endDate) {
            $startDateFormatted = Carbon::parse($startDate)->format('d/m/Y');
            $endDateFormatted = Carbon::parse($endDate)->format('d/m/Y');
        }
        $viewData = [
            "title" => "Quản lý đơn hàng - Từ " . $startDateFormatted . ' - ' . $endDateFormatted,
            "subtitle" => "Danh sách đơn hàng - Từ " . $startDateFormatted . ' - ' . $endDateFormatted,
            "listHoaDon" => $listHoaDon,
            "trangThai" => self::$trangThai,
            "phuongThucThanhToan" => self::$phuongThucThanhToan,
        ];

        return view('Admin.DonHang.index', $viewData);
    }
    //hàm hủy hóa đơn
    public function cancel(Request $request, $MaHD)
    {
        $hoaDon = HoaDon::where('MaHD', $MaHD)
            ->whereIn('TrangThai', [0, 1]) 
            ->first();

        if (!$hoaDon) {
            return redirect()->back()->with('error', 'Hóa đơn không thể hủy!');
        }
        $cancelReason = $request->input('cancel_reason');
        //Lưu vào bảng lịch sử hủy hóa đơn.
        LichSuHuyHoaDon::create([
            'MaHD' => $MaHD,
            'LyDoHuy' => $cancelReason,
            'NgayHuy' => now(),
            'NguoiHuy' => Session::get('user')['Username'] 
        ]);
        if (in_array($cancelReason, ['Khách hàng yêu cầu hủy', 'Đơn hàng sai thông tin', 
        'Khách hàng không thanh toán'])) {
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
        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công');
    }
    //Hàm cập nhật trạng thái đơn hàng
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
    // Phương thức tìm kiếm đơn hàng theo mã đơn hàng
    public function searchByOrderCode(Request $request)
    {
        $maDonHang = $request->input('maDonHang');

        if ($maDonHang) {
            $listHoaDon = HoaDon::where('MaHD', 'like', '%' . $maDonHang . '%')
                                ->with(['taiKhoan', 'voucher'])
                                ->orderBy('MaHD', 'desc')
                                ->paginate(10);
        } else {
            $listHoaDon = HoaDon::with(['taiKhoan', 'voucher'])
                                ->orderBy('MaHD', 'desc')
                                ->paginate(10);
        }
        $viewData = [
            'title' => 'Quản lý đơn hàng',
            'subtitle' => 'Kết quả tìm kiếm đơn hàng có mã "' . $maDonHang . '"', 
            'listHoaDon' => $listHoaDon,
            'trangThai' => self::$trangThai,
            'phuongThucThanhToan' => self::$phuongThucThanhToan,
        ];
        // Dữ liệu gửi tới view
        return view('Admin.DonHang.index', $viewData);
    }
}
