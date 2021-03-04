@extends('profile.layout.app')

@section('profile.index')
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-warning mb-4">
    <a class="navbar-brand" href="{{ route('admin.index') }}">پنل مدیریت</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarAdminNavDropdown" aria-controls="navbarAdminNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarAdminNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.index') }}">مدیریت</a>
            </li>
            <li class="nav-item liBadge {{ request()->is('admin/shipment/list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.shipment.list') }}">لیست سفارشات</a>
                @if($agencyShipmentsCount > 0)
                    <span class="badge badge-primary">{{$agencyShipmentsCount}}</span>
                @endif
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
    @yield('admin.navbar')
@endsection
