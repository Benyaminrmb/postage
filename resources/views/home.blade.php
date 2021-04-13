@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="menu_img">
                <a href="{{ route('shipment.new') }}">
                    <img src="/img/menu1.jpg" alt="">
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
