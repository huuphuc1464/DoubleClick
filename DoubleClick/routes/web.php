<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.layout');
});

Route::get('/user', function () {
    return view('layout');
});