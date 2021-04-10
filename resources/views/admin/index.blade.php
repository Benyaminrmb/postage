@component('admin.layouts.content' , ['title' => 'پنل مدیریت'])
    {{--@slot('breadcrumb')
        <li class="breadcrumb-item active">پنل مدیریت</li>
    @endslot--}}

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ count($unComplateAgencyShipments) }}</h3>

                    <p>سفارش های تمام نشده</p>
                </div>
                <div class="icon">
                    <i class="fad fa-bell-on"></i>
                </div>
                <a href="{{ route('admin.shipments.list','un-complate') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>



        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        {{ count($onProcessAgencyShipments) }}
                    </h3>

                    <p>در حال پردازش
                    <span class="font-13">( در صف انجام )</span></p>
                </div>
                <div class="icon">
                    <i class="fad fa-pause-circle"></i>
                </div>
                <a href="{{ route('admin.shipments.list','on-process') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>
                        {{ count($complateAgencyShipments) }}
                    </h3>

                    <p>سفارش های تمام شده</p>
                </div>
                <div class="icon">
                    <i class="fad fa-ballot-check"></i>
                </div>
                <a href="{{ route('admin.shipments.list','complate') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                        {{ $usersCount }}
                    </h3>

                    <p>تعداد کاربران</p>
                </div>
                <div class="icon">
                    <i class="fad fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>


@endcomponent
