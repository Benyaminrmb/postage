<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\MainApiController;
use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminShipmentController extends Controller
{
    public function getList()
    {
        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);
        $shipments=Shipment::whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
            ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)->paginate(15);

        return view('admin.shipment.list', compact('shipments'));
    }

    public static function deliveryTypeFaName($val)
    {
        if($val==='byCompany'){
            return 'توسط شرکت';
        }
        if($val==='byUser'){
            return 'توسط شخص';
        }
    }

    public function get(Request $request)
    {
        $MainApiController=new MainApiController();
        $shipment=Shipment::with('user')->find($request->input('id'));
        return $MainApiController->customJsonResponse($shipment, 'success', 200);
    }


    public function agencyShipmentsCount()
    {
        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);
        return Shipment::whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
            ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)
            ->where("created_at", ">", Carbon::now()->subDay())->count();
    }
}
