@component('admin.layouts.content' , ['title' => 'لیست سفارشات'])


    <div class="row">
        <div class="col-12 d-flex flex-wrap">

            <div class="col-md-12 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <span class="fad fa-compass @if($isGranted) text-info @endif"></span>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">وضعیت</span>
                        <div class="justify-content-center align-content-center">
                            <x-step-status shipmentId="{{ $shipment->id }}"
                                           class="max-w-2xl">
                            </x-step-status>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <span class="fad fa-shield-check @if($isGranted) text-info @endif"></span>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">دسترسی شما</span>
                        <span
                            class="info-box-number mt-2  {{ AdminShipmentController::AccessTypeFaName($shipment->accessResponse,$shipment->ordered_at)['class'] }}">
                            {{ AdminShipmentController::AccessTypeFaName($shipment->accessResponse,$shipment->ordered_at)['title'] }}
                        </span>
                    </div>
                </div>
            </div>


            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <span class="fad fa-fingerprint @if($isGranted) text-info @endif"></span>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">کد</span>
                        <span class="info-box-number mt-2 ">
                            {{ $shipment->id }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <span class="fad fa-cart-arrow-down @if($isGranted) text-info @endif"></span>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">نوع تحویل</span>
                        <span class="info-box-number mt-2 ">
                            {{ AdminShipmentController::deliveryTypeFaName($shipment->deliveryType) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <span class="fad fa-flux-capacitor @if($isGranted) text-info @endif"></span>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">روش حمل</span>
                        <span class="info-box-number mt-2 ">
                           {{ AdminShipmentController::deliveryVehicleFaName($shipment->deliveryVehicle) }}
                        </span>
                    </div>
                </div>
            </div>


            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <span class="fad fa-calendar-alt @if($isGranted) text-info @endif"></span>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">تاریخ درخواست</span>
                        <span class="info-box-number mt-2 ">
                            {{verta($shipment->created_at->timestamp)->format('Y/n/j')}}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <span class="fad fa-clock @if($isGranted) text-info @endif"></span>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">ساعت درخواست</span>
                        <span class="info-box-number mt-2 ">
                            {{verta($shipment->created_at->timestamp)->format('H:i')}}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <span class="fad fa-calendar-alt @if($isGranted) text-info @endif"></span>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">زمان درخواست نمایندگی</span>
                        <span class="info-box-number mt-2 ">
                            @if($shipment->ordered_at !== null)
                                {{verta($shipment->ordered_at)->format('H:i -  Y/n/j')}}
                            @else
                                هنوز درخواست نداده اید
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <span class="fad fa-calendar-alt @if($isGranted) text-info @endif"></span>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">زمان تایید نمایندگی</span>
                        <span class="info-box-number mt-2 ">
                            @if($shipment->response_at !== null)
                                {{verta($shipment->response_at)->format('H:i -  Y/n/j')}}
                            @else
                                هنوز تایید نشده
                            @endif
                        </span>
                    </div>
                </div>
            </div>


        </div>

        @if($isGranted)
            <div class="col-12 d-flex flex-wrap">
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">


                                <span class="username">توضیحات ادمین</span>
                                <span
                                    class="description">{{verta($shipment->response_at)->formatDifference()}}</span>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            متن توضیحات ...
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title">مشخصات درخواست کننده</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body ship_div p-0">
                            <ul>
                                <li class="text-right pr-2" title="نام">نام :</li>
                                <li class="text-left pl-2" title="نام">
                                    {{ $shipment->user->name }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="نام خانوادگی">نام خانوادگی :</li>
                                <li class="text-left pl-2" title="نام خانوادگی">
                                    {{ $shipment->user->family }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="کد ملی">کد ملی :</li>
                                <li class="text-left pl-2" title="کد ملی">
                                    {{ $shipment->user->nationalCode }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="جنسیت">جنسیت :</li>
                                <li class="text-left pl-2" title="جنسیت">
                                    {{ $shipment->user->gender }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="شماره همراه">شماره همراه :</li>
                                <li class="text-left pl-2" title="شماره همراه">
                                    <a href="tel:{{ $shipment->user->mobile }}">{{ $shipment->user->mobile }}</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="شماره ثابت">شماره ثابت :</li>
                                <li class="text-left pl-2" title="شماره ثابت">
                                    <a href="tel:{{ $shipment->user->telephone }}">{{ $shipment->user->telephone }}</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="ایمیل">ایمیل :</li>
                                <li class="text-left pl-2" title="ایمیل">
                                    <a href="mailto:{{ $shipment->user->email }}">{{ $shipment->user->email }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title">مشخصات تحویل گیرنده</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body ship_div p-0">
                            <ul>
                                <li class="text-right pr-2" title="نام">نام :</li>
                                <li class="text-left pl-2" title="نام">
                                    {{ $shipmentReceiverInformation['name'] }}

                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="نام خانوادگی">نام خانوادگی :</li>
                                <li class="text-left pl-2" title="نام خانوادگی">
                                    {{ $shipmentReceiverInformation['family'] }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="کد ملی">کد ملی :</li>
                                <li class="text-left pl-2" title="کد ملی">
                                    {{ $shipmentReceiverInformation['nationalCode'] }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="شماره همراه">شماره همراه :</li>
                                <li class="text-left pl-2" title="شماره همراه">
                                    <a href="tel:{{ $shipmentReceiverInformation['mobile'] }}">{{ $shipmentReceiverInformation['mobile'] }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card card-light card-outline">
                        <div class="card-header">
                            <h3 class="card-title">آدرس مبداء</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body ship_div p-0">
                            <ul>
                                <li class="text-right pr-2" title="آدرس مبداء">آدرس مبداء :</li>
                                <li class="text-left pl-2" title="آدرس مبداء">
                                    {{ $shipmentOriginAddress['string'] }}

                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="استان">استان :</li>
                                <li class="text-left pl-2" title="استان">
                                    {{ $shipmentOriginAddress['stateTitle'] }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="شهر">شهر :</li>
                                <li class="text-left pl-2" title="شهر">
                                    {{ $shipmentOriginAddress['cityTitle'] }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-left pl-2 pr-2">
                                    <div id="map2"></div>
                                    <input type="hidden"
                                           id="originLongAddress"
                                           value="{{ $shipmentOriginAddress['onMap']['long'] }}">
                                    <input type="hidden"
                                           id="originLatAddress"
                                           value="{{ $shipmentOriginAddress['onMap']['lat'] }}">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-light card-outline">
                        <div class="card-header">
                            <h3 class="card-title">آدرس مقصد</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body ship_div p-0">
                            <ul>
                                <li class="text-right pr-2" title="آدرس مبداء">آدرس مبداء :</li>
                                <li class="text-left pl-2" title="آدرس مبداء">
                                    {{ $shipmentDestinationAddress['string'] }}

                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="استان">استان :</li>
                                <li class="text-left pl-2" title="استان">
                                    {{ $shipmentDestinationAddress['stateTitle'] }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-right pr-2" title="شهر">شهر :</li>
                                <li class="text-left pl-2" title="شهر">
                                    {{ $shipmentDestinationAddress['cityTitle'] }}
                                </li>
                            </ul>
                            <ul>
                                <li class="text-left pl-2 pr-2">
                                    <div id="map"></div>
                                    <input type="hidden"
                                           id="destinationLongAddress"
                                           value="{{ $shipmentDestinationAddress['onMap']['long'] }}">
                                    <input type="hidden"
                                           id="destinationLatAddress"
                                           value="{{ $shipmentDestinationAddress['onMap']['lat'] }}">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>






    <script>
        var markers = [];
        var markers2 = [];
        var map;

        window.onload = function what() {
            var originLongAddress = document.getElementById('originLongAddress');
            var originLatAddress = document.getElementById('originLatAddress');
            var destinationLongAddress = document.getElementById('destinationLongAddress');
            var destinationLatAddress = document.getElementById('destinationLatAddress');
        }

        function initMap() {
            var labelIndex = 0;

            function initialize() {
                var center = {lat: Number(originLatAddress.value), lng: Number(originLongAddress.value)};
                var center2 = {lat: Number(destinationLatAddress.value), lng: Number(destinationLongAddress.value)};
                console.log(center);
                console.log(center2);
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 16,
                    center: center,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var map2 = new google.maps.Map(document.getElementById('map2'), {
                    zoom: 16,
                    center: center2,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                var myMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(Number(originLatAddress.value), Number(originLongAddress.value)),
                    draggable: true
                });

                google.maps.event.addListener(map, 'click', function (event) {
                    var lanlat_new = {
                        lat: parseFloat(event.latLng.lat().toFixed(3)),
                        lng: parseFloat(event.latLng.lng().toFixed(3))
                    };
                    addMarker(event.latLng, map);


                    originLongAddress.value = Number(lanlat_new.lng);
                    originLatAddress.value = Number(lanlat_new.lat);
                });
                google.maps.event.addListener(map2, 'click', function (event) {
                    var lanlat_new = {
                        lat: parseFloat(event.latLng.lat().toFixed(3)),
                        lng: parseFloat(event.latLng.lng().toFixed(3))
                    };
                    addMarker2(event.latLng, map2);
                    destinationLongAddress.value = Number(lanlat_new.lng);
                    destinationLatAddress.value = Number(lanlat_new.lat);
                });
                addMarker(center, map);
                addMarker2(center2, map2);
            }

            function addMarker2(location, map2) {
                clearMarkers2();
                var marker2 = new google.maps.Marker({
                    position: location,
                    map: map2,
                });
                markers2.push(marker2);
            }

            function addMarker(location, map) {
                clearMarkers();
                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                });
                markers.push(marker);
            }

            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }

            function setMapOnAll2(map) {
                for (var i = 0; i < markers2.length; i++) {
                    markers2[i].setMap(map);
                }
            }

            function deleteMarkers() {
                clearMarkers();
                markers = [];
            }

            function clearMarkers() {
                setMapOnAll(null);
            }

            function clearMarkers2() {
                setMapOnAll2(null);
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        }

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBUcxNAzDyoiTXUXpLwd1a-3jOwkQpDUs&callback=initMap"
            async defer></script>

@endcomponent
