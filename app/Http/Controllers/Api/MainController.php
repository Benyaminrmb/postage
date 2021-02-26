<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function loginUser(Request $request)
    {
        $main = new UserController();
        return $main->login($request)->original;
    }

    public function registerUser(Request $request)
    {
//        return 'awd';
//        if($this->validator($request)){
            $main=new UserController();

            $userLoginCheck=$main->login($request)->original;
            if($userLoginCheck['status']!=='success'){
                return $main->register($request);
            }
            return $userLoginCheck;
//        }
    }

    function validator(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:11'],
        ]);
    }

    /**
     * @param array $finalRequestData
     * @return Response
     */
    public function sendRequestToGds(array $finalRequestData): Response
    {
        return Http::post('192.168.1.100/gds/infoGds', $finalRequestData);
    }

    /**
     * @param $request
     * @param $methode
     * @return array
     */
    public function makeRequestArray($request, $methode): array
    {
        $requestData=[
            'method'=>$methode,
            'clientToken'=>'17712581db0138ffae88b2f0c68d725d2e56f9a1917abba9afd197442c4bd9e3a1dcab903ce1e7b2bb9d239a7262bd59742f9dda21d5013030d6490f4325ff7e',
        ];
        return array_merge($requestData,$request);
    }
}
