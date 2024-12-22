<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('Layouts.admin'); // Đây là file view bạn vừa tạo
});
Route::get('/danh-sach-lien-he', [ContactController::class, 'index'])->name('contacts.index');

Route::get('/danh-sach-lien-he/{id}', [ContactController::class, 'show'])->name('contacts.show');

Route::get('/danh-sach-lien-he/{id}/update-status', [ContactController::class, 'updateStatus'])->name('contacts.update-status');

Route::post('/danh-sach-lien-he/{id}/update-status', [ContactController::class, 'updateStatusAction'])->name('contacts.update-status-action');

