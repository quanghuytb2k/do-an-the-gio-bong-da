<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if(!$user || $user->status != 1){
            auth()->logout();
            return redirect('/login')->with('jsAlert','Tài khoản không chính xác hoặc không còn khả dụng');
        }

        return $next($request);
    }
}
