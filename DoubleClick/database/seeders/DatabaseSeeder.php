<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,            // Seed vai trò người dùng
            TaiKhoanSeeder::class,        // Seed tài khoản người dùng
            LoaiSachSeeder::class,        // Seed loại sách
            SachSeeder::class,            // Seed sách
            VoucherSeeder::class,         // Seed voucher giảm giá
            HoaDonSeeder::class,          // Seed hóa đơn
            ChiTietHoaDonSeeder::class,   // Seed chi tiết hóa đơn
        ]);
    }
}
