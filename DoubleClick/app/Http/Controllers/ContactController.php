<?php

namespace App\Http\Controllers;

use App\Models\DanhSachLienHe; // Gọi model DanhSachLienHe

class ContactController extends Controller
{
    public function index()
    {
        // Lấy toàn bộ dữ liệu từ bảng danhSachLienHe
        $contacts = DanhSachLienHe::all();

        // Truyền dữ liệu sang view
        return view('danhSachLienHe', compact('contacts'));
    }
    public function show($id)
{
    $contact = \App\Models\DanhSachLienHe::findOrFail($id); // Tìm liên hệ theo ID
    return view('chiTietLienHe', compact('contact'));
}

public function updateStatus($id)
{
    // Lấy thông tin liên hệ theo ID
    $contact = \App\Models\DanhSachLienHe::findOrFail($id);

    // Truyền thông tin liên hệ sang view
    return view('updateStatus', compact('contact'));
}

public function updateStatusAction($id, \Illuminate\Http\Request $request)
{
    // Lấy thông tin liên hệ theo ID
    $contact = \App\Models\DanhSachLienHe::findOrFail($id);

    // Cập nhật trạng thái
    $contact->status = $request->input('status');
    $contact->save();

    // Trả về trang cập nhật trạng thái với thông báo thành công
    return redirect()->route('contacts.update-status', ['id' => $id])
                     ->with('success', 'Trạng thái đã được cập nhật thành công.');
}


}
