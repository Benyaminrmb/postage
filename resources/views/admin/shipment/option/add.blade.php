@component('admin.layouts.content' , ['title' => 'ویرایش پروفایل'])

    <div class="row">
        <div class="col-12 d-flex flex-wrap">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">افزودن اطلاعات مورد نیاز</h3>
                    </div>
                    <form method="post" action="{{route('admin.shipments.new.options')}}">
                        @csrf
                        <div class="card-body ">
                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="form-group">
                                        <div class="form-group">
                                            <fieldset class="checkbox-group">
                                                <legend class="checkbox-group-legend">نوع ورودی</legend>
                                                <div class="checkbox">
                                                    <label class="checkbox-wrapper">
                                                        <input name="type"
                                                               type="radio"
                                                               value="input"
                                                               onchange="shipmentTypeChange($(this))"
                                                               class="checkbox-input"/>
                                                        <span class="checkbox-tile">
                                                            <span class="checkbox-icon">
                                                                <span class="fad h3 fa-text"></span>
                                                            </span>
                                                            <span class="checkbox-label">متن</span>
                                                        </span>
                                                    </label>
                                                    <label class="checkbox-wrapper">
                                                        <input name="type"
                                                               type="radio"
                                                               value="select"
                                                               onchange="shipmentTypeChange($(this))"
                                                               class="checkbox-input"/>
                                                        <span class="checkbox-tile">
                                                            <span class="checkbox-icon">
                                                                <span class="fad h3 fa-list"></span>
                                                            </span>
                                                            <span class="checkbox-label">کمبو باکس</span>
                                                        </span>
                                                    </label>
                                                    <label class="checkbox-wrapper">
                                                        <input name="type"
                                                               type="radio"
                                                               value="checkbox"
                                                               onchange="shipmentTypeChange($(this))"
                                                               class="checkbox-input"/>
                                                        <span class="checkbox-tile">
                                                            <span class="checkbox-icon">
                                                                <span class="fad h3 fa-check"></span>
                                                            </span>
                                                            <span class="checkbox-label">بله / خیر</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div
                                        class="font-13 flex-wrap mx-auto col-md-6 d-flex justify-content-center align-items-center">
                                        <div class="form-group col-md-12">
                                            <label for="name">نام</label>
                                            <input type="text" name="name" class="form-control font-13"
                                                   id="name" placeholder="مثلا : نوع پاکت">
                                        </div>


                                        <div class="col-md-12 d-none shipmentTypeSelectBox">
                                            <div class="form-group col-md-12 p-0 baseShipmentOptionDiv">
                                                <label for="name">موارد</label>
                                                <input type="text" name="data[]" class="form-control font-13"
                                                       id="name" placeholder="مثلا : نوع پاکت">
                                                <span class="d-none closeBtn"
                                                      onclick="closeShipmentOptions($(this))">
                                                    <span class="fad fa-times-circle"></span>
                                                </span>
                                            </div>

                                            <button
                                                type="button"
                                                onclick="addShipmentOptions($(this))"
                                                class="btn btn-primary  small">+
                                            </button>
                                        </div>

                                    </div>


                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">ثبت اطلاعات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endcomponent
