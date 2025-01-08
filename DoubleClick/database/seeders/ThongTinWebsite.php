<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThongTinWebsite extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('thongtinwebsite')->insert([
            'ID' => 1,
            'DiaChi' => '65 Huỳnh Thúc Kháng , P. Bến Nghé, Q. 1, TP.HCM',
            'Website' => 'https://www.doubleclick.com',
            'SDT' => '0123456789',
            'Email' => 'trangweb.doubleclick@gmail.com',
            'Logo' => 'logoname.png',
            'Facebook' => 'https://www.facebook.com/doubleclick',
        ]);
    }
}