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


            // Lấy danh mục blog
            $danhMucBlog = DB::table('danhmucblog')->get();

            //nhat
            $loaiSach = DB::table('loaisach')->where('TrangThai','=',1)->get();

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

                // Lấy số lượng yêu thích từ bảng dsyeuthich
                $MaTK = $user['MaTK'];
                $wishlistCount = DB::table('dsyeuthich')->where('MaTK', $MaTK)->count();

                //nhat
                // $personal = Session::get('user')['MaTK'];
                // $cartCount = DB::table('giohang')
                //     ->where('giohang.MaTK', '=', $user['MaTK'])
                //     ->groupBy('MaTK')
                //     ->select(DB::raw('SUM(SLMua) as total_SLMua'))->get();
                $cartCount = DB::table('giohang')
                    ->where('giohang.MaTK', '=', $user['MaTK'])
                    ->count('MaSach');

                $totalCart = DB::table('giohang')
                    ->join('sach', 'sach.MaSach', '=', 'giohang.MaSach')
                    ->where('giohang.MaTK', '=', $user['MaTK'])
                    ->groupBy('giohang.MaTK')
                    ->select(DB::raw('SUM(giohang.SLMua * sach.GiaBan) as total_price'))->get();;
                if ($totalCart->isNotEmpty()) {
                    $total = (int) $totalCart->first()->total_price;
                } else {
                    $total = 0;  // Nếu không có dữ liệu, gán giá trị mặc định là 0
                }

                //nhat

                // Truyền cả thông tin tài khoản và website tới view
                $view->with([
                    'account' => $account,
                    'website' => $website,

                    'danhMucBlog' => $danhMucBlog,

                    'totalCart' => $total,
                    'cartCount' => $cartCount,
                    'loaiSach' => $loaiSach,



                ]);
            } else {
                // Chỉ truyền website nếu người dùng chưa đăng nhập
                $view->with([
                    'website' => $website,

                    'danhMucBlog' => $danhMucBlog,
                    'loaiSach' => $loaiSach,


                    'totalCart' => 0,
                    'cartCount' => 0


                ]);
            }
        });
    }
}
