<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet; 

class BlogController extends Controller
{
    public function index()
    {
        $viewData = [
            "title" => "Blog | Double Click",
            "subtitle" => "Blog"
        ];
        return view('Blog.danhsachBlog', $viewData);
    }
    public function baiViet()
    {
        $viewData = [
            "title" => "Bài viết về sản phẩm | Double Click",
            "subtitle" => "Bài viết"
        ];
        return view('Blog.baiVietSanPham', $viewData);
    }




    //nhat

    public function show($id)
    {
        $baiViet = BaiViet::findOrFail($id);
        return view('user.baiviet', compact('baiViet'));
    }



    public function giaoHang()
    {
        $viewData = [
            "title" => "Bài viết về vận chuyển | Double Click",
            "subtitle" => "Bài viết"
        ];
        return view('Blog.giaoHangNhanh', $viewData);
    }
    public function giamGia()
    {
        $viewData = [
            "title" => "Bài viết về chương trình khuyến mãi | Double Click",
            "subtitle" => "Bài viết"
        ];
        return view('Blog.giamGia', $viewData);
    }
    public function chatLuongSach()
    {
        $viewData = [
            "title" => "Bài viết về chương trình khuyến mãi | Double Click",
            "subtitle" => "Bài viết"
        ];
        return view('Blog.chatLuongSach', $viewData);
    }
    public function hoTro()
    {
        $viewData = [
            "title" => "Bài viết về chương trình khuyến mãi | Double Click",
            "subtitle" => "Bài viết"
        ];
        return view('Blog.hoTro', $viewData);
    }
}
