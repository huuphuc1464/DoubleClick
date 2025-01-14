<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDanhGiaController;
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
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminSachController;
use App\Http\Controllers\AdminStaffController;
use App\Http\Controllers\AdminStatisticsController;
use App\Http\Controllers\AdminVoucherController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\TimSachApiController;
use App\Http\Controllers\ChiTietSanPhamController;
use App\Http\Controllers\TimSachController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CustomAuth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Api\ChartController;
use Illuminate\Foundation\Console\AboutCommand;

//Ví dụ start
//Route xác thực ví dụ
// 1: Admin
// 2: Staff
// 3: Guest

//Route::middleware([CustomAuth::class, CheckRole::class . ':1'])->group(function () {
//    Route::get('/user/profile', [ProfileController::class, 'index']);
//});

//ví dụ end

Route::get('/login', [ProductController::class, 'index'])->name('login');

Route::get('/', function () {
    $isLoggedIn = Session::has('user'); // Kiểm tra trạng thái đăng nhập
    return view('layout', ['isLoggedIn' => $isLoggedIn]); // Truyền biến vào view
})->name('user');



// đây là phần của Xuân Anh-----------------------------------------------------------------------------------------------------------

// Routes cho danh sách liên hệ
Route::prefix('danh-sach-lien-he')->middleware([CustomAuth::class, CheckRole::class . ':1'])->group(function () {
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






//Chí Đạt start
Route::prefix('thanh-toan')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('thanhToan');
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/thanks', [PaymentController::class, 'thanks'])->name('payment.thanks');
    Route::get('/payment/vnpay-ipn', [PaymentController::class, 'handleVNPAYIPN'])->name('payment.handle-ipn');
});


Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.danhSachBlog');
    Route::get('/bai-viet', [BlogController::class, 'baiViet'])->name('blog.baiviet');
    Route::get('/giao-hang', [BlogController::class, 'giaoHang'])->name('blog.giaohang');
    Route::get('/giam-gia', [BlogController::class, 'giamGia'])->name('blog.giamgia');
    Route::get('/chat-luong-sach', [BlogController::class, 'chatLuongSach'])->name('blog.chatluongsach');
    Route::get('/ho-tro', [BlogController::class, 'hoTro'])->name('blog.hoTro');
});

// Route cho quản lý danh mục (Chỉ Admin - role = 1)
Route::middleware([CustomAuth::class, CheckRole::class . ':1'])->group(function () {
    Route::prefix('quan-ly-danh-muc')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category');
        Route::get('/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
        Route::get('/categories/trashed', [AdminCategoryController::class, 'trashed'])->name('admin.category.trashed');
        Route::get('/category/restore/{id}', [AdminCategoryController::class, 'restore'])->name('admin.category.restore');
        //Routes cho Sửa danh mục
        Route::get('/admin/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/admin/category/update/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    });
});
Route::middleware([CustomAuth::class, CheckRole::class . ':1,2'])->group(function () {
    Route::prefix('quan-ly-don-hang')->group(function () {
        Route::get('/', [AdminDonHangController::class, 'index'])->name('admin.donhang');
        Route::get('/hoa-don/detail/{maHD}', [AdminDonHangController::class, 'detail'])->name('admin.donhang.detail');
        Route::get('/trang-thai-hoa-don/{TrangThai}', [AdminDonHangController::class, 'getHoaDonTrangThai'])->name('admin.donhang.trangthai');
        Route::get('/hoa-don-huy', [AdminDonHangController::class, 'hoaDonHuy'])->name('admin.donhang.huy');
        Route::get('/hinh-thuc-thanh-toan/{HinhThucThanhToan}', [AdminDonHangController::class, 'filterByPaymentMethod'])->name('admin.donhang.phuongthucthanhtoan');
        Route::put('/cancel/{MaHD}', [AdminDonHangController::class, 'cancel'])->name('admin.donhang.cancel');
        Route::put('/don-hang/update-status/{MaHD}', [AdminDonHangController::class, 'updateStatus'])->name('admin.donhang.updateStatus');
        Route::get('/tim-theo-ngay', [AdminDonHangController::class, 'filterByDate'])->name('admin.donhang.filterByDate');
        Route::get('/quan-ly-don-hang/tim-kiem', [AdminDonHangController::class, 'searchByOrderCode'])->name('admin.donhang.search');
    });
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
Route::get('/best-seller', [ProductController::class, 'bestSeller'])->name('user.bestseller');
Route::get('/new-book', [ProductController::class, 'newBook'])->name('user.newbook');
Route::get('/van-hoc', [ProductController::class, 'vanHoc'])->name('user.vanhoc');
Route::get('/truyen-tranh', [ProductController::class, 'truyenTranh'])->name('user.truyentranh');
Route::get('/getBestSeller/{soLuong}', [ProductController::class, 'getBestSeller'])->name('user.getBestSeller');

Route::get('/laySachTheoMaLoai/{id}', [ProductController::class, 'laySachTheoMaLoai'])->name('user.laySachTheoLoai');








//Phúc
Route::prefix('profile')->middleware([CustomAuth::class, CheckRole::class . ':3'])->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/doimatkhau', [ProfileController::class, 'DoiMatKhau'])->name('profile.doimatkhau');
    Route::post('/updatePass', [ProfileController::class, 'updatePass'])->name('profile.updatePass');
    Route::get('/dsdonhang', [ProfileController::class, 'dsDonHang'])->name('profile.dsdonhang');
    Route::get('/dsdonhang/chitiet/{id}', [ProfileController::class, 'chiTietDonHang'])->name('profile.dsdonhang.chitiet');
    Route::get('/dsdonhang/huydonhang/{id}', [ProfileController::class, 'huyDonHang'])->name('profile.dsdonhang.huy');
    Route::post('/dsdonhang/huydonhang/luu', [ProfileController::class, 'luuHuyDonHang'])->name('profile.dsdonhang.huy.luu');
    Route::get('/dsdonhang/chitiethuydon/{id}', [ProfileController::class, 'chiTietHuyDon'])->name('profile.dsdonhang.chitiethuydon');
    Route::get('/sachyeuthich', [ProfileController::class, 'dsSachYeuThich'])->name('profile.sachyeuthich');
    Route::get('/danhgiasach/{id}', [ProfileController::class, 'danhGiaSach'])->name('profile.danhgiasach');
    Route::post('/danhgiasach/{id}', [ProfileController::class, 'luuDanhGia'])->name('profile.luudanhgia');
    Route::get('/danhsachdanhgia', [ProfileController::class, 'danhSachDanhGia'])->name('profile.dsdanhgia');
    Route::delete('/sachyeuthich/xoa', [ProfileController::class, 'xoaSachYeuThich'])->name('profile.sachyeuthich.xoa');
    Route::post('/sachyeuthich/addToCart', [ProfileController::class, 'addToCart'])->name('profile.sachyeuthich.addToCart');
    Route::post('/sachyeuthich/addAllToCart', [ProfileController::class, 'addAllToCart'])->name('profile.sachyeuthich.addAll');
    Route::delete('/danhsachdanhgia/xoa/{id}', [ProfileController::class, 'xoaDanhGia'])->name('profile.dsdanhgia.xoa');
});

Route::prefix('admin')->name('admin.')->middleware([CustomAuth::class, CheckRole::class . ':1,2'])->group(function () {
    Route::get('/trang-chu', function () {
        return view('Admin.layout');
    })->name('layout');
    Route::get('/danhgia', [AdminDanhGiaController::class, 'index'])->name('danhgia');
    Route::delete('/danhgia/{matk}/{masach}', [AdminDanhGiaController::class, 'destroy'])->name('danhgia.xoa');
    Route::get('/danhgia/search', [AdminDanhGiaController::class, 'search']);
    Route::get('/danhgia/filter', [AdminDanhGiaController::class, 'filter'])->name('danhgia.search');
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::get('/profile/doimatkhau', [AdminProfileController::class, 'DoiMatKhau'])->name('profile.doimatkhau');
    Route::post('/profile/updatePass', [AdminProfileController::class, 'updatePass'])->name('profile.updatePass');
});


Route::delete('/admin/danhsachsach/{id}', [AdminSachController::class, 'destroy']);
Route::post('/admin/danhsachsach/{id}', [AdminSachController::class, 'undo']);


Route::get('/admin/danhsachsach', [AdminSachController::class, 'index'])->name('admin.sach');
Route::get('/admin/danhsachsach/edit/{id}', [AdminSachController::class, 'edit'])->name('admin.sach.edit');
Route::put('/admin/danhsachsach/update/{book}', [AdminSachController::class, 'update'])->name('admin.sach.update');
Route::get('/admin/danhsachsach/detail', [AdminSachController::class, 'detail'])->name('admin.sach.detail');
Route::get('/admin/danhsachsach/insert', [AdminSachController::class, 'insert'])->name('admin.sach.insert');
Route::post('admin/sach', [AdminSachController::class, 'store'])->name('admin.sach.store');
Route::post('/logout', function () {
    Session::forget('user'); // Xóa session người dùng
    return redirect('/login');
})->name('logout');






// Route hiển thị form liên hệ
Route::get('/lien-he', [ContactUserController::class, 'showContactForm'])->name('contact.form');

// Route xử lý form liên hệ
Route::post('/lien-he', [ContactUserController::class, 'submitContactForm'])->name('contact.submit');




// Đức Duy
/*Route::get('admin/suppliers', function () {
    return view('admin.suppliers.index');
})->name('admin.suppliers.index');
*/






Route::middleware([CustomAuth::class, CheckRole::class . ':1'])->group(
    function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/main-dashboard', [AdminDashboardController::class, 'showMainDashboard'])->name('mainDashboard');
            Route::get('/statistics', [AdminStatisticsController::class, 'statistics'])->name('statistics');
            Route::get('/statistics/chart-data/{year}/{month}', [AdminStatisticsController::class, 'getBestSellerChartData'])->name('statistics.chartData');
            Route::get('/statistics/years-and-months', [AdminStatisticsController::class, 'getAvailableYearsAndMonths'])->name('statistics.yearsMonths');
            Route::patch('/website/update-info', [AdminDashboardController::class, 'editInfomationOfWebsite'])->name('website.updateInfo');
            // Hiển thị danh sách vouchers
            Route::get('/vouchers', [AdminVoucherController::class, 'index'])->name('vouchers.index');
            // Hiển thị form tạo voucher mới
            Route::get('/vouchers/create', [AdminVoucherController::class, 'create'])->name('vouchers.create');
            // Lưu voucher mới
            Route::post('/vouchers', [AdminVoucherController::class, 'store'])->name('vouchers.store');
            //Hiển thị form sửa voucher
            Route::get('/vouchers/{MaVoucher}/edit', [AdminVoucherController::class, 'edit'])->name('vouchers.edit');
            Route::patch('/vouchers/{MaVoucher}', [AdminVoucherController::class, 'update'])->name('vouchers.update');
            // Toggle trạng thái voucher
            Route::patch('/vouchers/{MaVoucher}/toggle-status', [AdminVoucherController::class, 'toggleStatus'])->name('vouchers.toggleStatus');
        });
    }
);

Route::prefix('api')->middleware('api')->group(function () {
    Route::get('/sach', [TimSachApiController::class, 'index'])->name('api.sach.index');
    Route::get('/revenue-by-month', [ChartController::class, 'getRevenueByMonth']);
    Route::get('/orders-by-month', [ChartController::class, 'getOrderByMonth']);
});

Route::get('user/tim-sach', [TimSachController::class, 'index'])->name('user.timsach');


Route::get('/timSachTheoTen/{name?}', [ProductController::class, 'timSachTheoTen'])->name('user.product.timSach');


Route::get('/admin/category/create/{parent_id?}', [AdminCategoryController::class, 'create'])->name('admin.category.create');

Route::post('/admin/category/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');


Route::get('/top3-loai-sach', [AboutController::class, 'top3LoaiSach']);

Route::get('/newest-books', [AboutController::class, 'getNewestBooks']);

Route::get('about', [AboutController::class, 'index'])->name('about');



































//Minh Tân
Route::post('/login', [LoginUserController::class, 'login'])->name('login');
//done


// Route hiển thị form quên mật khẩu (GET)
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgotpass.form');
//done
// Route xử lý thay đổi mật khẩu (POST)
Route::post('/forgot-password', [ForgotPasswordController::class, 'resetPassword'])->name('forgotpass');
//done
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
//done
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
//done


// Route hiển thị form quên mật khẩu (GET)
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgotpass.form');
//done
// Route xử lý thay đổi mật khẩu (POST)
Route::post('/forgot-password', [ForgotPasswordController::class, 'resetPassword'])->name('forgotpass');
//done
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');

Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/san-pham/{id}', [ChiTietSanPhamController::class, 'show'])->name('product.detail');
//Route::get('/san-pham/{id}', [ChiTietSanPhamController::class, 'show'])->name('san-pham');




//end Minh Tân
