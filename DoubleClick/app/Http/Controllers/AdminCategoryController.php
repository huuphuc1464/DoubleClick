<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
{
    
    private function getCategory($search = null)
    {
        $query = DB::table('loaisach')
            ->select('loaisach.MaLoai', 'loaisach.TenLoai', 'loaisach.SlugLoai', 'loaisach.MoTa', 'loaisach.TrangThai');

        if (!empty($search)) {
            $query->where('loaisach.TenLoai', 'like', "%{$search}%");
        }

        return $query->where('loaisach.TrangThai',1)->paginate(10);
    }

    public function index(Request $request)
    {
        $search = $request->input('search'); 
        $listCate = $this->getCategory($search);

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
            return redirect()->route('admin.category')->with('success', 'Danh mục đã được xóa.');
        }

        return redirect()->route('admin.category')->with('error', 'Không thể xóa danh mục.');
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
            return redirect()->route('admin.category')->with('success', 'Danh mục đã được khôi phục thành công!');
        } else {
            return redirect()->route('admin.category')->with('error', 'Khôi phục danh mục thất bại!');
        }
    }
}

