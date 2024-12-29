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
                'TenTK' => 'Lê Văn C',
                'GioiTinh' => 'Nam',
                'NgaySinh' => '1995-08-15',
                'Email' => 'guest@example.com',
                'SDT' => '0345678901',
                'DiaChi' => 'Đà Nẵng',
                'Image' => 'default_guest.png',
                'Username' => 'guest',
                'Password' => Hash::make('password123'),
                'MaRole' => 3,
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 5, // guest
                'TenTK' => 'Phạm Thị D',
                'GioiTinh' => 'Nữ',
                'NgaySinh' => '1988-03-12',
                'Email' => 'pham.d@example.com',
                'SDT' => '0567890123',
                'DiaChi' => 'Cần Thơ',
                'Image' => 'default_admin.png',
                'Username' => 'pham_admin',
                'Password' => Hash::make('guest123'),
                'MaRole' => 3,
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 6, // Staff
                'TenTK' => 'Nguyễn Văn E',
                'GioiTinh' => 'Nam',
                'NgaySinh' => '1998-09-21',
                'Email' => 'nguyen.e@example.com',
                'SDT' => '0654321098',
                'DiaChi' => 'Hải Phòng',
                'Image' => 'default_user.png',
                'Username' => 'nguyen_staff',
                'Password' => Hash::make('staff123'),
                'MaRole' => 2,
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 7, // Guest
                'TenTK' => 'Trần Văn F',
                'GioiTinh' => 'Nam',
                'NgaySinh' => '2000-11-30',
                'Email' => 'tran.f@example.com',
                'SDT' => '0765432198',
                'DiaChi' => 'Huế',
                'Image' => 'default_guest.png',
                'Username' => 'tran_guest',
                'Password' => Hash::make('guest123'),
                'MaRole' => 3,
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 8, // Staff
                'TenTK' => 'Vũ Thị G',
                'GioiTinh' => 'Nữ',
                'NgaySinh' => '1996-04-05',
                'Email' => 'vu.g@example.com',
                'SDT' => '0789012345',
                'DiaChi' => 'Vũng Tàu',
                'Image' => 'default_user.png',
                'Username' => 'vu_staff',
                'Password' => Hash::make('staffpass'),
                'MaRole' => 2,
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 9, // Guest
                'TenTK' => 'Lý Văn H',
                'GioiTinh' => 'Nam',
                'NgaySinh' => '1993-07-15',
                'Email' => 'ly.h@example.com',
                'SDT' => '0812345678',
                'DiaChi' => 'Nha Trang',
                'Image' => 'default_guest.png',
                'Username' => 'ly_guest',
                'Password' => Hash::make('guestpass'),
                'MaRole' => 3,
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 10, // guest
                'TenTK' => 'Hoàng Thị I',
                'GioiTinh' => 'Nữ',
                'NgaySinh' => '1985-02-28',
                'Email' => 'hoang.i@example.com',
                'SDT' => '0912345678',
                'DiaChi' => 'Đà Lạt',
                'Image' => 'default_guest.png',
                'Username' => 'hoang_guest',
                'Password' => Hash::make('guestpass'),
                'MaRole' => 3,
                'TrangThai' => 1,
            ],
        ]);
    }
}