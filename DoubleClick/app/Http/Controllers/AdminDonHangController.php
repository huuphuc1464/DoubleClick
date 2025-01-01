<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDonHangController extends Controller
{
    function index(){
        $viewData =[
            "title"=>"Đơn hàng",
            "subtitle"=>"Danh sách đơn hàng"
        ];
        return view('Admin.DonHang.index', $viewData);
    }
}
