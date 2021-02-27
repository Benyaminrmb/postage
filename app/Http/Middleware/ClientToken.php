<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\MainApiController;
use Closure;
use Illuminate\Http\Request;

class ClientToken
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
        return $next($request);
        $MainApiController=new MainApiController();
        if(isset($request->client_token)){
            if($request->client_token === env('CLIENT_TOKEN')){
            return $next($request);
            }
            return $MainApiController->customJsonResponse('wrong client_token','error','403');
        }
        return $MainApiController->customJsonResponse('missing client_token','error','403');
    }
}
