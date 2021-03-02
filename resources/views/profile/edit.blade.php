@extends('profile.layout.app')

@section('profile.index')
    <div class="row gutters-sm">
        @if(Auth::user()->userType === 'agency')
            <div class="col-md-12">
            <form method="post" action="{{route('profile.agency.update')}}">
                @csrf
                <div class="card text-dark bg-warning mb-3">
                    <div class="card-header bg-warning">شهر نمایندگی شما</div>


                    <div class="card-body  d-flex">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agencyState">استان</label>
                                <select
                                    onchange="getStateCities($(this).val(),'#agencyCity','{{ route('admin.api.state.cities') }}')"
                                    id="agencyState" name="agencyState"
                                    class="form-control font-13 simpleSelect2">
                                    <option selected>یک استان انتخاب کنید</option>
                                    @foreach($states as $state)
                                        <option
                                            @if(@json_decode(Auth::user()->agencyInfo)->location->state->id === $state['id']) selected
                                            @endif value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                                    @endforeach
                                </select>
                                <small id="agencyState" class="border border-warning form-text text-dark p-1 rounded">
                                    استان تحت پوشش نمایندگی شما
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agencyCity">شهر</label>
                                <select id="agencyCity" name="agencyCity"
                                        class="form-control font-13 simpleSelect2">
                                    <option selected>یک استان انتخاب کنید</option>
                                    @foreach($cities as $city)
                                        <option
                                            @if(@json_decode(Auth::user()->agencyInfo)->location->city->id === $city['id']) selected
                                            @endif value="{{ $city['id'] }}">{{ $city['title'] }}</option>
                                    @endforeach
                                </select>
                                <small id="agencyCity" class="border border-warning form-text text-dark p-1 rounded">
                                    شهر تحت پوشش نمایندگی شما
                                </small>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer bg-warning">
                        <button type="submit" class="btn btn-primary btn-sm">ثبت اطلاعات</button>
                    </div>
                </div>

            </form>

        </div>
        @endif
        <div class="col-md-12">
            <form method="post" action="{{route('profile.update')}}">
                @csrf
                <div class="card mb-3">
                    <div class="card-header">ایمیل</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input disabled type="email" class="form-control font-13" id="email"
                                   aria-describedby="email"
                                   value="{{ Auth::user()->email }}">
                            <small id="email" class="border border-warning form-text text-dark p-1 rounded">شما قادر به
                                ویرایش ایمیل نمیباشید</small>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">اطلاعات شخصی</div>


                    <div class="card-body">


                        <div class="form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" class="form-control font-13" id="name" placeholder="نام"
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
                            <input type="text" name="nationalCode" class="form-control font-13" id="nationalCode"
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
                                <input @if(Auth::user()->gender === 'Male') checked @endif type="radio" value="Male"
                                       id="gender" name="gender" class="custom-control-input">
                                <label class="custom-control-label" for="gender">مرد</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input @if(Auth::user()->gender === 'Female') checked @endif type="radio"
                                       value="Female" id="gender2" name="gender" class="custom-control-input">
                                <label class="custom-control-label" for="gender2">زن</label>
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

                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header" aria-describedby="passwordHelpBlock">ویرایش رمز عبور

                        <small id="passwordHelpBlock" class="form-text text-muted">
                            <span class="text-info fa fa-info"></span>
                            تغییر رمز در صورت نیاز
                        </small>
                    </div>


                    <div class="card-body">

                        {{--  <div class="form-group">
                              <label for="correctPassword">Correct Password</label>
                              <input type="password" name="correctPassword" class="form-control font-13" id="correctPassword" placeholder="Correct Password">
                          </div>--}}
                        <div class="form-group">
                            <label for="newPassword">رمز جدید</label>
                            <input type="password" name="password" class="form-control font-13" id="newPassword"
                                   placeholder="رمز جدید">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">تکرار رمز</label>
                            <input type="password" name="password_confirmation" class="form-control font-13"
                                   id="password-confirm" placeholder="تکرار رمز">
                        </div>
                        {{--<div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>--}}

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">ثبت اطلاعات</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
