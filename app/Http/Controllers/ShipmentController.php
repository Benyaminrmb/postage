<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\MainApiController;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ShipmentController extends Controller
{

    public function index()
    {
        return view('shipment.index');
    }


    public function detail($shipmentId)
    {
        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);
        $shipment=Shipment::where('id',$shipmentId)->whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
            ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)->first();

        return view('shipment.detail', compact('shipment'));
    }


    public function new()
    {
        $MainApiController=new MainApiController();
        $responseArray=$MainApiController->statesAndCities();
        $shipmentOptions=Auth::user()->shipmentOptions;



        $states=$responseArray['states'];
        $cities=$responseArray['cities'];

        return view('profile.shipment.new',compact('states','cities','shipmentOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \JsonException
     */
    public function create(Request $request)
    {

        $request->validate([
            'deliveryType' => 'required',
            'originAddress' => 'required',
            'destinationAddress' => 'required',
            'receiverName' => 'required',
            'receiverFamily' => 'required',
            'receiverMobile' => 'required',
            'receiverNationalCode' => 'nullable',
            'deliveryVehicle' => 'required',
        ]);

        $homeController=new HomeController();

        $originAddress=$homeController->getJson_encode([
            'string'=>$request->input('originAddress'),
            'state'=>$request->input('originState'),
            'city'=>$request->input('originCity'),
            'onMap'=>[
                'long'=>$request->input('originLongAddress'),
                'lat'=>$request->input('originLatAddress'),
            ]
        ]);

        $destinationAddress=$homeController->getJson_encode([
            'string'=>$request->input('destinationAddress'),
            'state'=>$request->input('destinationState'),
            'city'=>$request->input('destinationCity'),
            'onMap'=>[
                'long'=>$request->input('destinationLongAddress'),
                'lat'=>$request->input('destinationLatAddress'),
            ]
        ]);
        $receiverInformation=$homeController->getJson_encode([
            'name'=>$request->input('receiverName'),
            'family'=>$request->input('receiverFamily'),
            'mobile'=>$request->input('receiverMobile'),
            'nationalCode'=>$request->input('receiverNationalCode'),
        ]);
        $postalInformation=$homeController->getJson_encode([
            $request->input('shipmentOptions')
        ]);

        $requirement=[
            'user_id'=>Auth::user()->id,
            'deliveryType'=>$request->input('deliveryType'),
            'originAddress'=>$originAddress,
            'destinationAddress'=>$destinationAddress,
            'receiverInformation'=>$receiverInformation,
            'deliveryVehicle'=>$request->input('deliveryVehicle'),
            'postalInformation'=>$postalInformation,
        ];

        $shipment=Shipment::create($requirement);

        alert()->success('درخواست شما ثبت شد','ثبت مرسوله شما با موفقیت انجام شد')->showConfirmButton('متوجه شدم');

        return redirect('/profile/panel');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


}
