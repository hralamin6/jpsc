<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{__('Dashboard') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form class="">
                            <div class="card-body row">
                                <div class="form-group col-md-6 col-6">
                                    <input wire:model="startDate" type="date" class="form-control">
                                    @error('startDate') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                </div>
                                <div class="form-group col-md-6 col-6">
                                    <input wire:model="endDate" type="date" class="form-control">
                                    @error('endDate') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content"><span class="info-box-text">{{__('Customers') }}</span><span class="info-box-number">{{$customers->count()}}</span></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users-slash"></i></span>
                        <div class="info-box-content"><span class="info-box-text">{{__('Sellers')}}</span><span class="info-box-number">{{$sellers->count()}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart "></i></span>
                        <div class="info-box-content"><span class="info-box-text">{{__('Sells')}}</span><span class="info-box-number">{{$sells->count()}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cart-plus "></i></span>
                        <div class="info-box-content"><span class="info-box-text">{{__('Purchases')}}</span><span class="info-box-number">{{$purchases->count()}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-sort-amount-up "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total {{__('Quantity')}}</span><span class="info-box-number">{{$products->sum('full_quantity')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sort-amount-down "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Sell {{__('Quantity')}}</span><span class="info-box-number">{{$products->sum('sell_quantity')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-list-alt "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Stock {{__('Quantity')}}</span><span class="info-box-number">{{$products->sum('stock_quantity')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clipboard-list "></i></span>
                        <div class="info-box-content"><span class="info-box-text">L/P {{__('Quantity')}}</span><span class="info-box-number">{{($products->sum('sell_quantity')+$products->sum('stock_quantity'))-$products->sum('full_quantity')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-sort-amount-up "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total {{__('KG')}}</span><span class="info-box-number">{{$products->sum('full_kg')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sort-amount-down "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Sell {{__('KG')}}</span><span class="info-box-number">{{$products->sum('sell_kg')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-list-alt "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Stock {{__('KG')}}</span><span class="info-box-number">{{$products->sum('stock_kg')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clipboard-list "></i></span>
                        <div class="info-box-content"><span class="info-box-text">L/P {{__('KG')}}</span><span class="info-box-number">{{($products->sum('sell_kg')+$products->sum('stock_kg'))-$products->sum('full_kg')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-money-bill"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total {{__('Sell')}}</span><span class="info-box-number">{{$sells->sum('total_price')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total {{__('Paid')}}</span><span class="info-box-number">{{$sells->sum('paid_price')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-check "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total {{__('Due')}}</span><span class="info-box-number">{{$sells->sum('due_price')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-bitcoin"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total {{__('Purchase')}}</span><span class="info-box-number">{{$purchases->sum('total_price')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fab fa-bitcoin"></i></span>
                        <div class="info-box-content"><span class="info-box-text">{{__('Profit')}}</span><span class="info-box-number">{{$sells->sum('total_price')-$purchases->sum('total_price')}}</span></div>
                    </div>
                </div>

            </div>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
