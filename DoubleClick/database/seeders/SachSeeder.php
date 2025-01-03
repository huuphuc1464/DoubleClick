<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SachSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sach')->insert([
            // Văn học Việt Nam
            [
                'MaSach' => 1,
                'MaLoai' => 1,
                'TenSach' => 'Dế Mèn Phiêu Lưu Ký',
                'TenNCC' => 'Nhà xuất bản Kim Đồng',
                'Slug' => 'de-men-phieu-luu-ky',
                'TenTG' => 'Tô Hoài',
                'TenBoSach' => null,
                'NXB' => 1941,
                'ISBN' => '123456789',
                'AnhDaiDien' => 'demen.jpg',
                'MoTa' => 'Một câu chuyện phiêu lưu thú vị của chú Dế Mèn.',
                'GiaNhap' => 100000,
                'GiaBan' => 120000,
                'KhuyenMai' => 10,
                'SoLuongTon' => 50,
                'TrangThai' => 1, // Còn hàng
            ],
            [
                'MaSach' => 2,
                'MaLoai' => 1,
                'TenSach' => 'Tắt Đèn',
                'TenNCC' => 'Nhà xuất bản Kim Đồng',
                'Slug' => 'tat-den',
                'TenTG' => 'Ngô Tất Tố',
                'TenBoSach' => null,
                'NXB' => 1939,
                'ISBN' => '223456789',
                'AnhDaiDien' => 'tat-den.jpg',
                'MoTa' => 'Tác phẩm kinh điển phản ánh đời sống nông dân Việt Nam.',
                'GiaNhap' => 80000,
                'GiaBan' => 95000,
                'KhuyenMai' => 15,
                'SoLuongTon' => 0,
                'TrangThai' => 0, // Hết hàng
            ],
            // Văn học nước ngoài
            [
                'MaSach' => 3,
                'MaLoai' => 2,
                'TenSach' => 'Chiến Tranh và Hòa Bình',
                'TenNCC' => 'Nhà xuất bản Khoa học',
                'Slug' => 'chien-tranh-va-hoa-binh',
                'TenTG' => 'Lev Tolstoy',
                'TenBoSach' => null,
                'NXB' => 1869,
                'ISBN' => '323456789',
                'AnhDaiDien' => 'chien-tranh-hoa-binh.jpg',
                'MoTa' => 'Tác phẩm kinh điển về chiến tranh và hòa bình.',
                'GiaNhap' => 150000,
                'GiaBan' => 180000,
                'KhuyenMai' => 20,
                'SoLuongTon' => 30,
                'TrangThai' => 1, // Còn hàng
            ],
            [
                'MaSach' => 4,
                'MaLoai' => 2,
                'TenSach' => 'Những Người Khốn Khổ',
                'TenNCC' => 'Nhà xuất bản Khoa học',
                'Slug' => 'nhung-nguoi-khon-kho',
                'TenTG' => 'Victor Hugo',
                'TenBoSach' => null,
                'NXB' => 1862,
                'ISBN' => '423456789',
                'AnhDaiDien' => 'nhung-nguoi-khon-kho.jpg',
                'MoTa' => 'Cuốn tiểu thuyết bất hủ về cuộc đời Jean Valjean.',
                'GiaNhap' => 120000,
                'GiaBan' => 140000,
                'KhuyenMai' => 15,
                'SoLuongTon' => 0,
                'TrangThai' => 2, // Ngừng bán
            ],
            // Khoa học - Kỹ thuật
            [
                'MaSach' => 5,
                'MaLoai' => 3,
                'TenSach' => 'Thuyết Tương Đối',
                'TenNCC' => 'Nhà xuất bản Khoa học',
                'Slug' => 'thuyet-tuong-doi',
                'TenTG' => 'Albert Einstein',
                'TenBoSach' => null,
                'NXB' => 1905,
                'ISBN' => '523456789',
                'AnhDaiDien' => 'thuyet-tuong-doi.jpg',
                'MoTa' => 'Lý thuyết nổi tiếng của Albert Einstein.',
                'GiaNhap' => 200000,
                'GiaBan' => 250000,
                'KhuyenMai' => 10,
                'SoLuongTon' => 20,
                'TrangThai' => 1, // Còn hàng
            ],
            [
                'MaSach' => 6,
                'MaLoai' => 3,
                'TenSach' => 'Nguồn Gốc Các Loài',
                'TenNCC' => 'Nhà xuất bản Khoa học',
                'Slug' => 'nguon-goc-cac-loai',
                'TenTG' => 'Charles Darwin',
                'TenBoSach' => null,
                'NXB' => 1859,
                'ISBN' => '623456789',
                'AnhDaiDien' => 'nguon-goc-cac-loai.jpg',
                'MoTa' => 'Tác phẩm nền tảng về thuyết tiến hóa.',
                'GiaNhap' => 180000,
                'GiaBan' => 210000,
                'KhuyenMai' => 15,
                'SoLuongTon' => 0,
                'TrangThai' => 2, // Ngừng bán
            ],
        ]);
    }
}
