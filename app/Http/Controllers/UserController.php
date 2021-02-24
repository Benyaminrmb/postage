<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\False_;

class UserController extends Controller
{

    public function gdsUserLogin(Request $request)
    {
        $newUser=$this->getFirstUserByUserNamePassword($request);


        $newUser=$this->gdsUserCheck($newUser, $request);

        if($newUser!==false){
            Auth::loginUsingId($newUser['id']);
        }
        return redirect('/');

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getFirstUserByUserNamePassword(Request $request)
    {
        $user=User::where('email', $request['email'])->where('password', hash('sha512', 'sd45sv#FEgfe@%&*4RG656Sssd5'.$request['password'].'4sF7s85fEW'))->first();
        if(empty($user)){
            return false;
        }
        return $user;
    }

    /**
     * @param $newUser
     * @param Request $request
     * @return mixed
     */
    public function gdsUserCheck($newUser, Request $request)
    {

        if($newUser){

            $requestData=[
                'method'=>'getUser',
            ];

            $finalRequestData=array_merge($requestData, $request->all());
            $response=Http::post('192.168.1.100/gds/infoGds', $finalRequestData);
            $responseData=$response->json();


            if(!empty($responseData)){
                $newUser=new User();
                $newUser['userType']=$responseData['userType'];
                $newUser['client_id']=$responseData['client_id'];
                $newUser['member_id']=$responseData['member_id'];
                $newUser['name']=$responseData['name'];
                $newUser['family']=$responseData['family'];
                $newUser['mobile']=$responseData['mobile'];
                $newUser['telephone']=$responseData['telephone'];
                $newUser['email']=$responseData['email'];
                $newUser['password']=$responseData['password'];
                $newUser['gender']=$responseData['gender'];
                $newUser['birthday']=$responseData['birthday'];
                $newUser['address']=$responseData['address'];
                $newUser['register_date']=$responseData['register_date'];
                $newUser->save();

            }
        }

        return $newUser;
    }
}
