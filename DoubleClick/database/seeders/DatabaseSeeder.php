<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,     // Seeder cho bảng role
            TaiKhoanSeeder::class, // Seeder cho bảng taikhoan
        ]);
    }
}
