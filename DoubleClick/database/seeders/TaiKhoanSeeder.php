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
                'MaTK' => 1, // Admin
                'TenTK' => 'Ngô Võ Đức Duy',
                'GioiTinh' => 'Nam',
                'NgaySinh' => '2004-12-24',
                'Email' => 'duynvdd2424@gmail.com',
                'SDT' => '0378386495',
                'DiaChi' => 'Quang Ngai',
                'Image' => 'default_admin.png',
                'Username' => 'duy_Admin',
                'Password' => Hash::make('password123'),
                'MaRole' => 1,
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 2, // Admin
                'TenTK' => 'Nguyen Van A',
                'GioiTinh' => 'Nam',
                'NgaySinh' => '1990-01-01',
                'Email' => 'admin@example.com',
                'SDT' => '0123456789',
                'DiaChi' => 'Ha Noi',
                'Image' => '2.jpg',
                'Username' => 'admin',
                'Password' => Hash::make('password123'),
                'MaRole' => 1,
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 3, // Staff
                'TenTK' => 'Tran Thi B',
                'GioiTinh' => 'Nu',
                'NgaySinh' => '1992-05-10',
                'Email' => 'user@example.com',
                'SDT' => '0987654321',
                'DiaChi' => 'Ho Chi Minh',
                'Image' => 'default_user.png',
                'Username' => 'user',
                'Password' => Hash::make('password123'),
                'MaRole' => 2,
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 4, // Guest
                'TenTK' => 'Le Van C',
                'GioiTinh' => 'Nam',
                'NgaySinh' => '1995-08-15',
                'Email' => 'guest@example.com',
                'SDT' => '0345678901',
                'DiaChi' => 'Da Nang',
                'Image' => 'default_guest.png',
                'Username' => 'guest',
                'Password' => Hash::make('password123'),
                'MaRole' => 3,
                'TrangThai' => 1,
            ],
        ]);
    }
}
