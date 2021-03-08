<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\MainApiController;
use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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

    public static function AccessTypeFaName($val)
    {
        if($val==='denied'){
            return 'غیر مجاز';
        }
        if($val==='granted'){
            return 'مجاز';
        }
    }

    public function get(Request $request)
    {
        $MainApiController=new MainApiController();
        $shipment=Shipment::with('user')->find($request->input('id'));
        if($shipment->ordered_at !== null && $shipment->accessResponse === 'granted'){
            $finalResult=$shipment;
        }else{

            $finalResult=[
                'id'=>$shipment->id,
                'deliveryType'=>self::deliveryTypeFaName($shipment->deliveryType),
                'accessId'=>$shipment->accessResponse,
                'access'=>self::AccessTypeFaName($shipment->accessResponse),
                'user'=>$shipment->user,
                'created_at'=>[
                    'date'=>verta($shipment->created_at->timestamp)->format('Y-n-j'),
                    'time'=>verta($shipment->created_at->timestamp)->format('H:i'),
                ]
            ];
        }
        return $MainApiController->customJsonResponse($finalResult, 'success', 200);
    }


    public function agencyShipmentsCount()
    {
        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);
        if($userAgencyInfo){
            return Shipment::whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
                ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)
                ->where("created_at", ">", Carbon::now()->subDay())->count();
        }

        Alert::error('لطفا شهر نمایندگی خود را وارد کنید','شما به عنوان نمایندگی ثبت شده اید و باید استان و شهر نماینگی خود را جهت مشاهده درخواست های مربوط به شهر خود ، وارد کنید','error');
    }
}
