<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\MainApiController;
use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentOptions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminShipmentController extends Controller
{
    public function getList($statusId=null)
    {
        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);

        if($statusId){
            if($statusId==='not-approved'){
                $shipments=Shipment::where('stepStatus', 'notApproved')
                    ->where('accessResponse', 'granted')
                    ->where('agency_id', Auth::user()->id)
                    ->whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
                    ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)->paginate(15);

            }elseif($statusId==='on-process'){
                $shipments=Shipment::where('stepStatus', 'onProcess')
                    ->where('accessResponse', 'granted')
                    ->where('agency_id', Auth::user()->id)
                    ->whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
                    ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)->paginate(15);

            }elseif($statusId==='complate'){
                $shipments=Shipment::where('stepStatus', 'receivedByTheRecipient')
                    ->where('accessResponse', 'granted')
                    ->where('agency_id', Auth::user()->id)
                    ->whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
                    ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)->paginate(15);

            }elseif($statusId==='un-complate'){
                $shipments=Shipment::where('stepStatus', '!=', 'receivedByTheRecipient')
                    ->where('accessResponse', 'granted')
                    ->where('agency_id', Auth::user()->id)
                    ->whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
                    ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)->paginate(15);

            }else{
                return abort(404);
            }
        }else{
            $shipments=Shipment::whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
                ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)->paginate(15);
        }

        return view('admin.shipment.list', compact('shipments'));
    }

    public function detail($shipmentId)
    {
        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);
        $shipment=Shipment::where('id', $shipmentId)
            ->whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
            ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)->first();

        $shipmentReceiverInformation=json_decode($shipment->receiverInformation, true);


        $shipmentOriginAddress=json_decode($shipment->originAddress, true);

        $MainApiController=new MainApiController();
        $requestArray=$MainApiController->makeRequestArray([
            'id'=>$shipmentOriginAddress['city']
        ], 'getCity');
        $response=$MainApiController->sendRequestToGds($requestArray);
        $responseCity=$MainApiController->fixJsonEncode($response);

        $requestArray=$MainApiController->makeRequestArray([
            'id'=>$shipmentOriginAddress['state']
        ], 'getCity');
        $response=$MainApiController->sendRequestToGds($requestArray);
        $responseState=$MainApiController->fixJsonEncode($response);


        $shipmentOriginAddress['cityTitle']=$responseCity['title'];
        $shipmentOriginAddress['stateTitle']=$responseState['title'];

        $shipmentDestinationAddress=json_decode($shipment->destinationAddress, true);
        $MainApiController=new MainApiController();
        $requestArray=$MainApiController->makeRequestArray([
            'id'=>$shipmentDestinationAddress['city']
        ], 'getCity');
        $response=$MainApiController->sendRequestToGds($requestArray);
        $responseCity=$MainApiController->fixJsonEncode($response);


        $requestArray=$MainApiController->makeRequestArray([
            'id'=>$shipmentDestinationAddress['state']
        ], 'getCity');
        $response=$MainApiController->sendRequestToGds($requestArray);
        $responseState=$MainApiController->fixJsonEncode($response);


        $shipmentDestinationAddress['cityTitle']=$responseCity['title'];
        $shipmentDestinationAddress['stateTitle']=$responseState['title'];

        $isGranted=$this->isGranted($shipment);

        return view('admin.shipment.detail', compact('shipment', 'shipmentReceiverInformation', 'shipmentOriginAddress', 'shipmentDestinationAddress', 'isGranted'));
    }

    public static function deliveryTypeFaName($val): string
    {
        if($val==='byCompany'){
            return 'توسط شرکت';
        }
        if($val==='byUser'){
            return 'توسط شخص';
        }
    }


    public static function optionType($val): string
    {
        if($val==='input'){
            return 'متن';
        }
        if($val==='select'){
            return 'کمبو باکس';
        }
        if($val==='checkbox'){
            return 'بله / خیر';
        }
    }


    public static function deliveryVehicleFaName($val): string
    {
        if($val==='byRail'){
            return 'ریلی';
        }
        if($val==='byAir'){
            return 'هوایی';
        }
        if($val==='byCar'){
            return 'خودرویی';
        }
    }

    public static function AccessTypeFaName($val, $ordered_at=null)
    {
        if($val==='denied'){
            if($ordered_at!==null){
                return [
                    'title'=>'در انتظار تایید',
                    'class'=>'text-warning'
                ];
            }
            return [
                'title'=>'غیر مجاز',
                'class'=>'text-danger'
            ];
        }
        if($val==='granted'){
            return [
                'title'=>'تایید شده',
                'class'=>'text-success'
            ];
        }
    }

    public function get(Request $request): \Illuminate\Http\JsonResponse
    {
        $MainApiController=new MainApiController();
        $shipment=Shipment::with('user')->find($request->input('id'));
        if($shipment->seen_at===null){
            $shipment->seen_at=Carbon::now();
            $shipment->save();
        }
        if($shipment->ordered_at!==null && $shipment->accessResponse==='granted'){
            $finalResult=[
                'shipment'=>$shipment,
                'id'=>$shipment->id,
                'deliveryType'=>self::deliveryTypeFaName($shipment->deliveryType),
                'accessId'=>$shipment->accessResponse,
                'access'=>self::AccessTypeFaName($shipment->accessResponse, $shipment->ordered_at),
                'user'=>$shipment->user,
                'created_at'=>[
                    'date'=>verta($shipment->created_at->timestamp)->format('Y-n-j'),
                    'time'=>verta($shipment->created_at->timestamp)->format('H:i'),
                ],
                'ordered_at'=>$shipment->ordered_at,
            ];
        }else{

            $finalResult=[
                'id'=>$shipment->id,
                'deliveryType'=>self::deliveryTypeFaName($shipment->deliveryType),
                'accessId'=>$shipment->accessResponse,
                'access'=>self::AccessTypeFaName($shipment->accessResponse, $shipment->ordered_at),
                'user'=>$shipment->user,
                'created_at'=>[
                    'date'=>verta($shipment->created_at->timestamp)->format('Y-n-j'),
                    'time'=>verta($shipment->created_at->timestamp)->format('H:i'),
                ],
                'ordered_at'=>$shipment->ordered_at,
            ];
        }

        $messageData=$MainApiController->customJsonMessage('نمایش محتوا', '', $finalResult);
        return $MainApiController->customJsonResponse($messageData, 'success');
    }

    public function agencyShipmentsCount()
    {
        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);
        if($userAgencyInfo){
            return Shipment::whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
                ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)
                ->where("created_at", ">", Carbon::now()->subDay())->count();
        }

        Alert::error('لطفا شهر نمایندگی خود را وارد کنید', 'شما به عنوان نمایندگی ثبت شده اید و باید استان و شهر نماینگی خود را جهت مشاهده درخواست های مربوط به شهر خود ، وارد کنید', 'error');
    }

    public function createOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $MainApiController=new MainApiController();

        $requestArray=$MainApiController->makeRequestArray([
            'shipment_id'=>$request->input('shipment_id'),
            'user_id'=>Auth::user()->id,
            'user_token'=>Auth::user()->token,
        ], 'orderRequest');
        $response=$MainApiController->sendRequestToGds($requestArray);
        $response=$MainApiController->fixJsonEncode($response);



        if($response['status']==='success'){
            $shipment=Shipment::find($request->input('shipment_id'));
            $shipment->ordered_at=Carbon::now()->toDateTimeString();
            $shipment->agency_id=Auth::user()->id;
            $shipment->update();
        }
        $messageData=$MainApiController->customJsonMessage($response['title'], $response['message'], @$shipment);
        return $MainApiController->customJsonResponse($messageData, $response['status'], $response['http']);
    }

    public function removeOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $MainApiController=new MainApiController();

        $requestArray=$MainApiController->makeRequestArray([
            'shipment_id'=>$request->input('shipment_id'),
            'user_id'=>Auth::user()->id,
            'user_token'=>Auth::user()->token,
            'accessStatus'=>'remove',
        ], 'orderRequest');
        $response=$MainApiController->sendRequestToGds($requestArray);
        $response=$MainApiController->fixJsonEncode($response);


        if($response['status']==='success'){
            $shipment=Shipment::find($request->input('shipment_id'));
            $shipment->ordered_at=null;
            $shipment->agency_id=null;
            $shipment->update();
        }

        $messageData=$MainApiController->customJsonMessage($response['title'], $response['message'], @$shipment);
        return $MainApiController->customJsonResponse($messageData, $response['status'], $response['http']);
    }

    public function editStepStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $MainApiController=new MainApiController();

        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);
        $shipment=Shipment::whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
            ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)
            ->where("id", $request->input('shipment_id'))->first();

        $shipment->stepStatus=$request->input('stepStatus');


        $shipment->update();


        $messageData=$MainApiController->customJsonMessage('انجام شد', '', $shipment);
        return $MainApiController->customJsonResponse($messageData, 'success');
    }

    /**
     * @param $shipment
     */
    public function stepStatusClass($shipment): string
    {
        switch($shipment->stepStatus){
            case 'onProcess':
            case 'notApproved':
                if($shipment->ordered_at===''){
                    $result='btn-outline-danger';
                    break;
                }
                $result='btn-outline-warning';
                break;
            case 'getProduct':
                $result='btn-outline-info';
                break;
            case 'onTheWay':
                $result='btn-outline-primary';
                break;
            case 'receivedByTheRecipient':
                $result='btn-outline-success';
                break;
        }
        return $result;

    }

    /**
     * @return mixed
     */
    public function getLastUnseenAgencyShipment()
    {

        $AdminController=new AdminController();
        $userAgencyInfo=$AdminController->needUserAgencyInfo();

        if($userAgencyInfo){

            $lastShipment=Shipment::whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
                ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)
                ->where('stepStatus', '!=', 'receivedByTheRecipient')->where('seen_at', null)->where('agency_id', null)
                ->orderBy('created_at', 'desc')->limit(4)->get();


            return $lastShipment;
        }
        return false;

    }

    /**
     * @return mixed
     */
    public function unComplateAgencyShipments()
    {
        return Auth::user()->unComplateAgencyShipments;
    }

    /**
     * @return mixed
     */
    public function complateAgencyShipments()
    {
        return Auth::user()->complateAgencyShipments;
    }

    /**
     * @return mixed
     */
    public function onProcessAgencyShipments()
    {
        return Auth::user()->onProcessAgencyShipments;
    }

    /**
     * @return mixed
     */
    public function notApprovedAgencyShipments()
    {
        return Auth::user()->notApprovedAgencyShipments;
    }

    /**
     * @param $shipment
     */
    public function isGranted($shipment): bool
    {
        if($shipment->ordered_at!==null && $shipment->accessResponse==='granted'){
            return true;
        }
        return false;
    }

    public function newShipmentOptions()
    {
        return view('admin.shipment.option.add');
    }

    public function listShipmentOptions()
    {
        $shipmentOptions=Auth::user()->shipmentOptions->all();
        return view('admin.shipment.option.list',compact('shipmentOptions'));
    }
    public function storeShipmentOptions(Request $request)
    {
        $request->validate([
            'type'=>'required',
            'name'=>'required',
            'data'=>'required',
        ]);


        $flight = new ShipmentOptions;

        $flight->name = $request->name;
        $flight->type = $request->type;
        $flight->agency_id = $request->user()->id;
        $flight->data = json_encode($request->input('data'), JSON_THROW_ON_ERROR);


        $flight->save();

        $shipmentOptions=$request->user()->shipmentOptions;
        alert()->success('تغییرات اعمال شد','تغییرات با موفقیت انجام شد')->showConfirmButton('متوجه شدم');

        return back();

    }
}
