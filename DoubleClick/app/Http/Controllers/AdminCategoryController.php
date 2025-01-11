<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
{
    private function getCategory($status = null)
    {
        $query = DB::table('loaisach')
            ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai');

        // Lọc trạng thái nếu được truyền
        if ($status !== null) {
            $query->where('TrangThai', $status);
        } else {
            $query->where('TrangThai', '!=', 2);
        }

        return $query->paginate(10);
    }

    private function searchCategory($search, $status = null)
    {
        $query = DB::table('loaisach')
            ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai')
            ->where('TenLoai', 'like', "%{$search}%");

        // Lọc trạng thái nếu được truyền
        if ($status !== null) {
            $query->where('TrangThai', $status);
        } else {
            $query->where('TrangThai', '!=', 2);
        }

        return $query->paginate(10);
    }
    public function trashed(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $listCate = $this->searchCategory($search, 2);
        } else {
            $listCate = $this->getCategory(2);
        }

        $viewData = [
            'title' => 'Danh sách danh mục đã xóa',
            'subtitle' => 'Các danh mục đã xóa',
            'listCate' => $listCate,
            'search' => $search,
            'currentView' => 'trashed', // Đánh dấu là trang danh mục đã xóa
        ];

        return view('admin.Category.index', $viewData);
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $listCate = $this->searchCategory($search, null); // null = trạng thái != 2
        } else {
            $listCate = $this->getCategory();
        }

        $viewData = [
            "title" => "Quản lý danh mục sách",
            "subtitle" => "Danh mục sách",
            "listCate" => $listCate,
            "search" => $search,
            "currentView" => 'index', // Đánh dấu là trang quản lý danh mục
        ];

        return view('admin.Category.index', $viewData);
    }

    public function delete($id)
    {
        $affected = DB::table('loaisach')
            ->where('MaLoai', $id)
            ->update(['TrangThai' => 2]);

        if ($affected) {
            return redirect()->route('admin.category')
                ->with('success', 'Danh mục đã được xóa.');
        }

        return redirect()->route('admin.category')
            ->with('error', 'Không thể xóa danh mục.');
    }
    public function restore($id)
    {
        $result = DB::table('loaisach')
            ->where('MaLoai', $id)
            ->update(['TrangThai' => 1]);
        if ($result) {
            return redirect()->route('admin.category')
                ->with('success', 'Danh mục đã được khôi phục thành công!');
        } else {
            return redirect()->route('admin.category')
                ->with('error', 'Khôi phục danh mục thất bại!');
        }
    }
    public function edit($id)
    {
        $category = DB::table('loaisach')
            ->where('MaLoai', $id)
            ->first();

        if (!$category) {
            return redirect()->route('admin.category')->with('error', 'Danh mục không tồn tại.');
        }

        return view('admin.Category.edit', compact('category'));
    }
    public function update(Request $request, $id)
{
    $message = [
        'MoTa.regex' => "Chỉ cho phép nhập chữ cái và khoảng trắng",
        'TenLoai.regex' => "Chỉ cho phép nhập chữ cái và khoảng trắng",
        'TenLoai.unique' => "Tên danh mục đã tồn tại. Vui lòng chọn tên khác."
    ];

    // Kiểm tra và validate dữ liệu
    $request->validate([
        'TenLoai' => 'required|regex:/^[^\d]+$/u|max:20|unique:loaisach,TenLoai,' . $id . ',MaLoai',
        'MoTa' => 'nullable|regex:/^[^\d]+$/u|max:100', // Chỉ cho phép chữ cái và khoảng trắng
        'TrangThai' => 'required|in:0,1', // Chỉ nhận giá trị 0 hoặc 1
    ], $message);

    // Cập nhật danh mục
    $affected = DB::table('loaisach')
        ->where('MaLoai', $id)
        ->update([
            'TenLoai' => $request->input('TenLoai'),
            'MoTa' => $request->input('MoTa'),
            'TrangThai' => $request->input('TrangThai'),
        ]);

    if ($affected) {
        return redirect()->route('admin.category')->with('success', 'Cập nhật danh mục thành công!');
    }

    return redirect()->route('admin.category')->with('error', 'Cập nhật danh mục thất bại!');
}







}

