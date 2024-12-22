<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $viewData = [
            "title" => "Blog | Double Click",
            "subtitle" => "Blog"
            ];
        return view('Blog.danhsachBlog',$viewData);
    }
    public function baiViet(){
        $viewData = [
            "title" => "Bài viết vè sản phẩm | Double Click",
            "subtitle" => "Bài viết"
            ];
        return view('Blog.baiVietSanPham', $viewData);
    }
}
