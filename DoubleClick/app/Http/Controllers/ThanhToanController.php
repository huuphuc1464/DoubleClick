<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThanhToanController extends Controller
{
    public function index(){
        $title = "Thanh toán | Double Click";
        return view('User.thanhToan', compact('title'));
    }
}
