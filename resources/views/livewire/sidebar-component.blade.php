@php
    $setup = \App\Models\Setup::where('status', 'active')->first();
@endphp
<aside id="sidebarId" class="main-sidebar @if (Session::has('nightMode')) sidebar-dark-primary @else sidebar-light-primary @endif elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{$setup->logo}}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{$setup->site_name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{auth()->user()->profile_photo_path}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
{{--        <div class="form-inline">--}}
{{--            <div class="input-group" data-widget="sidebar-search">--}}
{{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-sidebar">--}}
{{--                        <i class="fas fa-search fa-fw"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link {{Request::is('/')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>{{__('Dashboard') }}</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.sells') }}" class="nav-link {{Request::is('sells')?'active':''}}">
                        <i class="nav-icon fas fa-shopping-cart"></i><p>{{__('Sells')}}</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.purchases') }}" class="nav-link {{Request::is('purchases')?'active':''}}">
                        <i class="nav-icon fas fa-cart-plus"></i><p>{{__('Purchases')}}</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.products') }}" class="nav-link {{Request::is('products')?'active':''}}">
                        <i class="nav-icon fab fa-product-hunt"></i><p>{{__('Products')}}</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.categories') }}" class="nav-link {{Request::is('categories')?'active':''}}">
                        <i class="nav-icon fas fa-list"></i><p>{{__('Categories')}}</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.customers') }}" class="nav-link {{Request::is('customers')?'active':''}}">
                        <i class="nav-icon fas fa-users"></i><p>{{__('Customers')}}</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.sellers') }}" class="nav-link {{Request::is('sellers')?'active':''}}">
                        <i class="nav-icon fas fa-users-slash"></i><p>{{__('Sellers')}}</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.setup') }}" class="nav-link {{Request::is('setup')?'active':''}}">
                        <i class="nav-icon fas fa-cogs"></i><p>{{__('Settings')}}</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.profile') }}" class="nav-link {{Request::is('profile')?'active':''}}">
                        <i class="nav-icon fas fa-user"></i><p>{{__('Profile')}}</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.admins') }}" class="nav-link {{Request::is('admins')?'active':''}}">
                        <i class="nav-icon fas fa-users-cog"></i><p>{{__('Admins')}}</p></a></li>
            </ul>
        </nav>
    </div>
</aside>
