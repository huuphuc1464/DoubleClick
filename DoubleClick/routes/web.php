<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThanhToanController;
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

Route::get('/user', function () {
    return view('layout');
});

Route::get('/thanh-toan', [ThanhToanController::class, 'index'])->name('thanhToan');

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.danhSachBlog');
    Route::get('/bai-viet', [BlogController::class, 'baiViet'])->name('blog.baiviet');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
