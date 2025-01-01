<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDonHangController;
use App\Http\Controllers\AdminNhanVienController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactUserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThanhToanController;


use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminStaffController;
use App\Http\Controllers\AdminStatisticsController;
use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('Admin.layout'); // Đây là file view bạn vừa tạo
});
Route::get('/user', function () {
    return view('layout');
});

// đây là phần của Xuân Anh-----------------------------------------------------------------------------------------------------------

Route::prefix('danh-sach-lien-he')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/{id}/update-status', [ContactController::class, 'updateStatus'])->name('contacts.update-status');
    Route::post('/danh-sach-lien-he/{id}/update-status', [ContactController::class, 'updateStatusAction'])->name('contacts.update-status-action');

    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});
//Route::post('/lien-he', [ContactController::class, 'store'])->name('contact.submit');
//Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');

// Route hiển thị form liên hệ
Route::get('/lien-he', [ContactUserController::class, 'showContactForm'])->name('contact.form');

// Route xử lý form liên hệ
Route::post('/lien-he', [ContactUserController::class, 'submitContactForm'])->name('contact.submit');

//Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');

// đây là kết thúc của Xuân Anh---------------------------------------------------------------------------------------------------------


Route::get('/user', function () {return view('layout');})->name('user');





//Chí Đạt start
Route::prefix('thanh-toan')->group( function(){
    Route::get('/', [PaymentController::class, 'index'])->name('thanhToan');
    Route::get('/thanks', [PaymentController::class, 'thanks'])->name('thanks');
});

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.danhSachBlog');
    Route::get('/bai-viet', [BlogController::class, 'baiViet'])->name('blog.baiviet');
});

Route::prefix('quan-ly-danh-muc')->group(function(){
    Route::get('/',[AdminCategoryController::class, 'index'])->name('admin.category');
    Route::get('/admin/category/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    Route::get('admin/categories/trashed', [AdminCategoryController::class, 'trashed'])->name('admin.category.trashed');
    Route::get('admin/category/restore/{id}', [AdminCategoryController::class, 'restore'])->name('admin.category.restore');
});

Route::prefix('quan-ly-don-hang')->group( function(){
    Route::get('/',[AdminDonHangController::class,'index'])->name('admin.donhang');
});

//Chí Đạt end.

//Nhật
Route::prefix('quan-ly-nhan-vien')->group(function () {
    Route::get('/', [AdminStaffController::class, 'index'])->name('staff.index');
    Route::get('/them', [AdminStaffController::class, 'create'])->name('staff.create');
    Route::post('/store', [AdminStaffController::class, 'store'])->name('staff.store'); // Thêm route này
});
Route::get('/san-pham', [ProductController::class, 'index'])->name('user.products');










//Phúc
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/doimatkhau', [ProfileController::class, 'DoiMatKhau'])->name('profile.doimatkhau');
Route::post('/profile/updatePass', [ProfileController::class, 'updatePass'])->name('profile.updatePass');
Route::get('/profile/dsdonhang', [ProfileController::class, 'dsDonHang'])->name('profile.dsdonhang');
Route::get('/profile/dsdonhang/chitiet/{id}', [ProfileController::class, 'chiTietDonHang'])->name('profile.dsdonhang.chitiet');
Route::get('/profile/sachyeuthich', [ProfileController::class, 'dsSachYeuThich'])->name('profile.sachyeuthich');
Route::get('/profile/danhgiasach/{id}', [ProfileController::class, 'danhGiaSach'])->name('profile.danhgiasach');
Route::get('/profile/danhsachdanhgia', [ProfileController::class, 'danhSachDanhGia'])->name('profile.dsdanhgia');
Route::delete('/profile/sachyeuthich/xoa', [ProfileController::class, 'xoaSachYeuThich'])->name('profile.sachyeuthich.xoa');
Route::post('profile/sachyeuthich/addToCart', [ProfileController::class, 'addToCart'])->name('profile.sachyeuthich.addToCart');









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

Route::get('/admin/statistics', [AdminStatisticsController::class, 'statistics'])->name('admin.statistics');
Route::get('/admin/statistics/chart-data/{year}/{month}', [AdminStatisticsController::class, 'getBestSellerChartData']);
Route::get('/admin/statistics/years-and-months', [AdminStatisticsController::class, 'getAvailableYearsAndMonths']);
Route::get('admin/suppliers', function () {
    return view('admin.suppliers.index');
})->name('admin.suppliers.index');