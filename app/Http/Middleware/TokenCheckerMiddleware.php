<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenCheckerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->token_expired_at!==null){
                $tokenExpiredAt=Carbon::parse(Auth::user()->token_expired_at);
                if($tokenExpiredAt->gt(Carbon::now())){
                    return $next($request);
                }
            }
            Auth::logout();
            return redirect('login');
        }
        return $next($request);
    }
}
