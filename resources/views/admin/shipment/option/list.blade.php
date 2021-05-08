@component('admin.layouts.content' , ['title' => 'ویرایش پروفایل'])

    <div class="row">
        <div class="col-12 d-flex flex-wrap">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title">افزودن اطلاعات مورد نیاز</h3>

                        <a href="{{ route('admin.shipments.options.new') }}"
                                class="btn mr-auto btn-primary btn-sm">جدید</a>


                    </div>

                    <div class="card-body ">
                        <div class="row">

                            <div class="col-lg-12">

                                <div
                                    class="font-13 flex-wrap mx-auto col-md-6 d-flex justify-content-center align-items-center">

                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <th scope="col">کد</th>
                                            <th scope="col">نوع</th>
                                            <th scope="col">نام</th>
                                            <th scope="col">عملیات</th>
                                        </tr>
                                        @foreach($shipmentOptions as $option)
                                            <tr class="font-12">

                                                <th scope="row">{{$option->id}}</th>
                                                <th>{{ AdminShipmentController::optionType($option->type) }}</th>
                                                <th>{{$option->name}}</th>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    data-btn-option-list-id="{{$option->id}}"
                                                                    data-route="{{ route('admin.shipment.get') }}"
                                                                    disabled
                                                                    onclick="openModalShipmentList($(this),'{{$option->id}}')"
                                                                    class="btn btn-sm  btn-default text-primary position-relative">
                                                                <span class="detail fad fa-edit"></span>
                                                            </button>
                                                            <button type="button"
                                                                    disabled
                                                                    data-btn-option-list-id="{{$option->id}}"
                                                                    data-route="{{ route('admin.shipment.get') }}"
                                                                    onclick="openModalShipmentList($(this),'{{$option->id}}')"
                                                                    class="btn btn-sm  btn-default text-danger position-relative">
                                                                <span class="detail fad fa-times-circle"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

{{--                    <div class="card-footer">--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@endcomponent
