<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainApiController extends Controller
{
    public function loginUser(Request $request)
    {
        $main=new UserApiController();
        return $main->login($request)->original;
    }

    public function registerUser(Request $request)
    {
        //        return 'awd';
        //        if($this->validator($request)){
        $main=new UserApiController();

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
            'name'=>[
                'required',
                'string',
                'max:255'
            ],
            'family'=>[
                'required',
                'string',
                'max:255'
            ],
            'email'=>[
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password'=>[
                'required',
                'string',
                'min:11'
            ],
        ]);
    }

    /**
     * @param array $finalRequestData
     * @return Response
     */
    public function sendRequestToGds(array $finalRequestData): Response
    {
        return Http::post('https://s360online.iran-tech.com/gds/infoGds', $finalRequestData);
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
            'clientToken'=>env('CLIENT_TOKEN'),
        ];
        return array_merge($requestData, $request);
    }

    public function checkIsJson($str): bool
    {
        if(is_object(json_decode($str, true, 512, JSON_THROW_ON_ERROR))){
            return true;
        }
        return false;
    }

    public function jsonToArray($json)
    {
        if($this->checkIsJson($json)){
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        }
        return $json;
    }

    public function customJsonMessage($title,$message,$data=null)
    {
        return[
            'title'=>$title,
            'message'=>$message,
            'data'=>$data
        ];
    }
    public function customJsonResponse($data, $status, $code=ResponseStatus::HTTP_OK, $toArray=false): \Illuminate\Http\JsonResponse
    {

        return \response()->json([
            'response'=>[
                'status'=>$status,
                'title'=>$data['title'],
                'message'=>$data['message'],
                'data'=>($toArray ? $this->jsonToArray($data['data']) : $data['data'])
            ]
        ], $code);
    }

    public function statesAndCities()
    {
        $requestArray=$this->makeRequestArray([], 'getIranCities');
        $response=$this->sendRequestToGds($requestArray);
        $responseCities=$this->fixJsonEncode($response);


        foreach($responseCities as $city){
            if($city['parent']==='0'){
                $states[]=$city;
            }else{
                $cities[]=$city;
            }
        }
        return [
            'states'=>$states,
            'cities'=>$cities
        ];
    }

    public function fixJsonEncode(\Illuminate\Http\Client\Response $response)
    {
        $enc=mb_detect_encoding($response->body());

        if($enc=='UTF-8'){
            $response=preg_replace('/[^(\x20-\x7F)]*/', '', $response);
        }

        $responseData=(json_decode($response, true));
        return $responseData;
    }
}
