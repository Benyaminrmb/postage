@component('admin.layouts.content' , ['title' => 'پروفایل'])

    <div class="row">
        <div class="col-12 d-flex flex-wrap">

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light"><i class="fa fa-file-signature"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">نام و نام خانوادگی</span>
                        <span class="info-box-number">
                            {{ Auth::user()->name }} {{ Auth::user()->family }}
                        </span>
                    </div>


                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <i class="fa fa-sort-numeric-down"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">کد نمایندگی</span>
                        <span class="info-box-number">
                            {{ Auth::user()->member_id }}
                        </span>
                    </div>


                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">ایمیل</span>
                        <span class="info-box-number">
                            {{ Auth::user()->email }}
                        </span>
                    </div>


                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <i class="fa fa-mobile"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">شماره همراه</span>
                        <span class="info-box-number">
                            {{ Auth::user()->mobile }}
                        </span>
                    </div>


                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <i class="fa fa-phone"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">شماره ثابت</span>
                        <span class="info-box-number">
                            {{ Auth::user()->telephone }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light">
                        <i class="fa fa-address-card"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">آدرس</span>
                        <span class="info-box-number">
                            {{ Auth::user()->address }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('profile.edit') }}"
                           class="btn font-13 btn-outline-primary btn-sm">ویرایش</a>
                    </div>
                </div>
            </div>


        </div>
    </div>




@endcomponent
