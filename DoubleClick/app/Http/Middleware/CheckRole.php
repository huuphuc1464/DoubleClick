<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Lấy thông tin user từ session
        $user = Session::get('user');

        // Kiểm tra quyền
        if (!$user || $user['MaRole'] != $role) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        return $next($request);
    }
}
