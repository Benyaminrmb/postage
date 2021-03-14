@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
        @include('layouts.breadcrumb')

        <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="mt-3">
                                    <h4 class="h5 mb-4">{{Auth::user()->name}} {{Auth::user()->family}}</h4>
                                    <div class="w-100">

                                        <p class="text-secondary mb-1 font-13">آدرس : {{Auth::user()->address}}</p>
                                        <p class="text-muted font-size-sm mb-2 font-13">تعداد سفارش های به ثبت رسیده شما
                                            : {{ print_r(Auth::user()->shipments_count)}} </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 mt-3">
                        <ul class="list-group list-group-flush">
                            @if(Auth::user()->userType === 'agency')
                                <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                    <a class="btn p-3 d-flex w-100 btn-outline-warning"
                                       href="{{ route('admin.index') }}">
                                        <h6 class="mb-0 ml-auto">
                                            <span class="fa fa-code-branch"></span>
                                            پنل مدیریت
                                        </h6>
                                        <span class="text-secondary small">
                                            تعداد سفارشات 24 ساعت گذشته
                                            <span class="badge p-1 badge-secondary">
                                                {{ $agencyShipmentsCount }}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            @endif
                            <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                <a class="btn p-3 d-flex w-100 btn-outline-primary" href="{{ route('profile.edit') }}">
                                    <h6 class="mb-0 ml-auto">
                                        <span class="fa fa-user"></span>
                                        پروفایل
                                    </h6>
                                    <span class="text-secondary small">مشاهده پروفایل شما</span>
                                </a>
                            </li>
                            <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                <a class="btn p-3 d-flex w-100 btn-outline-primary" href="{{ route('home') }}">
                                    <h6 class="mb-0 ml-auto">
                                        <span class="fa fa-archive"></span>
                                        سوابق
                                    </h6>
                                    <span class="text-secondary small">درخواست های پیشین شما</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    @include('layouts.notifications')

                    @yield('profile.index')
                </div>

            </div>
        </div>
    </div>
@endsection
