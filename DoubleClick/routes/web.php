<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThanhToanController;


use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Api\ChartController;


use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('admin.layout');
});

Route::get('/user', function () {
    return view('layout');
});



Route::get('/thanh-toan', [ThanhToanController::class, 'index'])->name('thanhToan');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.danhSachBlog');
Route::get('/bai-viet', [BlogController::class, 'baiViet'])->name('blog.baiviet');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');


//Của Duy
/*Route::get('/admin/dashbroad', function () {
    return view('Admin.dashbroad');
});
*/
Route::get('admin/dashbroad', [AdminDashboardController::class, 'index'])->name('admin.dashbroad');


Route::get('/api/revenue-by-month', [ChartController::class, 'getRevenueByMonth']);
Route::get('/api/orders-by-month', [ChartController::class, 'getOrderByMonth']);
