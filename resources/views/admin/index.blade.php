@extends('admin.layout.navbar')

@section('admin.navbar')

    <div class="row gutters-sm">
        <div class="col-sm-12 mb-3 ">
            <div class="w-100 rounded h-100 ">
                <div class="col-md-3">
                    <a class="btn bg-warning  btn-warning p-3 w-100 d-flex" href="{{ route('admin.shipment.list') }}">
                        <span class="text-dark ml-auto small">لیست سفارشات</span>

                        <span class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                        <b><span class="fa fa-external-link-alt"></span></b>
                    </span>
                    </a>
                </div>

            </div>
        </div>
        <div class="col-sm-6 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="d-flex align-items-center mb-3"><b
                            class="material-icons text-info mr-2 ml-auto">{{ $clientData['AgencyName'] }}</b><span
                            class="font-13 text-secondary">اطلاعات آژانس</span></h6>
                    <div class="col-md-12 p-0">
                        <div class="w-100 mt-3">
                            <ul class="list-group list-group-flush">

                                <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                    <a class="btn p-3 d-flex w-100 btn-outline-warning"
                                       href="http://{{ $clientData['MainDomain'] }}">
                                        <span class="text-secondary small">وب سایت آژانس : </span>

                                        <span
                                            class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                                            <b>{{ $clientData['MainDomain'] }}</b>
                                        </span>
                                    </a>
                                </li>

                                <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="p-1 d-flex w-100 text-secondary">
                                        <span class="text-secondary small">مدیریت اصلی آژانس : </span>

                                        <span
                                            class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                                            <b>{{ $clientData['Manager'] }}</b>
                                        </span>
                                    </div>
                                </li>

                                <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="p-1 d-flex w-100 text-secondary">
                                        <span class="text-secondary small">تلفن تماس : </span>

                                        <span
                                            class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                                            <b>{{ $clientData['Phone'] }}</b>
                                        </span>
                                    </div>
                                </li>

                                <li class="p-0 mb-1 d-flex text-center flex-wrap">
                                    <div class="p-1 d-flex w-100 text-secondary">
                                        <span class="text-secondary min-w-50 small">آدرس : </span>

                                        <span class="p-0 mr-auto d-flex font-13 text-center flex-wrap">
                                            <b>{{ $clientData['Address'] }}</b>
                                        </span>
                                    </div>
                                </li>
                                <li class="p-0 mb-1 d-flex text-center flex-wrap">
                                    <div class="p-1 d-flex w-100 text-secondary">
                                        <span class="text-secondary d-flex min-w-50 small">درباره آژانس : </span>

                                        <span class="p-0 mr-auto d-flex font-13 text-center flex-wrap">
                                           {{ $clientData['AboutMe'] }}
                                        </span>
                                    </div>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="d-flex align-items-center mb-3"><b
                            class="material-icons text-info mr-2 ml-auto">{{ Auth::user()->name }}</b><span
                            class="font-13 text-secondary">اطلاعات نمایندگی شما</span></h6>
                    <div class="col-md-12 p-0">
                        <div class="w-100 mt-3">
                            <ul class="list-group list-group-flush">

                                <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="p-1 d-flex w-100 text-secondary">
                                        <span class="text-secondary small">مدیریت  : </span>

                                        <span
                                            class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                                            <b>{{ Auth::user()->name }}</b>
                                        </span>
                                    </div>
                                </li>

                                <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="p-1 d-flex w-100 text-secondary">
                                        <span class="text-secondary small">تلفن تماس : </span>

                                        <span
                                            class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                                            <b>{{ Auth::user()->telephone }}</b>
                                        </span>
                                    </div>
                                </li>

                                <li class="p-0 mb-1 d-flex text-center flex-wrap">
                                    <div class="p-1 d-flex w-100 text-secondary">
                                        <span class="text-secondary d-flex min-w-50 small">استان : </span>

                                        <span class="p-0 mr-auto d-flex font-13 text-center flex-wrap">
                                           {{ @json_decode(Auth::user()->agencyInfo)->location->state->name }}
                                        </span>
                                    </div>
                                </li>

                                <li class="p-0 mb-1 d-flex text-center flex-wrap">
                                    <div class="p-1 d-flex w-100 text-secondary">
                                        <span class="text-secondary d-flex min-w-50 small">شهر : </span>

                                        <span class="p-0 mr-auto d-flex font-13 text-center flex-wrap">
                                           {{ @json_decode(Auth::user()->agencyInfo)->location->city->name }}
                                        </span>
                                    </div>
                                </li>

                                <li class="p-0 mb-1 d-flex text-center flex-wrap">
                                    <div class="p-1 d-flex w-100 text-secondary">
                                        <span class="text-secondary min-w-50 small">آدرس : </span>

                                        <span class="p-0 mr-auto d-flex font-13 text-center flex-wrap">
                                            <b>{{ Auth::user()->address }}</b>
                                        </span>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
