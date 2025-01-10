<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DanhSachLienHe; // Gọi model DanhSachLienHe

class ContactController extends Controller
{
    public function index()
    {
      
        // Lấy danh sách liên hệ với phân trang (5 mục mỗi trang)
        $contacts = \App\Models\DanhSachLienHe::orderBy('MaLienHe', 'desc')->paginate(5);

        // Truyền danh sách liên hệ vào view
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
            'Chưa xử lý' => 2,
        ];

        // Lấy trạng thái hiện tại từ cơ sở dữ liệu
        $currentStatus = $contact->TrangThai;

        // Lấy trạng thái mới từ yêu cầu
        $newStatusKey = $request->input('status'); // Chuỗi trạng thái được gửi từ form
        $newStatus = $statusMap[$newStatusKey] ?? null; // Ánh xạ sang giá trị số

        // Kiểm tra nếu trạng thái mới không hợp lệ
        if ($newStatus === null) {
            return back()->withErrors(['TrangThai' => 'Trạng thái không hợp lệ.']);
        }

        // Kiểm tra logic trạng thái
        if ($currentStatus == 0 && $newStatus == 2) {
            return back()->withErrors(['TrangThai' => 'Không thể chuyển từ Đang xử lý sang Chưa xử lý.']);
        }

        if ($currentStatus == 1 && ($newStatus == 0 || $newStatus == 2)) {
            return back()->withErrors(['TrangThai' => 'Không thể thay đổi trạng thái từ Đã xử lý sang trạng thái khác.']);
        }

        // Cập nhật trạng thái mới
        $contact->TrangThai = $newStatus;
        $contact->save();

        // Chuyển hướng lại với thông báo thành công
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

