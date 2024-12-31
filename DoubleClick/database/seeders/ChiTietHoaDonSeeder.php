<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietHoaDonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chitiethoadon')->insert([
            [
                'MaHD' => 1,
                'MaSach' => 1,
                'DonGia' => 120000,
                'SLMua' => 2,
                'ThanhTien' => 240000,
                'GhiChu' => null, // Ghi chú để null
                'TrangThai' => 1,
            ],
            [
                'MaHD' => 1,
                'MaSach' => 2,
                'DonGia' => 110000,
                'SLMua' => 1,
                'ThanhTien' => 110000,
                'GhiChu' => null, // Ghi chú để null
                'TrangThai' => 1,
            ],
            [
                'MaHD' => 2,
                'MaSach' => 3,
                'DonGia' => 200000,
                'SLMua' => 2,
                'ThanhTien' => 400000,
                'GhiChu' => null, // Ghi chú để null
                'TrangThai' => 0,
            ],
            [
                'MaHD' => 3,
                'MaSach' => 1,
                'DonGia' => 120000,
                'SLMua' => 2,
                'ThanhTien' => 240000,
                'GhiChu' => null,
                'TrangThai' => 0, // Chờ thanh toán
            ],
            [
                'MaHD' => 3,
                'MaSach' => 3,
                'DonGia' => 180000,
                'SLMua' => 1,
                'ThanhTien' => 180000,
                'GhiChu' => null,
                'TrangThai' => 0, // Chờ thanh toán
            ],
            [
                'MaHD' => 4,
                'MaSach' => 2,
                'DonGia' => 95000,
                'SLMua' => 2,
                'ThanhTien' => 190000,
                'GhiChu' => null,
                'TrangThai' => 0, // Chờ thanh toán
            ],
            [
                'MaHD' => 4,
                'MaSach' => 4,
                'DonGia' => 140000,
                'SLMua' => 1,
                'ThanhTien' => 140000,
                'GhiChu' => null,
                'TrangThai' => 0, // Chờ thanh toán
            ],
            [
                'MaHD' => 5,
                'MaSach' => 5,
                'DonGia' => 250000,
                'SLMua' => 1,
                'ThanhTien' => 250000,
                'GhiChu' => null,
                'TrangThai' => 1, // Đang xử lý
            ],
            [
                'MaHD' => 5,
                'MaSach' => 3,
                'DonGia' => 180000,
                'SLMua' => 2,
                'ThanhTien' => 360000,
                'GhiChu' => null,
                'TrangThai' => 1, // Đang xử lý
            ],
            [
                'MaHD' => 6,
                'MaSach' => 6,
                'DonGia' => 210000,
                'SLMua' => 1,
                'ThanhTien' => 210000,
                'GhiChu' => null,
                'TrangThai' => 1, // Đang xử lý
            ],
            [
                'MaHD' => 6,
                'MaSach' => 1,
                'DonGia' => 120000,
                'SLMua' => 3,
                'ThanhTien' => 360000,
                'GhiChu' => null,
                'TrangThai' => 1, // Đang xử lý
            ],
            [
                'MaHD' => 7,
                'MaSach' => 5,
                'DonGia' => 250000,
                'SLMua' => 2,
                'ThanhTien' => 500000,
                'GhiChu' => null,
                'TrangThai' => 2, // Đang vận chuyển
            ],
            [
                'MaHD' => 7,
                'MaSach' => 4,
                'DonGia' => 140000,
                'SLMua' => 1,
                'ThanhTien' => 140000,
                'GhiChu' => null,
                'TrangThai' => 2, // Đang vận chuyển
            ],
            [
                'MaHD' => 8,
                'MaSach' => 2,
                'DonGia' => 95000,
                'SLMua' => 3,
                'ThanhTien' => 285000,
                'GhiChu' => null,
                'TrangThai' => 2, // Đang vận chuyển
            ],
            [
                'MaHD' => 8,
                'MaSach' => 6,
                'DonGia' => 210000,
                'SLMua' => 2,
                'ThanhTien' => 420000,
                'GhiChu' => null,
                'TrangThai' => 2, // Đang vận chuyển
            ],
            [
                'MaHD' => 9,
                'MaSach' => 1,
                'DonGia' => 120000,
                'SLMua' => 1,
                'ThanhTien' => 120000,
                'GhiChu' => null,
                'TrangThai' => 3, // Đã giao
            ],
            [
                'MaHD' => 9,
                'MaSach' => 3,
                'DonGia' => 180000,
                'SLMua' => 2,
                'ThanhTien' => 360000,
                'GhiChu' => null,
                'TrangThai' => 3, // Đã giao
            ],
            [
                'MaHD' => 10,
                'MaSach' => 5,
                'DonGia' => 250000,
                'SLMua' => 1,
                'ThanhTien' => 250000,
                'GhiChu' => null,
                'TrangThai' => 3, // Đã giao
            ],
            [
                'MaHD' => 10,
                'MaSach' => 4,
                'DonGia' => 140000,
                'SLMua' => 2,
                'ThanhTien' => 280000,
                'GhiChu' => null,
                'TrangThai' => 3, // Đã giao
            ],
            [
                'MaHD' => 11,
                'MaSach' => 2,
                'DonGia' => 95000,
                'SLMua' => 2,
                'ThanhTien' => 190000,
                'GhiChu' => 'Hết hàng, đã hủy.',
                'TrangThai' => 4, // Đã hủy
            ],
            [
                'MaHD' => 11,
                'MaSach' => 6,
                'DonGia' => 210000,
                'SLMua' => 1,
                'ThanhTien' => 210000,
                'GhiChu' => 'Hết hàng, đã hủy.',
                'TrangThai' => 4, // Đã hủy
            ],
            [
                'MaHD' => 12,
                'MaSach' => 3,
                'DonGia' => 180000,
                'SLMua' => 1,
                'ThanhTien' => 180000,
                'GhiChu' => 'Hết hàng, đã hủy.',
                'TrangThai' => 4, // Đã hủy
            ],
            [
                'MaHD' => 12,
                'MaSach' => 1,
                'DonGia' => 120000,
                'SLMua' => 2,
                'ThanhTien' => 240000,
                'GhiChu' => 'Hết hàng, đã hủy.',
                'TrangThai' => 4, // Đã hủy
            ],
        ]);
    }
}
