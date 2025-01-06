<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSachController extends Controller
{
    public function index()
    {
        return view('Admin.Sach.index');
    }
    public function update()
    {
        return view('Admin.Sach.update');
    }
    public function detail()
    {
        return view('Admin.Sach.detail');
    }
}
