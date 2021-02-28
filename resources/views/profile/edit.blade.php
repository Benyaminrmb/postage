@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.breadcrumb')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">edit your profile information</div>

                   @include('layouts.notifications')

                    <div class="card-body">
                        <div class="col-md-12">
                            <form method="post" action="{{route('profile.update')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input disabled type="email" class="form-control" id="email" value="{{ Auth::user()->email }}">
                                    <small id="emailHelp" class="bg-warning form-text text-dark p-1 rounded">you cant edit email</small>
                                </div>
                                <div class="form-group border-bottom">
                                    <span class=" w-100">Personal Information</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="family">Family</label>
                                    <input type="text" name="family" class="form-control" id="family" placeholder="Family" value="{{ Auth::user()->family }}">
                                </div>
                                <div class="form-group">
                                    <label for="nationalCode">National Code</label>
                                    <input type="text" name="nationalCode" class="form-control" id="nationalCode" placeholder="National Code" value="{{ Auth::user()->nationalCode }}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile" value="{{ Auth::user()->mobile }}">
                                </div>

                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" name="telephone" class="form-control" id="telephone" placeholder="telephone" value="{{ Auth::user()->telephone }}">
                                </div>
                                <div class="form-group">
                                    <label class="w-100" for="gender">Gender</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input @if(Auth::user()->gender === 'Male') checked @endif type="radio" value="Male" id="gender" name="gender" class="custom-control-input">
                                        <label class="custom-control-label" for="gender">Men</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input @if(Auth::user()->gender === 'Female') checked @endif type="radio" value="Female" id="gender2" name="gender" class="custom-control-input">
                                        <label class="custom-control-label" for="gender2">Women</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="birthday">Birth Day</label>
                                    <input type="text" name="birthday" class="form-control" id="birthday" placeholder="birthday" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control">{{ Auth::user()->address }}</textarea>
                                </div>
                                <div class="form-group border-bottom">
                                    <span class=" w-100">Update Password</span>
                                </div>
                              {{--  <div class="form-group">
                                    <label for="correctPassword">Correct Password</label>
                                    <input type="password" name="correctPassword" class="form-control" id="correctPassword" placeholder="Correct Password">
                                </div>--}}
                                <div class="form-group">
                                    <label for="newPassword">New password</label>
                                    <input type="password" name="password" class="form-control" id="newPassword" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Repeat password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Repeat Password">
                                </div>
                                {{--<div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>--}}
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
