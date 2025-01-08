<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CustomAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem user có trong session hay không
        if (!Session::has('user')) {
            return redirect()->route('login')->withErrors(['error' => 'Bạn phải đăng nhập trước!']);
        }

        return $next($request);
    }
}
