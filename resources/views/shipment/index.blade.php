@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        <a href="{{ route('shipment.new') }}" class="btn btn-outline-primary">new Request</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
