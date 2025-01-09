<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class ChiTietSanPhamController extends Controller
{
    public function show($id)
    {
        $product = Product::with(['comments', 'comments.user'])->findOrFail($id);
        $relatedProducts = Product::where('MaLoai', $product->MaLoai)
                                  ->where('id', '!=', $id)
                                  ->take(5)
                                  ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
    }
}
