<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DanhSachLienHe; // Gọi model DanhSachLienHe

class ContactController extends Controller
{
    public function index()
    {
        $contacts = DanhSachLienHe::all(); // Lấy toàn bộ dữ liệu từ bảng danhSachLienHe
        return view('LienHe.danhSachLienHe', compact('contacts'));

    }

    public function show($id)
{
    // Lấy thông tin liên hệ theo ID
    $contact = \App\Models\DanhSachLienHe::findOrFail($id);

    // Trả về view chi tiết liên hệ, truyền biến $contact
    return view('LienHe.chiTietLienHe', compact('contact'));
}


public function updateStatus($id)
{
    // Lấy liên hệ theo ID (MaLienHe)
    $contact = \App\Models\DanhSachLienHe::findOrFail($id);

    // Truyền dữ liệu sang view
    return view('LienHe.updateStatus', compact('contact'));
}


public function updateStatusAction(Request $request, $id)
{
    // Lấy thông tin liên hệ theo ID
    $contact = \App\Models\DanhSachLienHe::findOrFail($id);

    // Ánh xạ trạng thái từ chuỗi sang số
    $statusMap = [
        'Đã xử lý' => 1,
        'Đang xử lý' => 0,
        'Chưa xử lý' => -1,
    ];

    // Cập nhật trạng thái
    $contact->TrangThai = $statusMap[$request->input('status')] ?? -1;
    $contact->save();

    // Chuyển hướng về lại trang cập nhật với thông tin mới
    return redirect()->route('contacts.update-status', ['id' => $id])->with('success', 'Trạng thái đã được cập nhật.');
}



public function destroy($id)
    {
        // Tìm liên hệ theo ID
        $contact = DanhSachLienHe::findOrFail($id);

        // Xóa liên hệ
        $contact->delete();

        // Chuyển hướng về danh sách liên hệ với thông báo thành công
        return redirect()->route('contacts.index')->with('success', 'Liên hệ đã được xóa thành công.');
    }
    public function store(Request $request)
{
    // Validate dữ liệu từ form
    $request->validate([
        'HoTen' => 'required|string|max:255',
        'SDT' => 'required|string|max:15',
        'Email' => 'required|email|max:255',
        'NoiDung' => 'required|string',
    ]);

    // Lưu dữ liệu vào bảng `lienhe`
    lienHe::create([
        'HoTen' => $request->HoTen,
        'SDT' => $request->SDT,
        'Email' => $request->Email,
        'NoiDung' => $request->NoiDung,
        'TrangThai' => 0, // Mặc định là chưa xử lý
    ]);

    // Chuyển hướng đến danh sách liên hệ
    return redirect()->route('contact.index')->with('success', 'Thông tin liên hệ đã được gửi thành công!');
}

}

