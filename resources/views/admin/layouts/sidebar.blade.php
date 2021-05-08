<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('profile.index') }}" class="brand-link">
        <img src="https://eu.ui-avatars.com/api/?background=random&name={{ str_replace(' ','-',Auth::user()->name) }}"
             alt="{{ Auth::user()->name }}" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پیشخوان</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img
                        src="https://eu.ui-avatars.com/api/?background=random&name={{ str_replace(' ','-',Auth::user()->name) }}"
                        class="img-circle elevation-2"
                        alt="{{ Auth::user()->name }}">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @if(Auth::user()->userType==='agency')
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}"
                               class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                                <i class="nav-icon fad fa-star-shooting"></i>
                                <p>
                                    داشبورد
                                </p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('panel.index') }}"
                           class="nav-link {{ request()->routeIs('panel.index') ? 'active' : '' }}">
                            <i class="nav-icon fad fa-meteor"></i>
                            <p>
                                پیشخوان
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}
                        {{ request()->routeIs('profile.agency.edit.state') ? 'active' : '' }}
                        {{ request()->routeIs('profile.edit') ? 'active' : '' }}
                        {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                            <i class="nav-icon fad fa-id-badge"></i>
                            <p>
                                پروفایل
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}"
                                   class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                                    <i class="nav-icon fad fa-id-badge"></i>
                                    <p>مشاهده پروفایل</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.edit') }}"
                                   class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                    <i class="nav-icon fad fa-user-edit"></i>
                                    <p>ویرایش پروفایل</p>
                                </a>
                            </li>
                            @if(Auth::user()->userType==='agency')
                                <li class="nav-item">
                                    <a href="{{ route('profile.agency.edit.state') }}"
                                       class="nav-link {{ request()->routeIs('profile.agency.edit.state') ? 'active' : '' }}">
                                        <i class="nav-icon fad fa-globe-asia"></i>
                                        <p> شهر نمایندگی</p>
                                        @if(!json_decode(Auth::user()->agencyInfo))
                                            <span class="right badge badge-danger">پیش نیاز</span>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                    @if(Auth::user()->userType==='agency')
                        <li class="nav-item has-treeview ">
                            <a class="nav-link">
                                <i class="nav-icon fad fa-clipboard-list"></i>
                                <p>
                                    سفارشات
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.shipments.new.options') }}"
                                       class="nav-link {{ request()->routeIs('admin.shipments.new.options') ? 'active' : '' }}">
                                        <i class="fad fa-th-list"></i>
                                        <p>گذینه مورد نیاز مرسوله</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.shipments.list') }}"
                                       class="nav-link {{ request()->routeIs('admin.shipments.list') ? 'active' : '' }}">
                                        <i class="fad fa-th-list"></i>
                                        <p>لیست سفارشات</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
