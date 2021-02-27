@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">edit profile</a>
                        <a href="{{ route('shipment') }}" class="btn btn-outline-primary">Shipment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
