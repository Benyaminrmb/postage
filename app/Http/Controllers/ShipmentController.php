<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{

    public function index()
    {
        return view('shipment.index');
    }


    public function new()
    {
        return view('shipment.new');
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
            'originLongAddress' => 'required',
            'originLatAddress' => 'required',
            'destinationAddress' => 'required',
            'destinationLongAddress' => 'required',
            'destinationLatAddress' => 'required',
            'receiverName' => 'required',
            'receiverFamily' => 'required',
            'receiverMobile' => 'required',
            'receiverNationalCode' => 'nullable',
            'deliveryVehicle' => 'required',
            'productName' => 'required',
            'productCount' => 'required',
            'productWeight' => 'required',
            'productVolume' => 'required',
        ]);

        $homeController=new HomeController();

        $originAddress=$homeController->getJson_encode([
            'string'=>$request->input('originAddress'),
            'onMap'=>[
                'long'=>$request->input('originLongAddress'),
                'lat'=>$request->input('originLatAddress'),
            ]
        ]);

        $destinationAddress=$homeController->getJson_encode([
            'string'=>$request->input('destinationAddress'),
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
            'name'=>$request->input('productName'),
            'count'=>$request->input('productCount'),
            'weight'=>$request->input('productWeight'),
            'volume'=>$request->input('productVolume'),
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

        dd($shipment);
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
