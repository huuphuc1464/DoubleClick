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
        // Sử dụng View Composer
        View::composer('*', function ($view) {
            $user = Session::get('user');
            if (!$user) {
                return redirect()->route('login')->withErrors('Vui lòng đăng nhập để tiếp tục.');
            }
            $Username = $user['Username'];
            $MaRole = $user['MaRole'];

            $account = DB::table('taikhoan')
                ->join('role', 'taikhoan.MaRole', '=', 'role.MaRole')
                ->select('taikhoan.*', 'role.TenRole')
                ->where('taikhoan.Username', $Username)
                ->where('taikhoan.MaRole', $MaRole)
                ->first();
            $view->with('account', $account);
        });
    }
}
