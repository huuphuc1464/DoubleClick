<?php

use App\Http\Controllers\AdminNhanVienController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThanhToanController;


use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Api\ChartController;


use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('Admin.layout');
});
Route::get('/user', function () {
    return view('layout');
});

// đây là phần của Xuân Anh-----------------------------------------------------------------------------------------------------------

// Routes cho danh sách liên hệ
Route::prefix('danh-sach-lien-he')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/{id}/update-status', [ContactController::class, 'updateStatus'])->name('contacts.update-status');
    Route::post('/{id}/update-status', [ContactController::class, 'updateStatusAction'])->name('contacts.update-status-action');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy'); // Route này cần thêm
});


// Routes cho liên hệ từ người dùng
Route::get('/lien-he', [ContactUserController::class, 'showContactForm'])->name('contact.form');
Route::post('/lien-he', [ContactUserController::class, 'submitContactForm'])->name('contact.submit');

// Routes cho giỏ hàng
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Hiển thị giỏ hàng
    Route::post('/add', [CartController::class, 'add'])->name('cart.add'); // Thêm sản phẩm vào giỏ hàng

    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/remove-multiple', [CartController::class, 'removeMultiple'])->name('cart.removeMultiple'); // Xóa nhiều sản phẩm
    Route::post('/update', [CartController::class, 'update'])->name('cart.update'); // Cập nhật số lượng sản phẩm
});



// đây là kết thúc của Xuân Anh---------------------------------------------------------------------------------------------------------





Route::get('/thanh-toan', [ThanhToanController::class, 'index'])->name('thanhToan');

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.danhSachBlog');
    Route::get('/bai-viet', [BlogController::class, 'baiViet'])->name('blog.baiviet');
});
//Quản lý nhân viên: Thêm nhân viên, Sửa, Xóa, Khôi phục.
Route::prefix('quan-ly-nhan-vien')->group(function () {
    Route::get('/', [AdminNhanVienController::class, 'index'])->name('quanlynhanvien.index');
    Route::get('/them-nhan-vien', [AdminNhanVienController::class, 'index'])->name('quanlynhanvien.them');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/doimatkhau', [ProfileController::class, 'DoiMatKhau'])->name('profile.doimatkhau');
Route::post('/profile/updatePass', [ProfileController::class, 'updatePass'])->name('profile.updatePass');
Route::get('/profile/dsdonhang', [ProfileController::class, 'dsDonHang'])->name('profile.dsdonhang');
Route::get('/profile/dsdonhang/chitiet/{id}', [ProfileController::class, 'chiTietDonHang'])->name('profile.dsdonhang.chitiet');
Route::get('/profile/sachyeuthich', [ProfileController::class, 'dsSachYeuThich'])->name('profile.dsdonhang.sachyeuthich');
Route::get('/profile/danhgiasach/{id}', [ProfileController::class, 'danhGiaSach'])->name('profile.danhgiasach');
Route::get('/profile/danhsachdanhgia', [ProfileController::class, 'danhSachDanhGia'])->name('profile.dsdanhgia');

// Route hiển thị form liên hệ
Route::get('/lien-he', [ContactUserController::class, 'showContactForm'])->name('contact.form');

// Route xử lý form liên hệ
Route::post('/lien-he', [ContactUserController::class, 'submitContactForm'])->name('contact.submit');


//Của Duy 5cm
/*Route::get('/admin/dashbroad', function () {
    return view('Admin.dashbroad');
});
*/
Route::get('admin/dashbroad', [AdminDashboardController::class, 'index'])->name('admin.dashbroad');


Route::get('/api/revenue-by-month', [ChartController::class, 'getRevenueByMonth']);
Route::get('/api/orders-by-month', [ChartController::class, 'getOrderByMonth']);
