<?php

namespace App\Providers;

use App\Http\Controllers\Admin\AdminShipmentController;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $ShipmentController=new AdminShipmentController();
//        $agencyShipmentsCount=$ShipmentController->agencyShipmentsCount();
//        View::share('agencyShipmentsCount',$agencyShipmentsCount);

//        View::composer('app', function ($view) {
//            $view->with('agencyShipmentsCount', ['awd'=>'awdddddd']);
//        });
//
//
//        View::share('signedIn', \Auth::check());
//
//        View::share('user', \Auth::user());
        Paginator::useBootstrap();
    }
}
