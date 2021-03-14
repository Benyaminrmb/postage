@extends('admin.layout.navbar')

@section('admin.navbar')

    <div class="col-md-12 p-0 card flex-wrap d-flex">
        <div class="card-body p-0 flex-wrap d-flex">

            <div class="col-md-12 mb-3">
                <div class="ship_div card  border border-light text-center">
                    <div class="card-body p-0">
                        <ul>
                            <li class="text-right text-bold pl-2 null">اطلاعات بار</li>
                        </ul>
                        <ul>
                            <li class="text-right pr-2" title="کد">کد :</li>
                            <li class="text-left pl-2" title="کد">
                                {{ $shipment->id }}
                            </li>
                        </ul>
                        <ul>
                            <li class="text-right pr-2" title="نوع تحویل">نوع تحویل :</li>
                            <li class="text-left pl-2" title="نوع تحویل">

                                {{ AdminShipmentController::deliveryTypeFaName($shipment->deliveryType) }}
                            </li>
                        </ul>
                        <ul>
                            <li class="text-right pr-2" title="دسترسی شما">دسترسی شما :</li>
                            <li class="text-left pl-2
                                {{ AdminShipmentController::AccessTypeFaName($shipment->accessResponse,$shipment->ordered_at)['class'] }}"
                                title="دسترسی شما">
                                {{ AdminShipmentController::AccessTypeFaName($shipment->accessResponse,$shipment->ordered_at)['title'] }}
                            </li>
                        </ul>
                        <ul>
                            <li class="text-right pr-2" title="زمان درخواست نمایندگی">زمان درخواست نمایندگی :</li>
                            <li class="text-left pl-2" title="زمان درخواست نمایندگی">
                                @if($shipment->ordered_at !== null)
                                    {{verta($shipment->ordered_at)->format('H:i -  Y/n/j')}}
                                @else
                                    هنوز درخواست نداده اید
                                @endif
                            </li>
                        </ul>
                        <ul>
                            <li class="text-right pr-2" title="زمان تایید نمایندگی">زمان تایید نمایندگی :</li>
                            <li class="text-left pl-2" title="زمان تایید نمایندگی">
                                @if($shipment->response_at !== null)
                                    {{verta($shipment->response_at)->format('H:i -  Y/n/j')}}
                                @else
                                    هنوز تایید نشده
                                @endif
                            </li>
                        </ul>
                        <ul>
                            <li class="text-right pr-2" title="تاریخ درخواست">تاریخ درخواست :</li>
                            <li class="text-left pl-2" title="تاریخ درخواست">
                                {{verta($shipment->created_at->timestamp)->format('Y/n/j')}}
                            </li>
                        </ul>
                        <ul>
                            <li class="text-right pr-2" title="ساعت درخواست">ساعت درخواست :</li>
                            <li class="text-left pl-2" title="ساعت درخواست">
                                {{verta($shipment->created_at->timestamp)->format('H:i')}}</li>
                        </ul>
                        <ul>
                            <li class="text-right pr-2" title="روش حمل">روش حمل :</li>
                            <li class="text-left pl-2" title="روش حمل">
                                {{ AdminShipmentController::deliveryVehicleFaName($shipment->deliveryVehicle) }}</li>
                        </ul>

                    </div>
                </div>
            </div>

            @if($shipment->ordered_at!==null && $shipment->accessResponse==='granted')
                <div class="col-md-12 mb-3">
                    <div class="ship_div card  border border-light text-center">
                        <div class="card-body p-0">
                            <ul>
                                <li class="text-right text-bold pl-2 null">توضیحات ادمین</li>
                            </ul>
                            <ul>
                                <li class="text-right pl-2 pr-2">
                                    متن توضیحات ...
                                </li>
                            </ul>


                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="ship_div card  border border-light text-center">
                        <div class="card-body p-0">
                            <ul>
                                <li class="text-right text-bold pl-2 null">مشخصات درخواست کننده</li>
                            </ul>
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
                <div class="col-md-6 mb-3">
                    <div class="ship_div card  border border-light text-center">
                        <div class="card-body p-0">
                            <ul>
                                <li class="text-right text-bold pl-2 null">مشخصات تحویل گیرنده</li>
                            </ul>
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
                <div class="col-md-6 mb-3">
                    <div class="ship_div card  border border-light text-center">
                        <div class="card-body p-0">
                            <ul>
                                <li class="text-right text-bold pl-2 null">آدرس مبداء</li>
                            </ul>
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
                                    <div id="map"></div>
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
                <div class="col-md-6 mb-3">
                    <div class="ship_div card  border border-light text-center">
                        <div class="card-body p-0">
                            <ul>
                                <li class="text-right text-bold pl-2 null">آدرس مبداء</li>
                            </ul>
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
                                    <div id="map2"></div>
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
            @endif

        </div>
        <nav class="navbar  sticky-bottom navbar-expand-lg navbar-light bg-light mt-4
                    justify-content-center align-content-center">
            <x-step-status shipmentId="{{ $shipment->id }}"
                           class="max-w-2xl">
            </x-step-status>
        </nav>
    </div>



@endsection

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
