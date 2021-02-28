@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                {{--<th scope="col">کد</th>
                                <th scope="col">نوع تحویل</th>
                                <th scope="col">آدرس مبداء</th>
                                <th scope="col">آدرس مقصد</th>
                                <th scope="col">نام درخواست کننده</th>
                                <th scope="col">نام خانوادگی درخواست کننده</th>
                                <th scope="col">شماره تماس درخواست کننده</th>
                                <th scope="col">کد ملی درخواست کننده</th>
                                <th scope="col">نام تحویل گیرنده</th>
                                <th scope="col">نام خانوادگی تحویل گیرنده</th>
                                <th scope="col">شماره تماس تحویل گیرنده</th>
                                <th scope="col">کد ملی تحویل گیرنده</th>
                                <th scope="col">نوع محصول</th>
                                <th scope="col">تعداد مرسولات</th>
                                <th scope="col">وزن مرسوله</th>
                                <th scope="col">حجم مرسوله</th>--}}


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
                                <tr>

                                    <th scope="row">{{$shipment->id}}</th>
                                    <th>{{ AdminShipmentController::deliveryTypeFaName($shipment->deliveryType) }}</th>
                                    <th>{{$shipment->user->name}}</th>
                                    <th>{{$shipment->user->family}}</th>
                                    <td>{{ json_decode($shipment->postalInformation,true)['name'] }}</td>
                                    <td>
                                        <button type="button" onclick="openModalShipmentList($(this),'{{$shipment->id}}','{{ route('admin.shipment.get') }}')"
                                                class="btn btn-sm btn-primary">
                                            <span class="detail fa fa-eye"></span>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>


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
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
