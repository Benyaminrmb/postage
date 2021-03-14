<?php

namespace App\View\Components;

use App\Http\Controllers\Admin\AdminShipmentController;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class StepStatus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    /**
     * @var string
     */
    public $stepStatus;
    public $btnClass;
    public $orderedAt;
    public $shipmentId;
    public $shipment;
    public $accessResponse;

    public function __construct($shipmentId)
    {
        $userAgencyInfo=json_decode(Auth::user()->agencyInfo);
        if($userAgencyInfo){
            $shipment=Shipment::whereJsonContains('originAddress->city', $userAgencyInfo->location->city->id)
                ->whereJsonContains('originAddress->state', $userAgencyInfo->location->state->id)
                ->where("id", $shipmentId)->first();

            $this->stepStatus=$shipment->stepStatus;
            $this->shipmentId=$shipmentId;
            $this->shipment=$shipment;
            $this->accessResponse=($shipment->accessResponse==='granted' ? '' : 'disabled');
            $AdminShipmentController=new AdminShipmentController();
            $this->btnClass=$AdminShipmentController->stepStatusClass($shipment);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.step-status');
    }


}
