<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class AdminVoucherController extends Controller
{

    public function toggleStatus($id)
    {
        try {
            // Tìm voucher theo ID
            $voucher = Voucher::findOrFail($id);
            // Chuyển trạng thái: Nếu đang hoạt động (1) thì chuyển sang vô hiệu hóa (0),
            $voucher->TrangThai = $voucher->TrangThai == 0 ? 1 : 0;
            $voucher->save();
            // Trả về thông báo thành công
            return redirect()->route('admin.vouchers.index')->with('success', 'Thay đổi trạng thái voucher thành công.');
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return redirect()->route('admin.vouchers.index')->with('error', 'Đã xảy ra lỗi khi thay đổi trạng thái.');
        }
    }
    public function index()
    {
        $vouchers = Voucher::paginate(10);
        return view('Admin.Voucher.index', compact('vouchers'));
    }
    public function create()
    {
        return view('Admin.Voucher.create');
    }

    public function store(Request $request)
    {
        try {
            // Custom validation messages
            $messages = [
                'MaVoucher.required' => 'Mã Voucher là bắt buộc.',
                'MaVoucher.unique' => 'Mã Voucher này đã tồn tại, vui lòng chọn mã khác.',
                'TenVoucher.required' => 'Tên Voucher không được để trống.',
                'GiamGia.required' => 'Vui lòng nhập giá trị giảm.',
                'GiamGia.integer' => 'Giảm giá phải là số nguyên.',
                'GiamGia.min' => 'Giảm giá không thể nhỏ hơn :min%.',
                'GiamGia.max' => 'Giảm giá không thể lớn hơn :max%.',
                'NgayBatDau.required' => 'Vui lòng chọn ngày bắt đầu.',
                'NgayBatDau.after_or_equal' => 'Ngày bắt đầu phải từ ngày hôm nay trở đi.',
                'NgayKetThuc.required' => 'Vui lòng chọn ngày kết thúc.',
                'NgayKetThuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
                'GiaTriToiThieu.required' => 'Giá trị tối thiểu không được để trống.',
                'GiaTriToiThieu.numeric' => 'Giá trị tối thiểu phải là số.',
                'SoLuong.required' => 'Số lượng không được để trống.',
                'SoLuong.integer' => 'Số lượng phải là số nguyên.',
                'SoLuong.min' => 'Số lượng ít nhất là :min.',
            ];

            // Validate request data
            $validatedData = $request->validate([
                'MaVoucher' => 'required|string|max:50|unique:voucher',
                'TenVoucher' => 'required|max:255',
                'GiamGia' => 'required|integer|min:0|max:100',
                'NgayBatDau' => 'required|date|after_or_equal:today',
                'NgayKetThuc' => 'required|date|after:NgayBatDau',
                'GiaTriToiThieu' => 'required|numeric|min:0',
                'SoLuong' => 'required|integer|min:1',
            ], $messages);

            // Đặt trạng thái mặc định
            $validatedData['TrangThai'] = 1; // 1: Hoạt động
            // Save the voucher
            Voucher::create($validatedData);
            return redirect()->route('admin.vouchers.index')->with('success', 'Voucher đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình xử lý.')->withInput();
        }
    }

    public function edit($MaVoucher)
    {
        $voucher = Voucher::where('MaVoucher', $MaVoucher)->first();
        return View('Admin.Voucher.edit', ['voucher' => $voucher]);
    }

    public function update(Request $request, $MaVoucher)
    {
        try {
            // Custom validation messages
            $messages = [
                'MaVoucher.required' => 'Mã Voucher là bắt buộc.',
                'TenVoucher.required' => 'Tên Voucher không được để trống.',
                'GiamGia.required' => 'Giá trị giảm giá là bắt buộc.',
                'GiamGia.integer' => 'Giảm giá phải là số nguyên.',
                'GiamGia.min' => 'Giảm giá không thể nhỏ hơn :min%.',
                'GiamGia.max' => 'Giảm giá không thể lớn hơn :max%.',
                'NgayBatDau.required' => 'Vui lòng chọn ngày bắt đầu.',
                'NgayBatDau.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',
                'NgayKetThuc.required' => 'Vui lòng chọn ngày kết thúc.',
                'NgayKetThuc.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
                'NgayKetThuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
                'GiaTriToiThieu.required' => 'Giá trị tối thiểu là bắt buộc.',
                'GiaTriToiThieu.numeric' => 'Giá trị tối thiểu phải là số.',
                'SoLuong.required' => 'Số lượng là bắt buộc.',
                'SoLuong.integer' => 'Số lượng phải là số nguyên.',
                'SoLuong.min' => 'Số lượng ít nhất phải là :min.',
            ];

            // Validate dữ liệu từ request
            $validatedData = $request->validate([
                'MaVoucher' => 'required|string|max:50',
                'TenVoucher' => 'required|string|max:255',
                'GiamGia' => 'required|integer|min:0|max:100',
                'NgayBatDau' => 'required|date',
                'NgayKetThuc' => 'required|date|after:NgayBatDau',
                'GiaTriToiThieu' => 'required|numeric|min:0',
                'SoLuong' => 'required|integer|min:1',
            ], $messages);

            // Tìm voucher theo MaVoucher
            $voucher = Voucher::where('MaVoucher', $MaVoucher)->firstOrFail();

            // Cập nhật dữ liệu voucher
            $voucher->update($validatedData);

            // Trả về thông báo thành công
            return redirect()->route('admin.vouchers.index')->with('success', 'Voucher đã được cập nhật thành công!');
        } catch (ValidationException $e) {
            // Trả về lỗi validate
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình cập nhật voucher!')->withInput();
        }
    }
}
