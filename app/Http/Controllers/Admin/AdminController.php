<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\MainApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $MainApiController=new MainApiController();
        $requestArray=$MainApiController->makeRequestArray([], 'getClientData');
        $response=$MainApiController->sendRequestToGds($requestArray);
        $clientData=$response->json();
        return view('admin.index', compact('clientData'));
    }

    public function getStateCities(Request $request): \Illuminate\Http\JsonResponse
    {
        $MainApiController=new MainApiController();
        $requestArray=$MainApiController->makeRequestArray([
            'state_id'=>$request->input('state_id')
        ], 'getStateCities');
        $response=$MainApiController->sendRequestToGds($requestArray);
        $clientData=$response->json();
        return $MainApiController->customJsonResponse($clientData, 'success',200);
    }

}
