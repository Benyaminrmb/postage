@component('admin.layouts.content' , ['title' => 'سفارش جدید'])


    <div class="row justify-content-center">
        <div class="col-md-8 p-0 flex-wrap d-flex ">

            <form class="col-md-12 p-0"
                  method="post"
                  action="{{route('shipment.create')}}">
                @csrf

                <div class="col-md-12 my-2 p-0 font-14">
                    <span class="checkbox-group-legend d-flex justify-content-center align-items-center">نوع تحویل مرسوله</span>
                </div>
                <div class="col-md-12 p-0 flex-wrap shadow bg-white rounded d-flex mb-4">
                    <div class="col-md-12 p-2">
                        <div class="form-group m-0">
                            <fieldset class="checkbox-group">
                                <div class="checkbox">
                                    <label class="checkbox-wrapper m-0">
                                        <input name="deliveryType"
                                               type="radio"
                                               value="byUser"
                                               class="checkbox-input"/>
                                        <span class="checkbox-tile">
                                        <span class="checkbox-icon">
                                            <span class="fad h3 fa-walking"></span>
                                        </span>
                                        <span class="checkbox-label">توسط شما</span>
                                    </span>
                                    </label>
                                    <label class="checkbox-wrapper m-0">
                                        <input name="deliveryType"
                                               type="radio"
                                               value="byCompany"
                                               class="checkbox-input"/>
                                        <span class="checkbox-tile">
                                        <span class="checkbox-icon">
                                            <span class="fad h3 fa-user-hard-hat"></span>
                                        </span>
                                        <span class="checkbox-label">توسط شرکت</span>
                                    </span>
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 my-2 p-0 font-14">
                    <span class="checkbox-group-legend d-flex justify-content-center align-items-center">تعیین آدرس فرستنده</span>
                </div>
                <div class="col-md-12 p-0 flex-wrap shadow bg-white rounded d-flex mb-4">
                    <div class="col-md-6 p-2 pt-3">
                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="originAddress">آدرس مبداء</label>
                            <input type="text" name="originAddress" value="{{ old('originAddress') }}"
                                   class="w-100 form-control-sm form-control @error('originAddress') is-invalid @enderror "
                                   id="originAddress">
                            @error('originAddress')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="originState">استان</label>
                            <select
                                onchange="getStateCities($(this).val(),'#originCity','{{ route('gds.api.state.cities') }}')"
                                id="originState" name="originState"
                                class="w-100 form-control-sm form-control font-13 simpleSelect2">
                                <option selected> انتخاب استان</option>
                                @foreach($states as $state)
                                    <option value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="originCity">شهر</label>
                            <select id="originCity" name="originCity"
                                    class="form-control-sm form-control font-13 simpleSelect2">
                                <option disabled>ابتدا استان را انتخاب کنید</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="originAddress">نام فرستنده</label>
                            <input type="text" name="originAddress"
                                   disabled
                                   value="{{ \Illuminate\Support\Facades\Auth::user()->name }}"
                                   class="w-100 form-control-sm form-control">
                        </div>

                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="originAddress">کد ملی</label>
                            <input type="text"
                                   disabled
                                   value="{{ \Illuminate\Support\Facades\Auth::user()->nationalCode }}"
                                   class="w-100 form-control-sm form-control">
                        </div>

                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="originAddress">موبایل</label>
                            <input type="text"
                                   disabled
                                   value="{{ \Illuminate\Support\Facades\Auth::user()->mobile }}"
                                   class="w-100 form-control-sm form-control">
                        </div>
                        <div class="col-md-12 mb-3 col-6 font-14 text-left">
                            <a href="{{ route('profile.edit') }}">ویرایش پروفایل</a>
                        </div>


                        <div class="d-none col-md-12 mb-4 col-6 font-14">
                            <input type="hidden" name="originLongAddress" id="originLongAddress"
                                   value="@if(old('originLongAddress') === null){{ '51.3668215' }}@else{ { old('originLongAddress') }}@endif"
                                   class="form-control-sm form-control @error('originLongAddress') is-invalid @enderror ">
                            <input type="hidden" name="originLatAddress" id="originLatAddress"
                                   value="@if(old('originLatAddress') === null){{'35.6729995'}}@else {{ old('originLatAddress') }}@endif"
                                   class="form-control-sm form-control @error('originLatAddress') is-invalid @enderror ">
                        </div>
                    </div>
                    <div class="col-md-6 p-0 bg-warning">
                        <div id="map2"></div>
                    </div>
                </div>


                <div class="col-md-12 my-2 p-0 font-14">
                    <span class="checkbox-group-legend d-flex justify-content-center align-items-center">تعیین آدرس گیرنده</span>
                </div>
                <div class="col-md-12 p-0 flex-wrap shadow bg-white rounded d-flex mb-4">
                    <div class="col-md-6 p-2 pt-3">
                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="destinationAddress">آدرس مقصد</label>
                            <input type="text" name="destinationAddress" value="{{ old('destinationAddress') }}"
                                   class="w-100 form-control-sm form-control @error('destinationAddress') is-invalid @enderror "
                                   id="destinationAddress">
                            @error('destinationAddress')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="destinationState">استان</label>
                            <select
                                onchange="getStateCities($(this).val(),'#destinationCity','{{ route('gds.api.state.cities') }}')"
                                id="destinationState" name="destinationState"
                                class="w-100 form-control-sm form-control font-13 simpleSelect2">
                                <option selected> انتخاب استان</option>
                                @foreach($states as $state)
                                    <option value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="destinationCity">شهر</label>
                            <select id="destinationCity" name="destinationCity"
                                    class="form-control-sm form-control font-13 simpleSelect2">
                                <option disabled>ابتدا استان را انتخاب کنید</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="receiverName">نام</label>
                            <input type="text" name="receiverName" value="{{ old('receiverName') }}"
                                   class="form-control-sm form-control @error('receiverName') is-invalid @enderror "
                                   id="receiverName">
                            @error('receiverName')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="receiverFamily">نام خانوادگی</label>
                            <input type="text" name="receiverFamily" value="{{ old('receiverFamily') }}"
                                   class="form-control-sm form-control @error('receiverFamily') is-invalid @enderror "
                                   id="receiverFamily">
                            @error('receiverFamily')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="receiverMobile">تلفن همراه</label>
                            <input type="text" name="receiverMobile" value="{{ old('receiverMobile') }}"
                                   class="form-control-sm form-control @error('receiverMobile') is-invalid @enderror "
                                   id="receiverMobile">
                            @error('receiverMobile')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3 col-6 font-14">
                            <label for="receiverNationalCode">کد ملی</label>
                            <input type="text" name="receiverNationalCode"
                                   value="{{ old('receiverNationalCode') }}"
                                   class="form-control-sm form-control @error('receiverNationalCode') is-invalid @enderror "
                                   id="receiverNationalCode">
                            @error('receiverNationalCode')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="d-none col-md-12 mb-4 col-6 font-14">
                            <input type="hidden" name="destinationLongAddress" id="destinationLongAddress"
                                   value="@if(old('destinationLongAddress') === null){{ '51.3668216' }}@else{ { old('destinationLongAddress') }}@endif"
                                   class="form-control-sm form-control @error('destinationLongAddress') is-invalid @enderror ">
                            <input type="hidden" name="destinationLatAddress" id="destinationLatAddress"
                                   value="@if(old('destinationLatAddress') === null){{'35.6729993'}}@else {{ old('destinationLatAddress') }}@endif"
                                   class="form-control-sm form-control @error('destinationLatAddress') is-invalid @enderror ">
                        </div>
                    </div>
                    <div class="col-md-6 p-0 bg-warning">
                        <div id="map"></div>
                    </div>
                </div>


                <div class="col-md-12 my-2 p-0 font-14">
                    <span
                        class="checkbox-group-legend d-flex justify-content-center align-items-center">روش ارسال</span>
                </div>
                <div class="col-md-12 p-0 flex-wrap shadow bg-white rounded d-flex mb-4">
                    <div class="col-md-12 p-2">
                        <div class="form-group m-0">
                            <fieldset class="checkbox-group">
                                <div class="checkbox">
                                    <label class="checkbox-wrapper m-0">
                                        <input name="deliveryVehicle"
                                               type="radio"
                                               value="byCar"
                                               class="checkbox-input"/>
                                        <span class="checkbox-tile">
                                        <span class="checkbox-icon">
                                            <span class="fad h3 fa-shuttle-van"></span>
                                        </span>
                                        <span class="checkbox-label">خودرویی</span>
                                    </span>
                                    </label>
                                    <label class="checkbox-wrapper m-0">
                                        <input name="deliveryVehicle"
                                               type="radio"
                                               value="byRail"
                                               class="checkbox-input"/>
                                        <span class="checkbox-tile">
                                        <span class="checkbox-icon">
                                            <span class="fad h3 fa-subway"></span>
                                        </span>
                                        <span class="checkbox-label">ریلی</span>
                                    </span>
                                    </label>
                                    <label class="checkbox-wrapper m-0">
                                        <input name="deliveryVehicle"
                                               type="radio"
                                               value="byAir"
                                               class="checkbox-input"/>
                                        <span class="checkbox-tile">
                                        <span class="checkbox-icon">
                                            <span class="fad h3 fa-plane-departure"></span>
                                        </span>
                                        <span class="checkbox-label">هوایی</span>
                                    </span>
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

                @if($shipmentOptions->count() > 0)
                    <div class="col-md-12 my-2 p-0 font-14">
                        <span class="checkbox-group-legend d-flex justify-content-center align-items-center">اطلاعات مرسوله</span>
                    </div>
                    <div class="col-md-12 p-0 flex-wrap shadow bg-white rounded d-flex mb-4">
                        <div class="col-md-12 p-2 pt-3">
                            @foreach($shipmentOptions as $input)

                                @if($input->type == 'input')
                                    <div class="col-md-12 mb-3 col-6 font-14">
                                        <label for="shipmentOption{{$input->id}}">{{$input->name}}</label>
                                        <input type="text" name="shipmentOptions[{{$input->name}}]"
                                               value="{{ old('productName') }}"
                                               class="form-control-sm form-control"
                                               required
                                               id="shipmentOption{{$input->id}}" placeholder="{{$input->name}}">
                                    </div>
                                @endif

                                @if($input->type == 'select')
                                    <div class="col-md-12 mb-3 col-6 font-14">
                                        <label for="shipmentOption{{$input->id}}">{{$input->name}}</label>
                                        <select class="form-control-sm form-control"
                                                required
                                                name="shipmentOptions[{{$input->name}}]"
                                                id="shipmentOption{{$input->id}}">
                                            @foreach(json_decode($input->data) as $key=>$option)
                                                <option value="{{ $key }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if($input->type == 'checkbox')
                                    <div class="col-md-12 mb-3 col-6 font-14">
                                        <label for="shipmentOption{{$input->id}}">{{$input->name}}</label>
                                        <input type="checkbox" name="shipmentOptions[{{$input->name}}]"
                                               class="form-control-sm form-control"
                                               required
                                               id="shipmentOption{{$input->id}}" placeholder="{{$input->name}}">
                                    </div>
                                @endif

                            @endforeach

                        </div>
                    </div>
                @endif

                <div class="col-md-12 mb-4 my-2 d-flex flex-wrap align-items-center justify-content-center p-0 font-14">
                    <button type="submit"
                            class="btn btn-primary">ثبت درخواست
                    </button>
                </div>
            </form>
        </div>
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
