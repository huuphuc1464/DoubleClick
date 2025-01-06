<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSachController extends Controller
{
    public function index()
    {
        return view('Admin.Sach.index');
    }
}
