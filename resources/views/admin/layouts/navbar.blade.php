<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">خانه</a>
        </li>

    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input disabled class="form-control form-control-navbar" type="search" placeholder="جستجو"
                   aria-label="Search">
            <div class="input-group-append">
                <button disabled class="btn btn-navbar" type="submit">
                    <i class="fad fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    @if(Auth::user()->userType==='agency')
        <ul class="navbar-nav mr-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fad fa-inbox"></i>
                    @if($notApprovedAgencyShipments)

                        <span class="badge badge-danger navbar-badge">{{ count($notApprovedAgencyShipments) }}</span>

                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    @if($notApprovedAgencyShipments)
                        @foreach($notApprovedAgencyShipments as $notApprovedAgencyShipment)
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.shipment.detail',$notApprovedAgencyShipment->id) }}"
                               class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img
                                        src="https://eu.ui-avatars.com/api/?background=random&name={{ str_replace(' ','-',$notApprovedAgencyShipment->user->name) }}"
                                        alt="User Avatar"
                                        class="img-size-50 ml-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            {{ $notApprovedAgencyShipment->user->name }}
                                            <span class="float-left text-sm text-danger"><i
                                                    class="fa fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">
                                            @if($notApprovedAgencyShipment->accessResponse === 'granted')
                                                <span class="text-success">تایید شده</span>
                                            @else
                                                <span class="text-warning">در انتظار تایید...</span>
                                            @endif
                                        </p>
                                        <p class="text-sm text-muted">
                                            <i class="fa fa-clock-o mr-1"></i>
                                            @if($notApprovedAgencyShipment->accessResponse === 'granted')
                                                <span class="font-13">
                                            {{ verta($notApprovedAgencyShipment->response_at)->formatDifference() }}
                                        </span>
                                            @else
                                                <span class="font-13">
                                            {{ verta($notApprovedAgencyShipment->ordered_at)->formatDifference() }}
                                        </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    @endif

                    <a href="{{ route('admin.shipments.list','not-approved') }}" class="dropdown-item dropdown-footer">مشاهده
                        همه پیام‌ها</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comment-alt-minus"></i>
                    @if($lastUnseenAgencyShipments)
                        <span class="badge badge-warning navbar-badge">{{ count($lastUnseenAgencyShipments) }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    @if($lastUnseenAgencyShipments)
                        <span
                            class="dropdown-item dropdown-header">{{ count($lastUnseenAgencyShipments) }} درخواست جدید </span>
                        @foreach($lastUnseenAgencyShipments as $lastUnseenAgencyShipments)
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.shipment.detail',$lastUnseenAgencyShipments->id) }}"
                               class="dropdown-item font-13">
                                <i class="far fa-exclamation-square ml-2"></i>
                                <span class="font-13">
                             درخواست جدید
                        </span>
                                <span class="float-left text-muted text-sm font-13">
                            {{ verta($lastUnseenAgencyShipments->created_at->timestamp)->formatDifference() }}
                        </span>
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    @endif

                    <a href="{{ route('admin.shipments.list') }}" class="dropdown-item dropdown-footer">نمایش همه</a>
                </div>
            </li>
        </ul>
    @endif
</nav>
