@component('admin.layouts.content' , ['title' => 'ویرایش شهر نمایندگی'])
    <div class="row">
        <div class="col-12 d-flex flex-wrap">
            <div class="col-md-12 ">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ویرایش شهر نمایندگی</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('profile.agency.update')}}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="agencyState">استان</label>
                                        <select
                                            onchange="getStateCities($(this).val(),'#agencyCity','{{ route('gds.api.state.cities') }}')"
                                            id="agencyState" name="agencyState"
                                            class="form-control font-13 simpleSelect2">
                                            <option selected>یک استان انتخاب کنید</option>
                                            @foreach($states as $state)
                                                <option
                                                    @if(@json_decode(Auth::user()->agencyInfo)->location->state->id === $state['id']) selected
                                                    @endif value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                                            @endforeach
                                        </select>
                                        <small id="agencyState"
                                               class="form-text text-dark p-1 rounded">
                                            استان تحت پوشش نمایندگی شما
                                        </small>
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                        <small id="agencyCity"
                                               class="form-text text-dark p-1 rounded">
                                            شهر تحت پوشش نمایندگی شما
                                        </small>
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
