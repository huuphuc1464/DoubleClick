<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\Sach;
use App\Models\Voucher;
use App\Models\LichSuHuyHoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminDonHangController extends Controller
{ 
       // Các biến tĩnh cho trạng thái và phương thức thanh toán
    public static $trangThai = [
        ['maTrangThai' => 0, 'tenTrangThai' => "Chờ thanh toán"],
        ['maTrangThai' => 1, 'tenTrangThai' => "Đang xử lý"],
        ['maTrangThai' => 2, 'tenTrangThai' => "Đang vận chuyển"],
        ['maTrangThai' => 3, 'tenTrangThai' => "Đã giao"],
        ['maTrangThai' => 4, 'tenTrangThai' => "Hủy"],
    ];
    public static $phuongThucThanhToan = [
        ['idPayment' => "COD", 'paymentName' => "Thanh toán khi nhận hàng (COD)"],
        ['idPayment' => "VNPAY", 'paymentName' => "Thanh toán qua VNPAY"],
        ['idPayment' => "Banking", 'paymentName' => "Thanh toán chuyển khoản ngân hàng"],
    ];
    // Hàm tái sử dụng để lấy danh sách hóa đơn với điều kiện
    private function getHoaDonByConditions($conditions = [])
    {
        $query = HoaDon::with(['taiKhoan', 'voucher'])
            ->orderBy('MaHD', 'desc');

        // Áp dụng các điều kiện nếu có
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }

        return $query->paginate(10);
    }
    // Lấy hóa đơn theo trạng thái
    public function getTrangThaiHoaDon($trangThai)
{
    // Kiểm tra giá trị $trangThai được truyền vào
    

    $listHoaDon = $this->getHoaDonByConditions(['TrangThai' => $trangThai]);

    $trangThaiName = '';  // Khởi tạo biến trống
    foreach (self::$trangThai as $status) {
        // Kiểm tra kiểu dữ liệu để so sánh
        if ((int)$status['maTrangThai'] === (int)$trangThai) {
            $trangThaiName = $status['tenTrangThai'];  
            break;
        }
    }
    $viewData = [
        "title" => "Quản lý đơn hàng - " . $trangThaiName,
        "subtitle" => "Danh sách đơn hàng - " . $trangThaiName,
        "listHoaDon" => $listHoaDon,    
        "trangThai" => self::$trangThai,
        "phuongThucThanhToan" => self::$phuongThucThanhToan,
    ];

    return view('Admin.DonHang.index', $viewData);
    }
        // Lấy hóa đơn theo phương thức thanh toán
    public function getPhuongThucThanhToan($phuongThucThanhToan)
    {
        $listHoaDon = HoaDon::with(['taiKhoan', 'voucher'])
            ->where('PhuongThucThanhToan', $phuongThucThanhToan)
            ->orderBy('MaHD', 'desc')
            ->paginate(10);
        // Tìm tên phương thức thanh toán tương ứng
        $paymentName = '';
        foreach (self::$phuongThucThanhToan as $payment) {
            if ($payment['idPayment'] === $phuongThucThanhToan) {
                $paymentName = $payment['paymentName'];
                break;
            }
        }

        $viewData = [
            "title" => "Quản lý đơn hàng - " .$paymentName,  
            "subtitle" => "Danh sách đơn hàng - {$paymentName}",
            "listHoaDon" => $listHoaDon,
            "trangThai" => self::$trangThai,
            "phuongThucThanhToan" => self::$phuongThucThanhToan,
        ];

        return view('Admin.DonHang.index', $viewData);
    }
    public function filterByDate(Request $request)
    {
        // Lấy ngày bắt đầu và ngày kết thúc từ request
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Khởi tạo biến ngày bắt đầu và ngày kết thúc mặc định
        $startDateFormatted = null;
        $endDateFormatted = null;

        // Kiểm tra nếu ngày bắt đầu và ngày kết thúc có giá trị hợp lệ
        if ($startDate && $endDate) {
            // Đảm bảo rằng ngày bắt đầu và ngày kết thúc được chuyển thành định dạng chuẩn
            $startDateFormatted = Carbon::parse($startDate)->startOfDay();
            $endDateFormatted = Carbon::parse($endDate)->endOfDay();

            // Lấy danh sách đơn hàng theo điều kiện ngày
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

        // Dữ liệu gửi tới view
        $viewData = [
            "title" => "Quản lý đơn hàng - Từ " . $startDateFormatted . ' - ' . $endDateFormatted,
            "subtitle" => "Danh sách đơn hàng - Từ " . $startDateFormatted . ' - ' . $endDateFormatted,
            "listHoaDon" => $listHoaDon,
            "trangThai" => self::$trangThai,
            "phuongThucThanhToan" => self::$phuongThucThanhToan,
        ];

        return view('Admin.DonHang.index', $viewData);
    }
    // Trang chủ quản lý đơn hàng
    public function index()
    {
        $listHoaDon = $this->getHoaDonByConditions();

        $viewData = [
            "title" => "Quản lý đơn hàng",
            "subtitle" => "Danh sách đơn hàng",
            "listHoaDon" => $listHoaDon,
            "trangThai" => self::$trangThai,
            "phuongThucThanhToan" => self::$phuongThucThanhToan,
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
    // Phương thức tìm kiếm đơn hàng theo mã đơn hàng
    public function searchByOrderCode(Request $request)
    {
        // Lấy mã đơn hàng từ input
        $maDonHang = $request->input('maDonHang');

        // Kiểm tra nếu có mã đơn hàng
        if ($maDonHang) {
            // Tìm đơn hàng theo mã đơn hàng
            $listHoaDon = HoaDon::where('MaHD', 'like', '%' . $maDonHang . '%')
                                ->with(['taiKhoan', 'voucher'])
                                ->orderBy('MaHD', 'desc')
                                ->paginate(10);
        } else {
            // Nếu không có mã đơn hàng, lấy tất cả đơn hàng
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
