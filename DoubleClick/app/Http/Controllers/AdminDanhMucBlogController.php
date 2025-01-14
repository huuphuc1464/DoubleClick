<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDanhMucBlogController extends Controller
{ 
    private function getDanhMucBlog(){
        return DB::table('danhmucblog')
            ->select('MaDanhMucBlog', 'TenDanhMucBlog', 'SlugDanhMucBlog', 'MoTa', 'TrangThai')
            ->where('TrangThai', '!=', 2)
            ->paginate(10);
    }
    public function index(){
        $listCateBlog = $this->getDanhMucBlog();
        $viewData = [
            "title"=>"Danh mục Blog",
            "subtitle"=>"Danh sách danh mục",
            "listCateBlog"=>$listCateBlog
            ];
            return view('Admin.DanhMucBlog.index', $viewData);
    }
}
