<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit()
    {
        return view('profile.edit');
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'family' => 'required',
            'mobile' => 'required',
            'nationalCode' => 'required',
            'telephone' => 'nullable',
            'gender' => 'required',
            'birthday' => 'nullable',
            'address' => 'nullable',
//            'correctPassword' => 'nullable|string|min:8',
            'password' => 'nullable|confirmed|string|min:8'
        ]);

        $UserApiController=new UserApiController();
        if($request->input('password') !== null){

//            if($this->isAuthPasswordCorrect($UserApiController, $request->input('correctPassword'))){
                $newPassword=$UserApiController->getGdsHashPassword($request->input('password'));
//            }else{
//                return 'wrong pass';
//            }
        }


        $requireData=[
            'userType'=>Auth::user()->userType,
            'client_id'=>Auth::user()->client_id,
            'member_id'=>Auth::user()->member_id,
            'email'=>Auth::user()->email,
            'register_date'=>Auth::user()->register_date,
            'password'=>($newPassword ?? Auth::user()->password),
        ];
        $requireData=array_merge($request->all(),$requireData);



        $result=$UserApiController->userUpdateOrCreate($requireData,$request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param UserApiController $UserApiController
     * @param $password
     * @return bool
     */
    public function isAuthPasswordCorrect(UserApiController $UserApiController,$password): bool
    {
        return $UserApiController->getGdsHashPassword($password)==Auth::user()->password;
    }
}
