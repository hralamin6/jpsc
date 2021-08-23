<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard v2</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
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
                        <div class="card-header">
                            <p class="card-title">Category</p>
                        </div>
                        <form class="">
                            <div class="card-body row">
                                <div class="form-group col-md-5 col-12">
                                    <input wire:model.lazy="startDate" type="date" class="form-control">
                                    @error('startDate') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                </div>
                                <div class="form-group col-md-5 col-12">
                                    <input wire:model.lazy="endDate" type="date" class="form-control">
                                    @error('endDate') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                </div>
                                <div class="form-group col-md-2 col-2">
                                    <button wire:click.prevent="Search" type="button" class="btn btn-info" >Search<span wire:loading wire:target="Update" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Customers</span><span class="info-box-number">{{$customers->count()}}</span></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users-slash"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Sellers</span><span class="info-box-number">{{$sellers->count()}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Sells</span><span class="info-box-number">{{$sells->count()}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cart-plus "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Purchases</span><span class="info-box-number">{{$purchases->count()}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-sort-amount-up "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total Quantity</span><span class="info-box-number">{{$products->sum('full_quantity')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sort-amount-down "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Sell Quantity</span><span class="info-box-number">{{$products->sum('sell_quantity')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-list-alt "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Stock Quantity</span><span class="info-box-number">{{$products->sum('stock_quantity')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clipboard-list "></i></span>
                        <div class="info-box-content"><span class="info-box-text">L/P Quantity</span><span class="info-box-number">{{($products->sum('sell_quantity')+$products->sum('stock_quantity'))-$products->sum('full_quantity')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-sort-amount-up "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total KG</span><span class="info-box-number">{{$products->sum('full_kg')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sort-amount-down "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Sell KG</span><span class="info-box-number">{{$products->sum('sell_kg')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-list-alt "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Stock KG</span><span class="info-box-number">{{$products->sum('stock_kg')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clipboard-list "></i></span>
                        <div class="info-box-content"><span class="info-box-text">L/P KG</span><span class="info-box-number">{{($products->sum('sell_kg')+$products->sum('stock_kg'))-$products->sum('full_kg')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-money-bill"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total Sell</span><span class="info-box-number">{{$sells->sum('total_price')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total Paid</span><span class="info-box-number">{{$sells->sum('paid_price')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-check "></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total Due</span><span class="info-box-number">{{$sells->sum('due_price')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-bitcoin"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total Purchase</span><span class="info-box-number">{{$purchases->sum('total_price')}}</span></div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fab fa-bitcoin"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Profit</span><span class="info-box-number">{{$sells->sum('total_price')-$purchases->sum('total_price')}}</span></div>
                    </div>
                </div>

            </div>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
