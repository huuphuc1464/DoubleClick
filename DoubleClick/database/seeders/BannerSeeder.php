<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use App\Models\Sach;

use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'MaBanner' => 1,
                'Imagebanner' => 'banner1.png',
                'MaSach' => 10
            ],
            [
                'MaBanner' => 2,
                'Imagebanner' => 'banner2.png',
                'MaSach' => 11

            ],
            [
                'MaBanner' => 3,
                'Imagebanner' => 'banner3.png',
                'MaSach' => 12

            ],
            [
                'MaBanner' => 4,
                'Imagebanner' => 'banner4.png',
                'MaSach' => 13
            ],
        ]);
    }
}
