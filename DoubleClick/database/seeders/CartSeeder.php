<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('giohang')->insert([
    [
        'MaTK' => 1,
        'MaSach' => 1, // Sách 1 cho tài khoản 1
        'SLMua' => 2,
    ],
    [
        'MaTK' => 1,
        'MaSach' => 2, // Sách 2 cho tài khoản 1
        'SLMua' => 1,
    ],
]);

    }
}
