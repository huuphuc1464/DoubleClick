<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $banners = ['banner0.png', 'banner1.png', 'banner2.png', 'banner3.png', 'banner4.png', 'banner5.png', 'banner6.png', 'banner7.png', 'banner8.png'];

        // Trả về view và truyền dữ liệu banners
        return view('user.products', compact('banners'));
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
