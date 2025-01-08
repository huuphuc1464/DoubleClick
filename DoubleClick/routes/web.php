<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\AdminVoucherController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\TimSachApiController;
use App\Http\Controllers\TimSachController;
use App\Http\Controllers\LoginUserController;



Route::get('/', function () {
    return view('Admin.layout');
});
Route::get('/user', function () {
    return view('layout');
});

//Tân sau đăng nhập ----------------------------------------------
Route::get('/userdn', function () {
    return view('layoutdn');
});

// đây là phần của Xuân Anh-----------------------------------------------------------------------------------------------------------

// Routes cho danh sách liên hệ
Route::prefix('danh-sach-lien-he')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/{id}/update-status', [ContactController::class, 'updateStatus'])->name('contacts.update-status');
    Route::post('/{id}/update-status', [ContactController::class, 'updateStatusAction'])->name('contacts.update-status-action');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
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


Route::get('/user', function () {
    return view('layout');
})->name('user');





//Chí Đạt start
Route::prefix('thanh-toan')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('thanhToan');
    Route::get('/thanks', [PaymentController::class, 'thanks'])->name('thanks');
});

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.danhSachBlog');
    Route::get('/bai-viet', [BlogController::class, 'baiViet'])->name('blog.baiviet');
});

Route::prefix('quan-ly-danh-muc')->group(function () {
    Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category');
    Route::get('/admin/category/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    Route::get('admin/categories/trashed', [AdminCategoryController::class, 'trashed'])->name('admin.category.trashed');
    Route::get('admin/category/restore/{id}', [AdminCategoryController::class, 'restore'])->name('admin.category.restore');
});

Route::prefix('quan-ly-don-hang')->group(function () {
    Route::get('/', [AdminDonHangController::class, 'index'])->name('admin.donhang');
    Route::put('/cancel/{MaHD}', [AdminDonHangController::class, 'cancel'])->name('admin.donhang.cancel');
    Route::put('/don-hang/update-status/{MaHD}', [AdminDonHangController::class, 'updateStatus'])->name('admin.donhang.updateStatus');
});

//Chí Đạt end.

//Nhật

Route::prefix('quan-ly-nhan-vien')->group(function () {
    Route::get('/', [AdminStaffController::class, 'index'])->name('staff.index');
    Route::get('/them', [AdminStaffController::class, 'create'])->name('staff.create');
    Route::post('/quan-ly-nhan-vien/store', [AdminStaffController::class, 'store'])->name('staff.store');
    Route::get('/tim-kiem', [AdminStaffController::class, 'search'])->name('staff.search'); // Thêm route tìm kiếm
    Route::get('/delete', [AdminStaffController::class, 'listDeleted'])->name("staff.listDeleted");
    Route::get('/{id}/delete', [AdminStaffController::class, 'delete'])->name("staff.delete");
    Route::get('quan-ly-nhan-vien/{id}/restore', [AdminStaffController::class, 'restore'])->name('staff.restore');
    Route::get('/{id}/edit', [AdminStaffController::class, 'edit'])->name('staff.edit');
    Route::put('/{id}/update', [AdminStaffController::class, 'update'])->name('staff.update');
});

Route::get('/san-pham', [ProductController::class, 'index'])->name('user.products');










//Phúc
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/doimatkhau', [ProfileController::class, 'DoiMatKhau'])->name('profile.doimatkhau');
Route::post('/profile/updatePass', [ProfileController::class, 'updatePass'])->name('profile.updatePass');
Route::get('/profile/dsdonhang', [ProfileController::class, 'dsDonHang'])->name('profile.dsdonhang');
Route::get('/profile/dsdonhang/chitiet/{id}', [ProfileController::class, 'chiTietDonHang'])->name('profile.dsdonhang.chitiet');
Route::get('/profile/dsdonhang/huydonhang/{id}', [ProfileController::class, 'huyDonHang'])->name('profile.dsdonhang.huy');
Route::post('/profile/dsdonhang/huydonhang/luu', [ProfileController::class, 'luuHuyDonHang'])->name('profile.dsdonhang.huy.luu');
Route::get('/profile/dsdonhang/chitiethuydon/{id}', [ProfileController::class, 'chiTietHuyDon'])->name('profile.dsdonhang.chitiethuydon');
Route::get('/profile/sachyeuthich', [ProfileController::class, 'dsSachYeuThich'])->name('profile.sachyeuthich');
Route::get('/profile/danhgiasach/{id}', [ProfileController::class, 'danhGiaSach'])->name('profile.danhgiasach');
Route::post('/profile/danhgiasach/{id}', [ProfileController::class, 'luuDanhGia'])->name('profile.luudanhgia');
Route::get('/profile/danhsachdanhgia', [ProfileController::class, 'danhSachDanhGia'])->name('profile.dsdanhgia');
Route::delete('/profile/sachyeuthich/xoa', [ProfileController::class, 'xoaSachYeuThich'])->name('profile.sachyeuthich.xoa');
Route::post('profile/sachyeuthich/addToCart', [ProfileController::class, 'addToCart'])->name('profile.sachyeuthich.addToCart');
Route::post('profile/sachyeuthich/addAllToCart', [ProfileController::class, 'addAllToCart'])->name('profile.sachyeuthich.addAll');
Route::delete('/profile/danhsachdanhgia/xoa/{id}', [ProfileController::class, 'xoaDanhGia'])->name('profile.dsdanhgia.xoa');









// Route hiển thị form liên hệ
Route::get('/lien-he', [ContactUserController::class, 'showContactForm'])->name('contact.form');

// Route xử lý form liên hệ
Route::post('/lien-he', [ContactUserController::class, 'submitContactForm'])->name('contact.submit');




// Đức Duy
/*Route::get('admin/suppliers', function () {
    return view('admin.suppliers.index');
})->name('admin.suppliers.index');
*/

Route::get('admin/dashbroad', [AdminDashboardController::class, 'index'])->name('admin.dashbroad');


Route::get('/admin/statistics', [AdminStatisticsController::class, 'statistics'])->name('admin.statistics');

Route::get('/admin/statistics/chart-data/{year}/{month}', [AdminStatisticsController::class, 'getBestSellerChartData']);
Route::get('/admin/statistics/years-and-months', [AdminStatisticsController::class, 'getAvailableYearsAndMonths']);






//Minh Tân





Route::post('/login', [LoginUserController::class, 'login'])->name('login');
//Route::get('/user/{user_id}', [LoginUserController::class, 'index'])->name('user');





// Minh Tan

//Route::prefix('admin')->name('admin.')->group(function () {
    //Route::resource('vouchers', AdminVoucherController::class);
//});


//Route::prefix('api')->middleware('api')->group(function () {
    //Route::get('/sach', [TimSachApiController::class, 'index'])->name('api.sach.index');
//});

//Route::get('user/tim-sach', [TimSachController::class, 'index'])->name('user.timsach');
