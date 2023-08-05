<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
        public function handle($request, Closure $next, ...$roles)
    {
        // Kiểm tra nếu người dùng không đăng nhập, redirect hoặc xử lý lỗi
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Lấy vai trò của người dùng từ mối quan hệ đã định nghĩa trong model User
        $userRoles = auth()->user()->role->pluck('name')->toArray();

        // Kiểm tra xem người dùng có vai trò nào trong danh sách các vai trò được yêu cầu không
        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        // Nếu không có vai trò nào trong danh sách, redirect hoặc xử lý lỗi
        return redirect('/customer/home');
    }
}
