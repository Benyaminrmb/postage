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
                                <span class="text-secondary font-13">: تحویل مرسوله توسط شرکت از آدرس مبدا</span>
                                </div>
                            </small>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" onclick="checkStep($(this))" class="btn btn-primary btn-sm">مرحله بعدی
                        </button>
                    </div>
                </div>


                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">آدرس ها</div>
                    <div class="card-body p-2">

                        <div class="form-group">
                            <div class="form-group">
                                <label for="originAddress">آدرس مقصد</label>
                                <input type="text" name="originAddress" value="{{ old('originAddress') }}"
                                       class="w-100 form-control @error('originAddress') is-invalid @enderror "
                                       id="originAddress" placeholder="آدرس مقصد">
                                @error('originAddress')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="w-100 d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agencyState">استان</label>
                                        <select
                                            onchange="getStateCities($(this).val(),'{{ route('admin.api.state.cities') }}')"
                                            id="agencyState" name="agencyState"
                                            class="w-100 form-control font-13 simpleSelect2">
                                            <option selected>یک استان انتخاب کنید</option>
                                            @foreach($states as $state)
                                                <option
                                                    @if(json_decode(Auth::user()->agencyInfo)->location->state->id === $state['id']) selected
                                                    @endif value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agencyCity">شهر</label>
                                        <select id="agencyCity" name="agencyCity"
                                                class="form-control font-13 simpleSelect2">
                                            <option selected>یک استان انتخاب کنید</option>
                                            @foreach($cities as $city)
                                                <option
                                                    @if(json_decode(Auth::user()->agencyInfo)->location->city->id === $city['id']) selected
                                                    @endif value="{{ $city['id'] }}">{{ $city['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Long Lat On Map</span>
                                </div>
                                @php
                                    $latitude = 35.6729993;
                                    $longitude = 51.3668216;
                                @endphp

                                <div class="map"></div>
                                <div class="map"></div>




                                <input type="text" name="originLongAddress"
                                       value="{{ old('originLongAddress') }}"
                                       class="form-control @error('originLongAddress') is-invalid @enderror ">
                                @error('originLongAddress')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="text" name="originLatAddress" value="{{ old('originLatAddress') }}"
                                       class="form-control @error('originLatAddress') is-invalid @enderror ">
                                @error('originLatAddress')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group border-bottom">
                            <span class=" w-100">Destination Information</span>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="destinationAddress">Destination Address</label>
                                <input type="text" name="destinationAddress"
                                       value="{{ old('destinationAddress') }}"
                                       class="form-control @error('destinationAddress') is-invalid @enderror "
                                       id="destinationAddress" placeholder="Destination Address">
                                @error('destinationAddress')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Long Lat On Map</span>
                                </div>
                                <input type="text" name="destinationLongAddress"
                                       value="{{ old('destinationLongAddress') }}"
                                       class="form-control @error('destinationLongAddress') is-invalid @enderror ">
                                @error('destinationLongAddress')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="text" name="destinationLatAddress"
                                       value="{{ old('destinationLatAddress') }}"
                                       class="form-control @error('destinationLatAddress') is-invalid @enderror ">
                                @error('destinationLatAddress')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" onclick="checkStep($(this))" class="btn btn-primary btn-sm">Next
                        </button>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">Receiver Information</div>
                    <div class="card-body p-2">
                        <div class="form-group">
                            <label for="receiverName">Receiver Name</label>
                            <input type="text" name="receiverName" value="{{ old('receiverName') }}"
                                   class="form-control @error('receiverName') is-invalid @enderror "
                                   id="receiverName" placeholder="Receiver Name">
                            @error('receiverName')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="receiverFamily">Receiver Family</label>
                            <input type="text" name="receiverFamily" value="{{ old('receiverFamily') }}"
                                   class="form-control @error('receiverFamily') is-invalid @enderror "
                                   id="receiverFamily" placeholder="Receiver Family">
                            @error('receiverFamily')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="receiverMobile">Receiver Mobile</label>
                            <input type="text" name="receiverMobile" value="{{ old('receiverMobile') }}"
                                   class="form-control @error('receiverMobile') is-invalid @enderror "
                                   id="receiverMobile" placeholder="Receiver Mobile">
                            @error('receiverMobile')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="receiverNationalCode">Receiver National Code</label>
                            <input type="text" name="receiverNationalCode"
                                   value="{{ old('receiverNationalCode') }}"
                                   class="form-control @error('receiverNationalCode') is-invalid @enderror "
                                   id="receiverNationalCode" placeholder="Receiver National Code">
                            @error('receiverNationalCode')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" onclick="checkStep($(this))" class="btn btn-primary btn-sm">Next
                        </button>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">Delivery Vehicle</div>
                    <div class="card-body p-2">

                        <div class="form-group">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="deliveryVehicle"
                                           value="byCar" id="deliveryVehicle1" checked>
                                    Car
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="deliveryVehicle"
                                           value="byRail" id="deliveryVehicle2"> Rail
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="deliveryVehicle"
                                           value="byAir" id="deliveryVehicle3"> Airplane
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" onclick="checkStep($(this))" class="btn btn-primary btn-sm">Next
                        </button>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header p-2" onloadeddata="">Postal Information</div>
                    <div class="card-body p-2">
                        <div class="form-group">
                            <label for="productName">productName</label>
                            <input type="text" name="productName" value="{{ old('productName') }}"
                                   class="form-control @error('productName') is-invalid @enderror "
                                   id="productName" placeholder="productName">
                            @error('productName')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="productCount">Product Count</label>
                            <input type="text" name="productCount" value="{{ old('productCount') }}"
                                   class="form-control @error('productCount') is-invalid @enderror "
                                   id="productCount" placeholder="Product Count">
                            @error('productCount')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="productWeight">Product Weight</label>
                            <input type="text" name="productWeight" value="{{ old('productWeight') }}"
                                   class="form-control @error('productWeight') is-invalid @enderror "
                                   id="productWeight" placeholder="Product Weight">
                            @error('productWeight')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="productVolume">Product Volume</label>
                            <input type="text" name="productVolume" value="{{ old('productVolume') }}"
                                   class="form-control @error('productVolume') is-invalid @enderror "
                                   id="productVolume" placeholder="Product Volume">
                            @error('productVolume')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection
<script>
    var markers = [];
    var map;

    function initMap() {
        var labelIndex = 0;

        function initialize() {
            var Tehran = {lat: {{$latitude}}, lng: {{$longitude}} };
            var map = new google.maps.Map(document.getElementsByClassName('.map'), {
                zoom: 16,
                center: Tehran,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var myMarker = new google.maps.Marker({
                position: new google.maps.LatLng({{$latitude}}, {{$longitude}}),
                draggable: true
            });

            google.maps.event.addListener(map, 'click', function (event) {
                var lanlat_new = {
                    lat: parseFloat(event.latLng.lat().toFixed(3)),
                    lng: parseFloat(event.latLng.lng().toFixed(3))
                };
                addMarker(event.latLng, map);
            });
            addMarker(Tehran, map);
        }

        function addMarker(location, map) {
            clearMarkers();
            var marker = new google.maps.Marker({
                position: location,
                map: map,
            });
            markers.push(marker);

            $(document).ready(function () {
                $('#longitude').val(location.lng);
                $('#latitude').val(location.lat);
            })

        }

        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        function clearMarkers() {
            setMapOnAll(null);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    }

</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBUcxNAzDyoiTXUXpLwd1a-3jOwkQpDUs&callback=initMap"
        async defer></script>

