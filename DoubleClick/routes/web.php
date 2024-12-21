<?php

use App\Http\Controllers\ThanhToanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.layout');
});

Route::get('/user', function () {
    return view('user.layout');
});

Route::get('/thanh-toan',[ThanhToanController::class,'index'])->name('User.thanhToan');