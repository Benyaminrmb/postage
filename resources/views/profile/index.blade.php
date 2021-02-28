@extends('profile.layout.app')

@section('profile.index')

    <div class="w-100 position-sticky-16">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">نام و نام خانوادگی</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{Auth::user()->name}} {{Auth::user()->family}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">ایمیل</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{Auth::user()->email}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">شماره تماس</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{Auth::user()->telephone}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">شماره همراه</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{Auth::user()->mobile}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">آدرس</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{Auth::user()->address}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('profile.edit') }}"
                   class="btn font-13 btn-outline-primary btn-sm">ویرایش</a>
            </div>
        </div>
    </div>
@endsection
