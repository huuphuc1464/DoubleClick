<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ThanhToanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.layout');
});

Route::get('/user', function () {
    return view('layout');
});

Route::get('/thanh-toan', [ThanhToanController::class, 'index'])->name('thanhToan');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.danhSachBlog');
