<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnhSachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
        {
            DB::table('anhsach')->insert([
        [
            'MaSach' => 1,
            'HinhAnh' => 'demen.jpg',
        ],
        [
            'MaSach' => 1,
            'HinhAnh' => 'demen2.webp',
        ],
        [
            'MaSach' => 2,
            'HinhAnh' => 'tat-den.jpg',
        ],
        [
            'MaSach' => 2,
            'HinhAnh' => 'tatden2.webp',
        ],
        [
            'MaSach' => 3,
            'HinhAnh' => 'chien-tranh-hoa-binh.png',
        ],
        [
            'MaSach' => 3,
            'HinhAnh' => 'chien-tranh-hoa-binh1.webp',
        ],
        [
            'MaSach' => 4,
            'HinhAnh' => 'nhung-nguoi-khon-kho.jpg',
        ],
        [
            'MaSach' => 4,
            'HinhAnh' => 'nhungnguoidan1.webp',
        ],
        [
            'MaSach' => 5,
            'HinhAnh' => 'thuyet-tuong-doi.jpg',
        ],
        [
            'MaSach' => 5,
            'HinhAnh' => 'thuyet-tuong-doi2.webp',
        ],
        [
            'MaSach' => 6,
            'HinhAnh' => 'nguon-goc-cac-loai.jpg',
        ],
        [
            'MaSach' => 6,
            'HinhAnh' => 'nguongoccacloai1.webp',
        ],
        [
            'MaSach' => 7,
            'HinhAnh' => 'one-piece.png',
        ],
        [
            'MaSach' => 7,
            'HinhAnh' => 'one-piece1.webp',
        ],
        [
            'MaSach' => 8,
            'HinhAnh' => 'naruto.png',
        ],
        [
            'MaSach' => 8,
            'HinhAnh' => 'naruto1.webp',
        ],
        [
            'MaSach' => 9,
            'HinhAnh' => 'conan.png',
        ],
        [
            'MaSach' => 9,
            'HinhAnh' => 'conan1.webp',
        ],
        [
            'MaSach' => 10,
            'HinhAnh' => 'con-cho-nho-mang-gio-hoa-hong.png',
        ],
        [
            'MaSach' => 10,
            'HinhAnh' => 'conchonhomanggiohoahong2.webp',
        ],
        [
            'MaSach' => 11,
            'HinhAnh' => 'nang-vuon-xua.png',
        ],
        [
            'MaSach' => 11,
            'HinhAnh' => 'nangvuonxua.jpg',
        ],
        [
            'MaSach' => 12,
            'HinhAnh' => 'giac-mo-my-duong-den-stanford.png',
        ],
        [
            'MaSach' => 12,
            'HinhAnh' => 'giacmostanford.webp',
        ],
        [
            'MaSach' => 13,
            'HinhAnh' => 'nguoi-thay.png',
        ],
        [
            'MaSach' => 13,
            'HinhAnh' => 'nguoithay.png',
        ]
    ]);

        }
}
