@extends('profile.layout.app')

@section('profile.index')
    <div class="row gutters-sm">
        <div class="col-sm-12 mb-3">
            <div class="card h-100">
                <div class="card-body">
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
                            <tr>

                                <th scope="row">{{$shipment->id}}</th>
                                <th>{{ AdminShipmentController::deliveryTypeFaName($shipment->deliveryType) }}</th>
                                <th>{{$shipment->user->name}}</th>
                                <th>{{$shipment->user->family}}</th>
                                <td>{{ json_decode($shipment->postalInformation,true)['name'] }}</td>
                                <td>
                                    <button type="button"
                                            onclick="openModalShipmentList($(this),'{{$shipment->id}}','{{ route('admin.shipment.get') }}')"
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
                                    <div class="col-md-12 d-flex mb-3">
                                        <div class="w-100 rounded border border-warning">
                                            <div class="card border-0 h-100">
                                                <div class="card-body p-2">
                                                    <h6 class="d-flex align-items-center mb-3">
                                                        <b class="material-icons text-info mr-2 ml-auto">
                                                            کد درخواست
                                                        </b>
                                                        <span class="font-13 text-secondary">
                                                           <b>
                                                               <span class="p-1 d-flex w-100 text-secondary" data-replace="id">2</span>
                                                           </b>
                                                        </span>
                                                    </h6>
                                                    <div class="col-md-12 p-0">
                                                        <div class="w-100 mt-3">
                                                            <ul class="list-group list-group-flush">

                                                                <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                                                    <div class="p-1 d-flex w-100 text-secondary">
                                                                        <span
                                                                            class="text-secondary small">نام درخواست کننده  : </span>
                                                                        <span
                                                                            class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                                                                            <b>
                                                                                <span class="text-dark"
                                                                                      data-replace="user.name">2</span>
                                                                            </b>
                                                                        </span>
                                                                    </div>
                                                                </li>

                                                                <li class="p-0 mb-1 d-flex justify-content-between align-items-center flex-wrap">
                                                                    <div class="p-1 d-flex w-100 text-secondary">
                                                                        <span
                                                                            class="text-secondary small">تلفن درخواست کننده  : </span>
                                                                        <span
                                                                            class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                                                                            <b>
                                                                            <span class="text-dark"
                                                                                  data-replace="user.mobile">{{ Auth::user()->mobile }}</span>
                                                                            </b>
                                                                        </span>
                                                                    </div>
                                                                </li>

                                                                <li class="p-0 mb-1 d-flex text-center flex-wrap">
                                                                    <div class="p-1 d-flex w-100 text-secondary">
                                                                        <span
                                                                            class="text-secondary small">استان مبداء  : </span>
                                                                        <span
                                                                            class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                                                                            <b>
                                                                                <span class="text-dark"
                                                                                      data-replace="origin.state">2</span>
                                                                            </b>
                                                                        </span>
                                                                    </div>
                                                                </li>

                                                                <li class="p-0 mb-1 d-flex text-center flex-wrap">
                                                                    <div class="p-1 d-flex w-100 text-secondary">
                                                                        <span
                                                                            class="text-secondary small">شهر مبداء  : </span>
                                                                        <span
                                                                            class="p-0 mr-auto d-flex font-13 justify-content-between align-items-center flex-wrap">
                                                                            <b>
                                                                                <span class="text-dark"
                                                                                      data-replace="origin.city">2</span>
                                                                            </b>
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
                                    {{--<div class="col-md-12 flex-wrap d-flex">
                                        <div class="col-md-12 ">
                                            <div class="w-100 bg-warning">
                                                awdawdadd
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="w-100 bg-warning">
                                                awdawdadd
                                            </div>
                                        </div>
                                    </div>--}}
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

@endsection
