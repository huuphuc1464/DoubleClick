<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Đảm bảo import User model

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LienHeSeeder::class,
            RoleSeeder::class,            // Seed vai trò người dùng
            TaiKhoanSeeder::class,        // Seed tài khoản người dùng
            LoaiSachSeeder::class,        // Seed loại sách
            SachSeeder::class,            // Seed sách
            VoucherSeeder::class,         // Seed voucher giảm giá
            HoaDonSeeder::class,          // Seed hóa đơn
            ChiTietHoaDonSeeder::class,   // Seed chi tiết hóa đơn

            CartSeeder::class,            // Thêm giỏ hàng
            DSYeuThichSeeder::class,      // Seed DS Yêu thích
            DanhGiaSeeder::class,         // Seed Đánh giá
            LichSuHuyHoaDonSeeder::class,  //Lịch sử hủy hóa đơn
            ThongTinWebsite::class,
            BannerSeeder::class,       //banner sản phẩm
            BaiVietSeeder::class,
            DanhMucBlogSeeder::class
        ]);
    }
}
