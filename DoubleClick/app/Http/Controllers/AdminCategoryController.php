<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
{
    private function getCategory()
    {
        return DB::table('loaisach')
            ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai')
            ->where('TrangThai', '!=', 2)
            ->paginate(10);
    }
    private function searchCategory($search)
    {
        return DB::table('loaisach')
            ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai')
            ->where('TenLoai', 'like', "%{$search}%")
            ->paginate(10);
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Kiểm tra từ khóa tìm kiếm
        if (!empty($search)) {
            $listCate = $this->searchCategory($search);
        } else {
            $listCate = $this->getCategory();
        }

        $viewData = [
            "title" => "Quản lý danh mục sách",
            "subtitle" => "Danh mục sách",
            "listCate" => $listCate,
            "search" => $search,
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
    public function trashed()
    {
        $trashedCategories = DB::table('loaisach')
            ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai')
            ->where('TrangThai', 2)
            ->paginate(10);

        $viewData = [
            'title' => 'Danh sách danh mục đã xóa',
            'subtitle' => 'Các danh mục đã xóa',
            'listCate' => $trashedCategories
        ];
        return view('admin.Category.index', $viewData);
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
    $request->validate([
        'TenLoai' => 'required|max:16', // Tối đa 16 ký tự
        'MoTa' => 'nullable|max:100',   // Tối đa 100 ký tự
        'TrangThai' => 'required|in:0,1', // Chỉ nhận giá trị 0 hoặc 1
    ]);

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

