<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Validation\ValidationException;

class AdminVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::paginate(10);
        return view('Admin.Voucher.index', compact('vouchers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'MaVoucher' => 'required|unique:voucher|max:255',
                'TenVoucher' => 'required|max:255',
                'GiamGia' => 'required|integer|min:0|max:100',
                'NgayBatDau' => 'required|date|after_or_equal:today',
                'NgayKetThuc' => 'required|date|after:NgayBatDau',
                'GiaTriToiThieu' => 'required|numeric|min:0',
                'SoLuong' => 'required|integer|min:1',
            ]);

            // Create a new voucher
            Voucher::create($validatedData);

            return redirect()->route('admin.vouchers.index')->with('success', 'Voucher được thêm thành công!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình thêm voucher!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        return view('Admin.Voucher.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        return view('Admin.Voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'MaVoucher' => 'required|max:255|unique:voucher,MaVoucher,' . $voucher->MaVoucher . ',MaVoucher',
                'TenVoucher' => 'required|max:255',
                'GiamGia' => 'required|integer|min:0|max:100',
                'NgayBatDau' => 'required|date|after_or_equal:today',
                'NgayKetThuc' => 'required|date|after:NgayBatDau',
                'GiaTriToiThieu' => 'required|numeric|min:0',
                'SoLuong' => 'required|integer|min:1',
            ]);

            // Update voucher
            $voucher->update($validatedData);

            return redirect()->route('admin.vouchers.index')->with('success', 'Voucher được cập nhật thành công!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình cập nhật voucher!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        try {
            $voucher->delete();
            return redirect()->route('admin.vouchers.index')->with('success', 'Voucher đã được xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.vouchers.index')->with('error', 'Đã xảy ra lỗi khi xóa voucher!');
        }
    }
}
