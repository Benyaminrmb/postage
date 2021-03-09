<?php


use App\Http\Controllers\Api\ApiTokenController as ApiTokenControllerAlias;
use Carbon\Carbon;

if(!function_exists('generateToken')){
    function generateToken(): array
    {
        $token=new ApiTokenControllerAlias();
        return [
            'token'=>$token->generateToken(),
            'token_expired_at'=>Carbon::now()->addHours(3)->toDateTimeString()
        ];
    }
}
