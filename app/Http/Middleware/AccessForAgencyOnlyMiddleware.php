<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AlertController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class AccessForAgencyOnlyMiddleware
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
        if(Auth::user()->userType === 'agency'){
            return $next($request);
        }
        $AlertControler=new AlertController();
        $AlertControler->noAccessMessage();
        return redirect()->back();


    }
}
