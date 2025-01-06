<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KitLoong\MigrationsGenerator\Schema\Models\Index;

class AdminDanhGiaController extends Controller
{
    public function index(){
        return view('Admin.DanhGia.index');
    }
}