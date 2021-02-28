<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\MainApiController;
use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function getList()
    {
        $shipments=Shipment::all();
        return view('admin.shipment.list',compact('shipments'));
    }

    public static function deliveryTypeFaName($val)
    {
        if($val === 'byCompany'){
            return 'توسط شرکت';
        }
        if($val === 'byUser'){
            return 'توسط شخص';
        }
    }

    public function get(Request $request)
    {
        $MainApiController=new MainApiController();
        $shipment=Shipment::with('user')->find($request->input('id'));
        return $MainApiController->customJsonResponse($shipment, 'success',200);
    }
}
