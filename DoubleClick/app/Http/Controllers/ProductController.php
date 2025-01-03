<?php

namespace App\Http\Controllers;

use App\Models\Sach;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $banners = ['banner1.png', 'banner2.png', 'banner3.png', 'banner4.png', 'banner5.png', 'banner6.png', 'banner7.png'];

        // Lấy danh sách sách từ cơ sở dữ liệu
        $sach = Sach::all(); // Truy vấn tất cả sản phẩm sách

        // Trả về view và truyền dữ liệu banners và sach
        return view('user.products', compact('banners', 'sach'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
