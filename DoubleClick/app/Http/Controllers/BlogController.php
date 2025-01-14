<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\BaiViet; 

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Lấy số trang hiện tại, nếu không có thì mặc định là trang 1
        $currentPage = $request->input('page', 1);

        // Lấy tổng số trang
        $totalPages = Blog::where('Blog.TrangThai', 1)
            ->where('Blog.MaDanhMucBlog','!=',6)
            ->count() / 3;  // Giả sử mỗi trang có tối đa 3 bài viết

        // Giới hạn số trang không vượt quá tổng số trang
        $currentPage = min($currentPage, ceil($totalPages));  // Làm tròn lên nếu cần

        // Lấy danh sách blog và phân trang
        $listBlog = Blog::with('danhmucblog', 'taikhoan')
            ->where('Blog.TrangThai', 1)
            ->where('Blog.MaDanhMucBlog','!=',6)
            ->orderBy('Blog.MaBlog', 'desc')
            ->paginate(3, ['*'], 'page', $currentPage);

        $viewData = [
            "title" => "Blog | Double Click",
            "subtitle" => "Danh sách Blog",
            "listBlog" => $listBlog,
        ];

        return view('Blog.index', $viewData);
    }


    public function detail($id){
        $blog = Blog::with('danhmucblog', 'taikhoan')
            ->where('Blog.TrangThai', 1)
            ->where('MaBlog', $id)
            ->first();  // Sử dụng first() để lấy một đối tượng duy nhất

        // Cập nhật title bao gồm TieuDe của bài viết
        $viewData = [
            "title" => "Bài viết - " . $blog->TieuDe,  // Thêm Tiêu Đề vào title
            "subtitle" => "Bài viết" . $blog->TieuDe,
            "blog" => $blog,  // Truyền đối tượng blog duy nhất
        ];

        return view('Blog.detail', $viewData);
    }

    public function searchBlogs(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ input
        $searchTerm = $request->input('search');

        // Lấy số trang hiện tại, nếu không có thì mặc định là trang 1
        $currentPage = $request->input('page', 1);

        // Tìm kiếm bài viết theo từ khóa trong tiêu đề
        $totalResults = Blog::where('Blog.TrangThai', 1)
            ->where('MaDanhMucBlog', '6')
            ->where('TieuDe', 'like', '%' . $searchTerm . '%')
            ->count();  // Tính tổng số bài viết theo điều kiện tìm kiếm

        // Tính tổng số trang
        $totalPages = ceil($totalResults / 3);

        // Nếu trang yêu cầu lớn hơn tổng số trang, chuyển về trang cuối cùng
        $currentPage = min($currentPage, $totalPages);

        // Tìm kiếm và phân trang
        $listBlog = Blog::with('danhmucblog', 'taikhoan')
            ->where('Blog.TrangThai', 1)
            ->where('MaDanhMucBlog', '6') // Đảm bảo lấy đúng loại bài viết
            ->where('TieuDe', 'like', '%' . $searchTerm . '%') // Điều kiện tìm kiếm theo Tiêu Đề
            ->orderBy('Blog.MaBlog', 'desc')
            ->paginate(3, ['*'], 'page', $currentPage);

        // Trả dữ liệu ra view
        $viewData = [
            "title" => "Bài viết về sản phẩm | Double Click",
            "subtitle" => "Bài viết về sản phẩm",
            "listBlog" => $listBlog,
            "searchTerm" => $searchTerm, // Truyền từ khóa tìm kiếm vào view
        ];

        return view('Blog.baiVietSanPham', $viewData);
    }

    public function baiViet(Request $request)
    {
        // Lấy số trang hiện tại, nếu không có thì mặc định là trang 1
        $currentPage = $request->input('page', 1);

        // Lấy tổng số bài viết theo điều kiện
        $totalResults = Blog::where('Blog.TrangThai', 1)
            ->where('MaDanhMucBlog','6')
            ->count();  // Tính tổng số bài viết

        // Tính tổng số trang
        $totalPages = ceil($totalResults / 3);  // Mỗi trang có tối đa 5 bài viết

        // Nếu trang yêu cầu lớn hơn tổng số trang, chuyển về trang cuối cùng
        $currentPage = min($currentPage, $totalPages);

        // Lấy danh sách bài viết và phân trang
        $listBlog = Blog::with('danhmucblog', 'taikhoan')
            ->where('Blog.TrangThai', 1)
            ->where('MaDanhMucBlog','6')
            ->orderBy('Blog.NgayDang', 'desc')
            ->paginate(3, ['*'], 'page', $currentPage);

        $viewData = [
            "title" => "Bài viết về sản phẩm | Double Click",
            "subtitle" => "Bài viết về sản phẩm",
            "listBlog" => $listBlog
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
