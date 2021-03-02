<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\AdminShipmentController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AgencyShipmentsCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ShipmentController=new AdminShipmentController();
        $agencyShipmentsCount=$ShipmentController->agencyShipmentsCount();
        View::share('agencyShipmentsCount',$agencyShipmentsCount);
        return $next($request);
    }
}
