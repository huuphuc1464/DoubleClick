<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoaDonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hoadon')->insert([
            [
                'MaHD' => 1,
                'MaTK' => 1,
                'NgayLapHD' => '2024-12-20',
                'SDT' => '0378386495',
                'DiaChi' => '123 Đường ABC, Quận 1, TP. HCM',
                'TienShip' => 20000,
                'TongTien' => 350000,
                'KhuyenMai' => 10,
                'PhuongThucThanhToan' => 'COD',
                'MaVoucher' => null,
                'TrangThai' => 1, //Đang xử lý
            ],
            [
                'MaHD' => 2,
                'MaTK' => 2,
                'NgayLapHD' => '2024-12-21',
                'SDT' => '0123456789',
                'DiaChi' => '456 Đường DEF, Quận 5, TP. HCM',
                'TienShip' => 30000,
                'TongTien' => 500000,
                'KhuyenMai' => 20,
                'PhuongThucThanhToan' => 'Banking',
                'MaVoucher' => 1,
                'TrangThai' => 0, //Chờ thanh toán
            ],
            [
                'MaHD' => 3,
                'MaTK' => 2,
                'NgayLapHD' => '2024-12-22',
                'SDT' => '0909123456',
                'DiaChi' => '789 Đường GHI, Quận 3, TP. HCM',
                'TienShip' => 25000,
                'TongTien' => 450000,
                'KhuyenMai' => 15,
                'PhuongThucThanhToan' => 'COD',
                'MaVoucher' => null,
                'TrangThai' => 4,
            ],
            [
                'MaHD' => 4,
                'MaTK' => 3,
                'NgayLapHD' => '2024-12-23',
                'SDT' => '0912123456',
                'DiaChi' => '101 Đường JKL, Quận 7, TP. HCM',
                'TienShip' => 20000,
                'TongTien' => 350000,
                'KhuyenMai' => 10,
                'PhuongThucThanhToan' => 'Banking',
                'MaVoucher' => 2,
                'TrangThai' => 0, // Chờ thanh toán
            ],
            [
                'MaHD' => 5,
                'MaTK' => 4,
                'NgayLapHD' => '2024-12-24',
                'SDT' => '0921123456',
                'DiaChi' => '123 Đường MNO, Quận 4, TP. HCM',
                'TienShip' => 15000,
                'TongTien' => 500000,
                'KhuyenMai' => 5,
                'PhuongThucThanhToan' => 'COD',
                'MaVoucher' => null,
                'TrangThai' => 1, // Đang xử lý
            ],
            [
                'MaHD' => 6,
                'MaTK' => 2,
                'NgayLapHD' => '2024-12-25',
                'SDT' => '0932123456',
                'DiaChi' => '456 Đường PQR, Quận 10, TP. HCM',
                'TienShip' => 30000,
                'TongTien' => 600000,
                'KhuyenMai' => 20,
                'PhuongThucThanhToan' => 'Banking',
                'MaVoucher' => 1,
                'TrangThai' => 1, // Đang xử lý
            ],
            [
                'MaHD' => 7,
                'MaTK' => 2,
                'NgayLapHD' => '2024-12-26',
                'SDT' => '0943123456',
                'DiaChi' => '789 Đường STU, Quận 9, TP. HCM',
                'TienShip' => 20000,
                'TongTien' => 700000,
                'KhuyenMai' => 25,
                'PhuongThucThanhToan' => 'COD',
                'MaVoucher' => 2,
                'TrangThai' => 2, // Đang vận chuyển
            ],
            [
                'MaHD' => 8,
                'MaTK' => 2,
                'NgayLapHD' => '2024-12-27',
                'SDT' => '0954123456',
                'DiaChi' => '101 Đường VWX, Quận 2, TP. HCM',
                'TienShip' => 10000,
                'TongTien' => 800000,
                'KhuyenMai' => 30,
                'PhuongThucThanhToan' => 'Banking',
                'MaVoucher' => null,
                'TrangThai' => 4, 
            ],
            [
                'MaHD' => 9,
                'MaTK' => 5,
                'NgayLapHD' => '2024-12-28',
                'SDT' => '0965123456',
                'DiaChi' => '202 Đường YZ, Quận 8, TP. HCM',
                'TienShip' => 20000,
                'TongTien' => 300000,
                'KhuyenMai' => 10,
                'PhuongThucThanhToan' => 'COD',
                'MaVoucher' => null,
                'TrangThai' => 3, // Đã giao
            ],
            [
                'MaHD' => 10,
                'MaTK' => 4,
                'NgayLapHD' => '2024-12-29',
                'SDT' => '0976123456',
                'DiaChi' => '303 Đường ABC, Quận 6, TP. HCM',
                'TienShip' => 50000,
                'TongTien' => 900000,
                'KhuyenMai' => 40,
                'PhuongThucThanhToan' => 'Banking',
                'MaVoucher' => 1,
                'TrangThai' => 3, // Đã giao
            ],
            [
                'MaHD' => 11,
                'MaTK' => 2,
                'NgayLapHD' => '2024-12-30',
                'SDT' => '0987123456',
                'DiaChi' => '404 Đường DEF, Quận 12, TP. HCM',
                'TienShip' => 15000,
                'TongTien' => 200000,
                'KhuyenMai' => 5,
                'PhuongThucThanhToan' => 'COD',
                'MaVoucher' => null,
                'TrangThai' => 4, // Đã hủy
            ],
            [
                'MaHD' => 12,
                'MaTK' => 3,
                'NgayLapHD' => '2024-12-31',
                'SDT' => '0998123456',
                'DiaChi' => '505 Đường GHI, Quận 11, TP. HCM',
                'TienShip' => 25000,
                'TongTien' => 400000,
                'KhuyenMai' => 15,
                'PhuongThucThanhToan' => 'Banking',
                'MaVoucher' => 2,
                'TrangThai' => 4, // Đã hủy
            ],
        ]);
    }
}