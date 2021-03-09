@extends('admin.layout.navbar')

@section('admin.navbar')
    <div class="row gutters-sm">
        <div class="col-sm-12 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        {!! $shipments->links() !!}
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">کد</th>
                            <th scope="col">نوع تحویل</th>
                            <th scope="col">نام درخواست کننده</th>
                            <th scope="col">نام خانوادگی درخواست کننده</th>
                            <th scope="col">نام محصول</th>
                            <th scope="col">عملیات</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shipments as $shipment)
                            <tr class="font-12">

                                <th scope="row">{{$shipment->id}}</th>
                                <th>{{ AdminShipmentController::deliveryTypeFaName($shipment->deliveryType) }}</th>
                                <th>{{$shipment->user->name}}</th>
                                <th>{{$shipment->user->family}}</th>
                                <td>{{ json_decode($shipment->postalInformation,true)['name'] }}</td>
                                <td>
                                    <button type="button"
                                            onclick="openModalShipmentList($(this),'{{$shipment->id}}','{{ route('admin.shipment.get') }}')"
                                            class="btn btn-sm
                                             @if($shipment->ordered_at === null)
                                                btn-info
                                            @else
                                            @if($shipment->accessResponse === null)
                                                btn-success
                                                @else
                                                btn-warning
                                            @endif
                                            @endif
                                             position-relative">
                                        <span class="detail fa fa-eye"></span>
                                    </button>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $shipments->links() !!}
                    </div>
                    <div class="modal fade bd-example-modal-list-lg" tabindex="-1" role="dialog"
                         aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                            data-name="sendShipmentOrder"
                                            data-shipment-id=""
                                            data-order-action="create"
                                            data-create="{{ route('admin.shipment.createOrder') }}"
                                            data-remove="{{ route('admin.shipment.removeOrder') }}"
                                            onclick="sendShipmentOrder($(this))"
                                            class="btn btn-primary btn-sm">ارسال درخواست</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">بستن</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
