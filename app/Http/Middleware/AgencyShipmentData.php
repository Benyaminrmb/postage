<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminShipmentController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AgencyShipmentData
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->userType==='agency'){
                $ShipmentController=new AdminShipmentController();
                $AdminController=new AdminController();
                $userAgencyInfo=$AdminController->needUserAgencyInfo();
                if($userAgencyInfo){

                    $lastUnseenAgencyShipments=$ShipmentController->getLastUnseenAgencyShipment();
                    $notApprovedAgencyShipments=$ShipmentController->notApprovedAgencyShipments();


                    View::share('lastUnseenAgencyShipments', $lastUnseenAgencyShipments);
                    View::share('notApprovedAgencyShipments', $notApprovedAgencyShipments);
                    return $next($request);
                }
                View::share('lastUnseenAgencyShipments', null);
                View::share('notApprovedAgencyShipments', null);

                if(!request()->routeIs('profile.agency.edit.state')){
                    return redirect()->route('profile.agency.edit.state');
                }

            }else{
                View::share('lastUnseenAgencyShipments', null);
                View::share('notApprovedAgencyShipments', null);

            }
        }
        View::share('agencyShipmentsCount', '');
        return $next($request);
    }
}
