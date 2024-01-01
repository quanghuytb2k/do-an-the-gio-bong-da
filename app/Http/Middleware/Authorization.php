<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = auth()->user();
        
        if($user->role != User::USER_ADMIN_ROLE){
            return redirect()->back()->with('jsAlert','Tài khoản của bạn không có quyền sử dụng chức năng này');
        }

        return $next($request);
    }
}
