<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('taikhoan')->insert([
            [
                'MaTK' => 1,
                'TenKH' => 'Nguyen Van A',
                'GioiTinh' => 'Nam',
                'NgaySinh' => '1990-01-01',
                'Email' => 'admin@example.com',
                'SDT' => '0123456789',
                'DiaChi' => 'Ha Noi',
                'Image' => 'default_admin.png',
                'Username' => 'admin',
                'Password' => Hash::make('password123'), // Mã hóa mật khẩu
                'MaRole' => 1, // Admin
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 2,
                'TenKH' => 'Tran Thi B',
                'GioiTinh' => 'Nu',
                'NgaySinh' => '1992-05-10',
                'Email' => 'user@example.com',
                'SDT' => '0987654321',
                'DiaChi' => 'Ho Chi Minh',
                'Image' => 'default_user.png',
                'Username' => 'user',
                'Password' => Hash::make('password123'),
                'MaRole' => 2, // Staff
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 3,
                'TenKH' => 'Le Van C',
                'GioiTinh' => 'Nam',
                'NgaySinh' => '1995-08-15',
                'Email' => 'guest@example.com',
                'SDT' => '0345678901',
                'DiaChi' => 'Da Nang',
                'Image' => 'default_guest.png',
                'Username' => 'guest',
                'Password' => Hash::make('password123'),
                'MaRole' => 3, // User
                'TrangThai' => 1,
            ],
        ]);
    }
}
