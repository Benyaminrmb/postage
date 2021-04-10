@component('admin.layouts.content' , ['title' => 'ویرایش پروفایل'])

    <div class="row">
        <div class="col-12 d-flex flex-wrap">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ویرایش پروفایل</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('profile.update')}}">
                        @csrf
                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="text" name="name" class="form-control font-13" id="name"
                                               placeholder="نام"
                                               value="{{ Auth::user()->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="family">نام خانوادگی</label>
                                        <input type="text" name="family" class="form-control font-13" id="family"
                                               placeholder="نام خانوادگی"
                                               value="{{ Auth::user()->family }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nationalCode">کد ملی</label>
                                        <input type="text" name="nationalCode" class="form-control font-13"
                                               id="nationalCode"
                                               placeholder="کد ملی" value="{{ Auth::user()->nationalCode }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">تلفن همراه</label>
                                        <input type="text" name="mobile" class="form-control font-13" id="mobile"
                                               placeholder="تلفن همراه"
                                               value="{{ Auth::user()->mobile }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="telephone">تلفن</label>
                                        <input type="text" name="telephone" class="form-control font-13" id="telephone"
                                               placeholder="تلفن" value="{{ Auth::user()->telephone }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="w-100" for="gender">جنسیت</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input @if(Auth::user()->gender === 'Male') checked @endif type="radio"
                                                   value="Male"
                                                   id="gender" name="gender" class="custom-control-input">
                                            <label class="custom-control-label pr-4" for="gender">مرد</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input @if(Auth::user()->gender === 'Female') checked @endif type="radio"
                                                   value="Female" id="gender2" name="gender"
                                                   class="custom-control-input">
                                            <label class="custom-control-label pr-4" for="gender2">زن</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="birthday">تاریخ تولد</label>
                                        <input type="text" name="birthday" class="form-control font-13" id="birthday"
                                               placeholder="تاریخ تولد" value="{{ Auth::user()->birthday }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">آدرس</label>
                                        <textarea name="address" placeholder="آدرس" id="address"
                                                  class="form-control font-13">{{ Auth::user()->address }}</textarea>
                                    </div>


                                    <div class="form-group">
                                        <label for="newPassword">رمز جدید</label>
                                        <input type="password" name="password" class="form-control font-13"
                                               id="newPassword"
                                               placeholder="رمز جدید">
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">تکرار رمز</label>
                                        <input type="password" name="password_confirmation" class="form-control font-13"
                                               id="password-confirm" placeholder="تکرار رمز">
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
