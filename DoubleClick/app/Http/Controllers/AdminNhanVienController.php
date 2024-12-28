<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminNhanVienController extends Controller
{
    private function getNhanVien()
    {
        return DB::table('taikhoan')
            ->join('role', 'taikhoan.MaRole', '=', 'role.MaRole') 
            ->select(
                'taikhoan.MaTK', 
                'taikhoan.TenKH', 
                'taikhoan.Email', 
                'taikhoan.SDT', 
                'taikhoan.DiaChi', 
                'taikhoan.Image', 
                'role.TenRole' 
            )
            ->where('taikhoan.MaRole', 2) //Role Nhân viên
            ->where('taikhoan.TrangThai', 1) //Trạng thái hoạt động
            ->get();
    }

    function index(){
        $nhanVienList = $this->getNhanVien();
        $viewData = [
            "title"=>"Quản lý nhân viên",
            "subtitle"=>"Danh sách nhân viên",
            "nhanVienList"=> $nhanVienList
        ];
        return view('admin.NhanVien.index', $viewData);
    }
    function themNhanVien(){

    }
}
