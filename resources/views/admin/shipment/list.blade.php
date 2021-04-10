@component('admin.layouts.content' , ['title' => 'لیست سفارشات'])


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">لیست سفارشات</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input disabled type="text" name="table_search" class="form-control float-right"
                                   placeholder="جستجو">

                            <div class="input-group-append">
                                <button disabled type="submit" class="btn btn-default"><i class="fad fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header d-flex flex-wrap">

                    <div class="btn-group btn-sm col-lg-12 align-content-center justify-content-center" role="group"
                         aria-label="Basic example">
                        <a href="{{ route('admin.shipments.list') }}"
                           type="button" class="btn text-sm btn-light
                                        {{ request()->is('admin/shipments/list') ? 'active' : '' }}">
                            همه
                        </a>

                        <a href="{{ route('admin.shipments.list','not-approved') }}"
                           type="button" class="btn text-sm btn-light
                                        {{ request()->is('admin/shipments/list/not-approved') ? 'active' : '' }}">
                            تایید نشده
                        </a>

                        <a href="{{ route('admin.shipments.list','on-process') }}"
                           type="button" class="btn text-sm btn-light
                                        {{ request()->is('admin/shipments/list/on-process') ? 'active' : '' }}">
                            درحال پردازش
                        </a>

                        <a href="{{ route('admin.shipments.list','complate') }}"
                           type="button" class="btn text-sm btn-light
                                        {{ request()->is('admin/shipments/list/complate') ? 'active' : '' }}">
                            تکمیل شده
                        </a>

                        <a href="{{ route('admin.shipments.list','un-complate') }}"
                           type="button" class="btn text-sm btn-light
                                        {{ request()->is('admin/shipments/list/un-complate') ? 'active' : '' }}">
                            تکمیل نشده
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="d-flex justify-content-center">
                        {!! $shipments->links() !!}
                    </div>
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th scope="col">کد</th>
                            <th scope="col">نوع تحویل</th>
                            <th scope="col">نام درخواست کننده</th>
                            <th scope="col">نام خانوادگی درخواست کننده</th>
                            <th scope="col">نام محصول</th>
                            <th scope="col">عملیات</th>
                        </tr>
                        @foreach($shipments as $shipment)
                            <tr class="font-12">

                                <th scope="row">{{$shipment->id}}</th>
                                <th>{{ AdminShipmentController::deliveryTypeFaName($shipment->deliveryType) }}</th>
                                <th>{{$shipment->user->name}}</th>
                                <th>{{$shipment->user->family}}</th>
                                <td>{{ json_decode($shipment->postalInformation,true)['name'] }}</td>
                                <td>
                                    <button type="button"
                                            data-btn-shipment-list-id="{{$shipment->id}}"
                                            data-route="{{ route('admin.shipment.get') }}"
                                            onclick="openModalShipmentList($(this),'{{$shipment->id}}')"
                                            class="btn btn-sm
                                             @if($shipment->ordered_at === null)
                                            @if($shipment->seen_at === null) btn-info @endif
                                            @else
                                            @if($shipment->accessResponse === 'granted')
                                                btn-success
                                                @else
                                                btn-warning
                                            @endif
                                            @endif
                                                position-relative">
                                        <span class="detail fad fa-eye"></span>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $shipments->links() !!}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade bd-example-modal-list-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button"
                            class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer d-flex">
                    <a
                        id="externalShipmentLink"
                        data-route="{{ route('admin.shipment.detail','') }}"
                        class="btn ml-auto btn-primary btn-sm">
                        <span class="fad fa-external-link-alt"></span>
                        صفحه مرسوله
                    </a>
                    <button type="button"
                            data-name="sendShipmentOrder"
                            data-shipment-id=""
                            data-order-action="create"
                            data-create="{{ route('admin.shipment.createOrder') }}"
                            data-remove="{{ route('admin.shipment.removeOrder') }}"
                            onclick="sendShipmentOrder($(this))"
                            class="btn btn-primary btn-sm position-relative">
                        <span class="detail">ارسال درخواست</span>
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">بستن
                    </button>
                </div>
            </div>
        </div>
    </div>

@endcomponent
