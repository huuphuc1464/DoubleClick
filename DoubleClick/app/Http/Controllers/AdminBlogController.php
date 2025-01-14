<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\DanhMucBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class AdminBlogController extends Controller
{
    public function index(){
        $listBlog = Blog::with('danhmucblog','taikhoan')
        ->where('Blog.TrangThai',1)
        ->paginate(5);
        $viewData = [
            "title" => "Quản lý bài viết",
            "subtitle"=>"Danh sách bài viết",
            "listBlog"=>$listBlog    
        ];
        return view('Admin.Blog.index',$viewData);
    }
    public function create()
    {
        // Lấy danh mục blog có trạng thái = 1
        $listCateBlog = DanhMucBlog::where('TrangThai', 1)->get();

        // Truyền dữ liệu vào view
        $viewData = [
            "title" => "Thêm bài viết",
            "subtitle" => "Thêm bài viết mới",
            "listCateBlog" => $listCateBlog  // Truyền danh sách danh mục vào view
        ];

        return view('Admin.Blog.create', $viewData);
    }
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'TieuDe' => 'required',
            'SubTieuDe' => 'nullable',
            'MaDanhMucBlog' => 'required|exists:DanhMucBlog,MaDanhMucBlog',
            'TacGia' => 'required|string|max:255',
            'TrangThai' => 'required|in:0,1',
            'NoiDung' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Tạo slug từ tiêu đề
        $slug = Str::slug($request->input('TieuDe'), '-');
        // Kiểm tra xem slug đã tồn tại hay chưa
        $existingSlug = Blog::where('Slug', $slug)->first();
        if ($existingSlug) {
            // Nếu slug đã tồn tại, thêm số vào cuối slug để đảm bảo duy nhất
            $slug = $slug . '-' . time();
        }

        // Tạo bài viết mới
        $blog = new Blog();
        $blog->TieuDe = $request->input('TieuDe');
        $blog->SubTieuDe = $request->input('SubTieuDe') ?: NULL;
        $blog->MaDanhMucBlog = $request->input('MaDanhMucBlog');
        $blog->TacGia = $request->input('TacGia');
        $blog->TrangThai = $request->input('TrangThai');
        $blog->NoiDung = $request->input('NoiDung');
        $blog->MaTK = Session::get('user')['MaTK'];
        $blog->Slug = $slug;
        $blog->NgayDang = now(); 

        // Lưu ảnh nếu có
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Tạo tên duy nhất cho ảnh
            $imageName = time() . '-' . $image->getClientOriginalName();

            // Lưu ảnh vào thư mục public/img/Blog
            $image->move(public_path('img/baiviet'), $imageName);

            // Lưu tên file ảnh vào cơ sở dữ liệu
            $blog->AnhBlog = $imageName;
        }


        // Lưu bài viết vào cơ sở dữ liệu
        $blog->save();

        // Chuyển hướng về trang danh sách bài viết với thông báo thành công
        return redirect()->route('blog')->with('success', 'Bài viết đã được tạo thành công!');
    }
}
