<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DSYeuThichSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dsyeuthich')->insert([
            [
                'MaTK' => 2,
                'MaSach' => 1,
            ],
            [
                'MaTK' => 2,
                'MaSach' => 2,
            ],
            [
                'MaTK' => 1,
                'MaSach' => 3,
            ],
            [
                'MaTK' => 2,
                'MaSach' => 4,
            ],
            [
                'MaTK' => 3,
                'MaSach' => 5,
            ],
            [
                'MaTK' => 2,
                'MaSach' => 6,
            ],
            [
                'MaTK' => 2,
                'MaSach' => 3,
            ],
        ]);
    }
}
