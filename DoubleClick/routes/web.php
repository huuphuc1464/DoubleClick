<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThanhToanController;


use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminStatisticsController;
use App\Http\Controllers\Api\ChartController;


use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('Admin.layout'); // Đây là file view bạn vừa tạo
});

Route::prefix('danh-sach-lien-he')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/{id}/update-status', [ContactController::class, 'updateStatus'])->name('contacts.update-status');
    Route::post('/danh-sach-lien-he/{id}/update-status', [ContactController::class, 'updateStatusAction'])->name('contacts.update-status-action');

    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});
Route::post('/lien-he', [ContactController::class, 'store'])->name('contact.submit');


Route::get('/user', function () {
    return view('layout');
});



Route::get('/thanh-toan', [ThanhToanController::class, 'index'])->name('thanhToan');

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.danhSachBlog');
    Route::get('/bai-viet', [BlogController::class, 'baiViet'])->name('blog.baiviet');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// Route hiển thị form liên hệ
Route::get('/lien-he', [ContactUserController::class, 'showContactForm'])->name('contact.form');

// Route xử lý form liên hệ
Route::post('/lien-he', [ContactUserController::class, 'submitContactForm'])->name('contact.submit');


//Của Duy
/*Route::get('/admin/dashbroad', function () {
    return view('Admin.dashbroad');
});
*/
Route::get('admin/dashbroad', [AdminDashboardController::class, 'index'])->name('admin.dashbroad');


Route::get('/api/revenue-by-month', [ChartController::class, 'getRevenueByMonth']);
Route::get('/api/orders-by-month', [ChartController::class, 'getOrderByMonth']);

Route::get('/admin/statistics', [AdminStatisticsController::class, 'statistics'])->name('admin.statistics');
Route::get('/admin/statistics/chart-data/{year}/{month}', [AdminStatisticsController::class, 'getBestSellerChartData']);
Route::get('/admin/statistics/years-and-months', [AdminStatisticsController::class, 'getAvailableYearsAndMonths']);
