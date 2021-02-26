<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\MainController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\False_;

class UserController extends Controller
{
    public function gdsUserLogin(Request $request)
    {
        $MainApiController=new MainController();
        $response=($MainApiController->loginUser($request));
        if($response['status']==='success'){
            Auth::loginUsingId($response['user']['id']);
            return redirect('/');
        }
        return redirect('/login');
    }
    public function gdsUserRegister(Request $request)
    {

        $MainApiController=new MainController();
        $response=$MainApiController->registerUser($request)->original;


        if($response['status']==='success'){
            Auth::loginUsingId($response['user']['id']);
            return redirect('/');
        }
        return redirect('/register');
    }

}
