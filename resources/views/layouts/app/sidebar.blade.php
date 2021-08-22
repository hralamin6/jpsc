<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link {{Request::is('dashboard')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.sells') }}" class="nav-link {{Request::is('dashboard/sells')?'active':''}}">
                        <i class="nav-icon fab fa-sellsy"></i><p>Sells</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.purchases') }}" class="nav-link {{Request::is('dashboard/purchases')?'active':''}}">
                        <i class="nav-icon fas fa-procedures"></i><p>Purchase</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.products') }}" class="nav-link {{Request::is('dashboard/products')?'active':''}}">
                        <i class="nav-icon fab fa-product-hunt"></i><p>Products</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.categories') }}" class="nav-link {{Request::is('dashboard/categories')?'active':''}}">
                        <i class="nav-icon fas fa-list"></i><p>Categories</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.customers') }}" class="nav-link {{Request::is('dashboard/customers')?'active':''}}">
                        <i class="nav-icon fas fa-users"></i><p>Customers</p></a></li>
                <li class="nav-item"><a href="{{ route('dashboard.sellers') }}" class="nav-link {{Request::is('dashboard/sellers')?'active':''}}">
                        <i class="nav-icon fas fa-users-slash"></i><p>Sellers</p></a></li>
            </ul>
        </nav>
    </div>
</aside>
