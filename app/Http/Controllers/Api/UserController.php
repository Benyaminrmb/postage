<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $MainController=new MainController();
        $user=$this->getFirstUserByUserNamePassword($request);

        if(!$user['founded']){

            $finalRequestData=$MainController->makeRequestArray($request->all(), 'getUser');

            $response=$MainController->sendRequestToGds($finalRequestData);

            $responseData=$response->json();


            if(!empty($responseData)){
                $user=$this->createUser($responseData);
                if($user!==null){
                    $result=[
                        'status'=>'success',
                        'action'=>'loginOnly',
                        'user'=>$user
                    ];
                }else{
                    $result=[
                        'status'=>'error4'
                    ];
                }
            }else{
                $result=[
                    'status'=>'error3'
                ];
            }


        }else{
            $result=[
                'status'=>'success',
                'user'=>$user['user']
            ];
        }


        return response()->json($result, 200);
    }

    public function getFirstUserByUserNamePassword(Request $request)
    {
        $user=User::where('email', $request['email'])->where('password', hash('sha512', 'sd45sv#FEgfe@%&*4RG656Sssd5'.$request['password'].'4sF7s85fEW'))->first();
        if(empty($user)){
            return ['founded'=>false];
        }
        return [
            'founded'=>true,
            'user'=>$user
        ];
    }

    /**
     * @param $register_date
     * @return User
     */
    public function createUser($register_date): User
    {
        $newUser=new User();
        $newUser['userType']=$register_date['userType'];
        $newUser['client_id']=$register_date['client_id'];
        $newUser['member_id']=$register_date['member_id'];
        $newUser['name']=$register_date['name'];
        $newUser['family']=$register_date['family'];
        $newUser['mobile']=$register_date['mobile'];
        $newUser['telephone']=$register_date['telephone'];
        $newUser['email']=$register_date['email'];
        $newUser['password']=$register_date['password'];
        $newUser['gender']=$register_date['gender'];
        $newUser['birthday']=$register_date['birthday'];
        $newUser['address']=$register_date['address'];
        $newUser['register_date']=$register_date['register_date'];
        $newUser->save();
        return $newUser;
    }

    public function register(Request $request)
    {


        $MainController=new MainController();
        $finalRequestData=$MainController->makeRequestArray($request->all(), 'registerUser');
        $response=$MainController->sendRequestToGds($finalRequestData);

        $responseData=$response->json();


        if(!empty($responseData)){
            $user=$this->createUser($responseData['user']);
            if($user!==null){
                $result=[
                    'status'=>'success',
                    'user'=>$user
                ];
            }else{
                $result=[
                    'status'=>'error1'
                ];
            }
        }else{
            $result=[
                'status'=>'error2'
            ];
        }


        return response()->json($result, 200);
    }
}
