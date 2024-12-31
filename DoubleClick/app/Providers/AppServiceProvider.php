<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sử dụng View Composer
        View::composer('*', function ($view) {
            // Thiết lập session nếu chưa có
            if (!session()->has('Username')) {
                session([
                    'Username' => 'admin',
                    'MaTK' => 2,
                    'MaRole' => 1
                ]);
            }

            // Truy vấn dữ liệu tài khoản
            $account = DB::table('taikhoan')
                ->join('role', 'taikhoan.MaRole', '=', 'role.MaRole')
                ->select('taikhoan.*', 'role.TenRole')
                ->where('taikhoan.Username', session('Username'))
                ->where('taikhoan.MaRole', session('MaRole'))
                ->first();

            // Chia sẻ biến $account tới toàn bộ view
            $view->with('account', $account);
        });
    }
}
