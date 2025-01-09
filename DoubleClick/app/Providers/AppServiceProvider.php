<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        View::composer('*', function ($view) {
            // Lấy thông tin website (luôn luôn có)
            $website = DB::table('thongtinwebsite')->where('ID', 1)->first();

            // Lấy thông tin người dùng từ session
            $user = Session::get('user');

            // Nếu không có người dùng trong session, không cần phải redirect
            if ($user) {
                $Username = $user['Username'];
                $MaRole = $user['MaRole'];

                $account = DB::table('taikhoan')
                    ->join('role', 'taikhoan.MaRole', '=', 'role.MaRole')
                    ->select('taikhoan.*', 'role.TenRole')
                    ->where('taikhoan.Username', $Username)
                    ->where('taikhoan.MaRole', $MaRole)
                    ->first();

                // Truyền cả thông tin tài khoản và website tới view
                $view->with([
                    'account' => $account,
                    'website' => $website
                ]);
            } else {
                // Chỉ truyền website nếu người dùng chưa đăng nhập
                $view->with('website', $website);
            }
        });
    }
}
