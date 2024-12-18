<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
                'MaRole' => 1,
                'TenRole' => 'Admin',
                'TrangThai' => 1, // 1: hoạt động
            ],
            [
                'MaRole' => 2,
                'TenRole' => 'User',
                'TrangThai' => 1, // 1: hoạt động
            ],
            [
                'MaRole' => 3,
                'TenRole' => 'Guest',
                'TrangThai' => 0, // 0: tạm ngưng
            ],
        ]);
    }
}
