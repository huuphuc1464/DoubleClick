<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $title = "Blog | Double Click";
        return view('User.Blog.danhsachBlog', compact('title'));
    }
}
