<nav id="navbarId" class="main-header navbar navbar-expand @if (Session::has('nightMode')) navbar-dark @else navbar-light @endif">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">{{__('Shop') }}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();this.closest('form').submit();">{{ __('Logout') }}</a>
            </form>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

{{--        <li class="nav-item dropdown">--}}
{{--            <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--                <i class="fa fa-language"></i>--}}
{{--                <span class="badge badge-warning navbar-badge">Bn</span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right w-25">--}}
{{--                <a href="#" class="dropdown-item"><i class="fas fa-sign-language mr-2"></i>Bangla</a>--}}
{{--                <a href="#" class="dropdown-item"><i class="fas fa-sign-language mr-2"></i>English</a>--}}
{{--            </div>--}}
{{--        </li>--}}
        <li class="nav-item"><a class="nav-link" wire:click.prevent="ChangeLang">{{session()->get('locale')=='en'?'BN':'EN'}}</a></li>

        <li class="nav-item"><a class="nav-link {{Request::is('/')?'text-primary':''}}" href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i></a></li>

        <li class="nav-item"><a class="nav-link {{Request::is('categories')?'text-primary':''}}" href="{{route('dashboard.categories')}}"><i class="fas fa-list"></i></a></li>
        <li class="nav-item"><a class="nav-link {{Request::is('customers')?'text-primary':''}}" href="{{route('dashboard.customers')}}"><i class="fas fa-users"></i></a></li>
        <li class="nav-item"><a class="nav-link {{Request::is('sellers')?'text-primary':''}}" href="{{route('dashboard.sellers')}}"><i class="fas fa-users-slash"></i></a></li>
        <li class="nav-item"><a class="nav-link {{Request::is('products')?'text-primary':''}}" href="{{route('dashboard.products')}}"><i class="fab fa-product-hunt"></i></a></li>
        <li class="nav-item"><a class="nav-link {{Request::is('purchases')?'text-primary':''}}" href="{{route('dashboard.purchases')}}"><i class="fas fa-cart-plus"></i></a></li>
        <li class="nav-item"><a class="nav-link {{Request::is('sells')?'text-primary':''}}" href="{{route('dashboard.sells')}}"><i class="fas fa-shopping-cart"></i></a></li>
        <li class="nav-item"><a class="nav-link {{Request::is('setup')?'text-primary':''}}" href="{{route('dashboard.setup')}}"><i class="fas fa-cogs"></i></a></li>
        <li class="nav-item"><a class="nav-link {{Request::is('profile')?'text-primary':''}}" href="{{route('dashboard.profile')}}"><i class="fas fa-user"></i></a></li>
    </ul>
</nav>
