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
        // User::factory(10)->create();
        $this->call(LienHeSeeder::class);

        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

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
