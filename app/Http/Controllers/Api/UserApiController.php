<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function login(Request $request)
    {

        $MainController=new MainApiController();
        $user=$this->getFirstUserByUserNamePassword($request);

        if(!$user['founded']){

            $finalRequestData=$MainController->makeRequestArray($request->all(), 'getUser');

            $response=$MainController->sendRequestToGds($finalRequestData);

            $responseData=$response->json();


            if(!empty($responseData)){
                $user=$this->userUpdateOrCreate($responseData,$request->all());
                if($user!==null){
                    $result=[
                        'status'=>'success',

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
                'action'=>'loginOnly',
                'user'=>$user['user']
            ];
        }


        return response()->json($result, 200);
    }

    public function getFirstUserByUserNamePassword(Request $request)
    {
        $user=User::where('email', $request['email'])->where('password', $this->getGdsHashPassword($request['password']))->first();
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

    /**
     * @param $register_date
     * @param null $requestData
     * @return User
     */
    public function userUpdateOrCreate($register_date,$requestData=null): User
    {
//        dd($requestData['nationalCode']);

        $newUser['userType']=$register_date['userType'];
        $newUser['client_id']=$register_date['client_id'];
        $newUser['member_id']=$register_date['member_id'];
        $newUser['name']=$register_date['name'];
        $newUser['family']=$register_date['family'];
        $newUser['mobile']=$register_date['mobile'];
        $newUser['nationalCode']=@$requestData['nationalCode'];
        $newUser['telephone']=$register_date['telephone'];
        $newUser['email']=$register_date['email'];
        $newUser['password']=$register_date['password'];
        $newUser['gender']=$register_date['gender'];
        $newUser['birthday']=$register_date['birthday'];
        $newUser['address']=$register_date['address'];
        $newUser['register_date']=$register_date['register_date'];

//        dd($newUser);

        $existing = User::where('email', $newUser['email'])->first();

        if ($existing) {
            $result=$existing->update($newUser);
        } else {
            // create new one
            $result=User::create($newUser);
        }


        return $existing ?? $result;
    }

    public function register(Request $request)
    {


        $MainController=new MainApiController();
        $finalRequestData=$MainController->makeRequestArray($request->all(), 'registerUser');
        $response=$MainController->sendRequestToGds($finalRequestData);

        $responseData=$response->json();



        if(!empty($responseData)){
            $user=$this->userUpdateOrCreate($responseData['user'],$request->all());
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

    /**
     * @param Request $request
     * @return string
     */
    public function getGdsHashPassword($data): string
    {
        return hash('sha512', 'sd45sv#FEgfe@%&*4RG656Sssd5'.$data.'4sF7s85fEW');
    }
}