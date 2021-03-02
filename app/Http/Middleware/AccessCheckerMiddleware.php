<?php

namespace App\Http\Middleware;

use App\Events\AccessForAgencyOnly;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessCheckerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        return 'awd';
        return $next($request);
    }
}
