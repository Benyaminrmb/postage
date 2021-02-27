@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Shipment Request</div>

                    @include('layouts.notifications')

                    <div class="card-body">
                        <div class="col-md-12">


                            <form id="regForm" class="stepwizardForm" action="/action_page.php">
                                <h1>Register:</h1>
                                <!-- One "tab" for each step in the form: -->
                                <div class="tab">Name:
                                    <p><input placeholder="First name..." oninput="this.className = ''" name="fname"></p>
                                    <p><input placeholder="Last name..." oninput="this.className = ''" name="lname"></p>
                                </div>
                                <div class="tab">Contact Info:
                                    <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
                                    <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p>
                                </div>
                                <div class="tab">Birthday:
                                    <p><input placeholder="dd" oninput="this.className = ''" name="dd"></p>
                                    <p><input placeholder="mm" oninput="this.className = ''" name="nn"></p>
                                    <p><input placeholder="yyyy" oninput="this.className = ''" name="yyyy"></p>
                                </div>
                                <div class="tab">Login Info:
                                    <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
                                    <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
                                </div>
                                <div style="overflow:auto;">
                                    <div style="float:right;">
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>
                                <!-- Circles which indicates the steps of the form: -->
                                <div style="text-align:center;margin-top:40px;">
                                    <span class="step"></span>
                                    <span class="step"></span>
                                    <span class="step"></span>
                                    <span class="step"></span>
                                </div>
                            </form>


                            <form method="post" action="{{route('shipment.create')}}">
                                @csrf
                                <div class="form-group">
                                    <label class="w-100" for="gender">Delivery Type</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input checked type="radio" value="byUser" id="deliveryType"
                                               name="deliveryType"
                                               class="custom-control-input">
                                        <label class="custom-control-label" for="deliveryType">By user</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="byCompany" id="deliveryType2" name="deliveryType"
                                               class="custom-control-input">
                                        <label class="custom-control-label" for="deliveryType2">By company</label>
                                    </div>
                                </div>
                                <div class="form-group border-bottom">
                                    <span class=" w-100">Origin Information</span>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="originAddress">Origin Address</label>
                                        <input type="text" name="originAddress" value="{{ old('originAddress') }}"
                                               class="form-control @error('originAddress') is-invalid @enderror "
                                               id="originAddress" placeholder="Origin Address">
                                        @error('originAddress')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Long Lat On Map</span>
                                        </div>
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

                                <div class="form-group border-bottom">
                                    <span class=" w-100">Receiver Information</span>
                                </div>
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
                                <div class="form-group border-bottom">
                                    <span class=" w-100">Delivery Vehicle</span>
                                </div>
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

                                <div class="form-group border-bottom">
                                    <span class=" w-100">Postal Information</span>
                                </div>
                                <div class="form-group">
                                    <label for="productType">Product Type</label>
                                    <input type="text" name="productType" value="{{ old('productType') }}"
                                           class="form-control @error('productType') is-invalid @enderror "
                                           id="productType" placeholder="Product Type">
                                    @error('productType')
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

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
