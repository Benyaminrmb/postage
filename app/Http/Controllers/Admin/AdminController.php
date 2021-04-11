<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\MainApiController;
use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $MainApiController=new MainApiController();
//        $requestArray=$MainApiController->makeRequestArray([], 'getClientData');
//        $response=$MainApiController->sendRequestToGds($requestArray);
//        $clientData=$response->json();

        $ShipmentController=new AdminShipmentController();

        $unComplateAgencyShipments=$ShipmentController->unComplateAgencyShipments();
        $complateAgencyShipments=$ShipmentController->complateAgencyShipments();
        $onProcessAgencyShipments=$ShipmentController->onProcessAgencyShipments();
        $onProcessAgencyShipments=$ShipmentController->onProcessAgencyShipments();
        $usersCount=User::get()->count();

        return view('admin.index',compact('unComplateAgencyShipments',
            'complateAgencyShipments',
            'usersCount',
            'onProcessAgencyShipments'));
    }

    public function getStateCities(Request $request): \Illuminate\Http\JsonResponse
    {
        $MainApiController=new MainApiController();
        $requestArray=$MainApiController->makeRequestArray([
            'state_id'=>$request->input('state_id')
        ], 'getStateCities');
        $response=$MainApiController->sendRequestToGds($requestArray);

        $clientData=$MainApiController->fixJsonEncode($response);

        $messageData=$MainApiController->customJsonMessage($clientData['title'], $clientData['message'],$clientData);
        return $MainApiController->customJsonResponse($messageData, $clientData['status'],$clientData['http']);
    }

    public function needUserAgencyInfo()
    {
        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);
        if($userAgencyInfo){
            return $userAgencyInfo;
        }
        return false;
    }



}
