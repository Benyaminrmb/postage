@extends('profile.layout.app')

@section('profile.index')
    <div class="row justify-content-center">

        <div class="col-md-12 stepPhase">
            @include('layouts.notifications')
            <form method="post" action="{{route('shipment.create')}}">
                @csrf
                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">نوع ارسال بسته</div>
                    <div class="card-body p-2">
                        <div class="form-group mb-0">
                            <div class="col-md-12">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input checked type="radio" value="byUser" id="deliveryType"
                                           name="deliveryType"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="deliveryType">توسط شما</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="byCompany" id="deliveryType2" name="deliveryType"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="deliveryType2">توسط شرکت</label>
                                </div>
                                <small id="deliveryType" class="form-text text-dark p-1 rounded">
                                    <div class="col-md-12 pr-0 mb-2">

                                        <span class="text-info fa fa-info"></span>
                                        <span class="badge badge-info font-13">توسط شما</span>
                                        <span class="text-secondary font-13"> : تحویل مرسوله به شرکت توسط شما</span>
                                    </div>
                                    <div class="col-md-12 pr-0">
                                        <span class="text-info fa fa-info"></span>
                                        <span class="badge badge-info font-13">توسط شرکت</span>
                                        <span
                                            class="text-secondary font-13">: تحویل مرسوله توسط شرکت از آدرس مبدا</span>
                                    </div>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" onclick="checkStep($(this))" class="btn btn-primary btn-sm">
                            مرحله بعدی
                        </button>
                    </div>
                </div>


                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">مبداء</div>
                    <div class="card-body p-2">

                        <div class="form-group">

                            <div class="col-6">
                                <label for="originAddress">آدرس مبداء</label>
                                <input type="text" name="originAddress" value="{{ old('originAddress') }}"
                                       class="w-100 form-control @error('originAddress') is-invalid @enderror "
                                       id="originAddress" placeholder="آدرس مبداء">
                                @error('originAddress')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="originState">استان</label>
                                    <select
                                        onchange="getStateCities($(this).val(),'#originCity','{{ route('gds.api.state.cities') }}')"
                                        id="originState" name="originState"
                                        class="w-100 form-control font-13 simpleSelect2">
                                        <option selected>یک استان انتخاب کنید</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="originCity">شهر</label>
                                    <select id="originCity" name="originCity"
                                            class="form-control font-13 simpleSelect2">
                                        <option disabled>ابتدا استان را انتخاب کنید</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agencyState">نقشه</label>
                                    <div id="map2"></div>
                                    <input type="hidden" name="originLongAddress" id="originLongAddress"
                                           value="@if(old('originLongAddress') === null){{ '51.3668215' }}@else{ { old('originLongAddress') }}@endif"
                                           class="form-control @error('originLongAddress') is-invalid @enderror ">
                                    <input type="hidden" name="originLatAddress" id="originLatAddress"
                                           value="@if(old('originLatAddress') === null){{'35.6729995'}}@else {{ old('originLatAddress') }}@endif"
                                           class="form-control @error('originLatAddress') is-invalid @enderror ">
                                </div>
                            </div>


                            <div class="w-100 d-flex">

                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" onclick="checkStep($(this))" class="btn btn-primary btn-sm">
                            مرحله بعدی
                        </button>
                    </div>
                </div>


                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">مقصد</div>
                    <div class="card-body p-2">

                        <div class="form-group">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="destinationAddress">آدرس مقصد</label>
                                    <input type="text" name="destinationAddress" value="{{ old('destinationAddress') }}"
                                           class="w-100 form-control @error('destinationAddress') is-invalid @enderror "
                                           id="destinationAddress" placeholder="آدرس مقصد">
                                    @error('destinationAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-100 d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destinationState">استان</label>
                                        <select
                                            onchange="getStateCities($(this).val(),'#destinationCity','{{ route('gds.api.state.cities') }}')"
                                            id="destinationState" name="destinationState"
                                            class="w-100 form-control font-13 simpleSelect2">
                                            <option selected>یک استان انتخاب کنید</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destinationCity">شهر</label>
                                        <select id="destinationCity" name="destinationCity"
                                                class="form-control font-13 simpleSelect2">
                                            <option disabled>ابتدا استان را انتخاب کنید</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="w-100 d-flex">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="agencyState">نقشه</label>
                                        <div id="map"></div>
                                        <input type="hidden" name="destinationLongAddress" id="destinationLongAddress"
                                               value="@if(old('destinationLongAddress') === null){{ '51.3668216' }}@else{ { old('destinationLongAddress') }}@endif"
                                               class="form-control @error('destinationLongAddress') is-invalid @enderror ">
                                        <input type="hidden" name="destinationLatAddress" id="destinationLatAddress"
                                               value="@if(old('destinationLatAddress') === null){{'35.6729993'}}@else {{ old('destinationLatAddress') }}@endif"
                                               class="form-control @error('destinationLatAddress') is-invalid @enderror ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" onclick="checkStep($(this))" class="btn btn-primary btn-sm">
                            مرحله بعدی
                        </button>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">اطلاعات شخص دریافت کننده</div>
                    <div class="card-body p-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="receiverName">نام</label>
                                <input type="text" name="receiverName" value="{{ old('receiverName') }}"
                                       class="form-control @error('receiverName') is-invalid @enderror "
                                       id="receiverName" placeholder="نام">
                                @error('receiverName')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="receiverFamily">نام خانوادگی</label>
                                <input type="text" name="receiverFamily" value="{{ old('receiverFamily') }}"
                                       class="form-control @error('receiverFamily') is-invalid @enderror "
                                       id="receiverFamily" placeholder="نام خانوادگی">
                                @error('receiverFamily')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="receiverMobile">تلفن همراه</label>
                                <input type="text" name="receiverMobile" value="{{ old('receiverMobile') }}"
                                       class="form-control @error('receiverMobile') is-invalid @enderror "
                                       id="receiverMobile" placeholder="تلفن همراه">
                                @error('receiverMobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="receiverNationalCode">کد ملی</label>
                                <input type="text" name="receiverNationalCode"
                                       value="{{ old('receiverNationalCode') }}"
                                       class="form-control @error('receiverNationalCode') is-invalid @enderror "
                                       id="receiverNationalCode" placeholder="کد ملی">
                                @error('receiverNationalCode')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" onclick="checkStep($(this))" class="btn btn-primary btn-sm">
                            مرحله بعدی
                        </button>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">روش ارسال</div>
                    <div class="card-body p-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-primary active">
                                        <input type="radio" name="deliveryVehicle"
                                               value="byCar" id="deliveryVehicle1" checked>
                                        خودرویی
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="deliveryVehicle"
                                               value="byRail" id="deliveryVehicle2"> ریلی
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="deliveryVehicle"
                                               value="byAir" id="deliveryVehicle3"> هوایی
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" onclick="checkStep($(this))" class="btn btn-primary btn-sm">
                            مرحله بعدی
                        </button>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">اطلاعات مرسوله</div>
                    <div class="card-body p-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="productName">نام مرسولات</label>
                                <input type="text" name="productName" value="{{ old('productName') }}"
                                       class="form-control @error('productName') is-invalid @enderror "
                                       id="productName" placeholder="نام مرسولات">
                                @error('productName')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="productCount">تعداد مرسوله</label>
                                <input type="text" name="productCount" value="{{ old('productCount') }}"
                                       class="form-control @error('productCount') is-invalid @enderror "
                                       id="productCount" placeholder="تعداد مرسوله">
                                @error('productCount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="productWeight">وزن مرسوله</label>
                                <input type="text" name="productWeight" value="{{ old('productWeight') }}"
                                       class="form-control @error('productWeight') is-invalid @enderror "
                                       id="productWeight" placeholder="وزن مرسوله">
                                @error('productWeight')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="productVolume">حجم مرسوله</label>
                                <input type="text" name="productVolume" value="{{ old('productVolume') }}"
                                       class="form-control @error('productVolume') is-invalid @enderror "
                                       id="productVolume" placeholder="حجم مرسوله">
                                @error('productVolume')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="submit" class="btn btn-primary btn-sm">ثبت درخواست</button>
                    </div>
                </div>


            </form>
        </div>
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

