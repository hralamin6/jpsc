@include('pdf.master')
<body>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header" style="text-align: center">
                        <center>
                            <img src="{{$setup->logo}}" style="width: 77px; max-height: 77px; border-radius: 50%">
                            <h6><span>{{$setup->site_name}}</span></h6>
                            <div>Owner: <span>{{$setup->admin}}</span></div>
                            <div>Email: <a href="mailto:{{$setup->email}}">{{$setup->email}}</a></div>
                            <div>Phone: <a href="tel:{{$setup->phone}}">{{$setup->phone}}</a></div>
                            <h5 style="color: deepskyblue; padding-top: 5px;" class="card-title">All products</h5>
                        </center>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th wire:click.prevent="FilterSerialize('name')">Name</th>
                                    <th wire:click.prevent="FilterSerialize('full_quantity')">Full Q</th>
                                    <th wire:click.prevent="FilterSerialize('sell_quantity')">Sell Q</th>
                                    <th wire:click.prevent="FilterSerialize('stock_quantity')">Stock Q</th>
                                    <th wire:click.prevent="FilterSerialize('full_kg')">Full Kg</th>
                                    <th wire:click.prevent="FilterSerialize('sell_kg')">Sell Kg</th>
                                    <th wire:click.prevent="FilterSerialize('stock_kg')">Stock Kg</th>
                                    <th>Full Sell</th>
                                    <th>Full Buy</th>
                                    <th>Earn</th>
                                    <th wire:click.prevent="FilterSerialize('status')">Status</th>
                                </tr>
                                </thead>
                                <div class="progress"><div class="progress-bar" style="width:{{@$data['progressBar']}}%"></div></div>
                                <tbody>
                                @forelse($products->reverse() as $key=>$product)
                                    <tr  wire:key="row-{{ $product->id }}">
                                        <td class="text-capitalize"><a href="{{route('dashboard.products')}}">{{ $product->name }}</a></td>
                                        <td class="text-capitalize">{{ $product->full_quantity }}</td>
                                        <td class="text-capitalize">{{ $product->sell_quantity }}</td>
                                        <td class="text-capitalize">{{ $product->stock_quantity }}</td>
                                        <td class="text-capitalize">{{ $product->full_kg }}</td>
                                        <td class="text-capitalize">{{ $product->sell_kg }}</td>
                                        <td class="text-capitalize">{{ $product->stock_kg }}</td>
                                        <td class="text-capitalize">{{ $product->sells()->sum('total_price')}}</td>
                                        <td class="text-capitalize">{{ $product->purchases->sum('total_price')}}</td>
                                        <td class="@if($product->sells->sum('total_price')-$product->purchases->sum('total_price')<0) text-danger @endif"><a href="">{{$product->sells->sum('total_price')-$product->purchases->sum('total_price') }}</a></td>
                                        <td><span class="text-capitalize" style="{{ $product->status=='active'?'color:green':'color:red'}}">{{ $product ->status }}</span></td>
                                    </tr>
                                @empty
                                    <th class="text-center" colspan="11">No products found</th>
                                @endforelse
                                </tbody>
                            </table>
                            <h5>Signature:</h5>
                            <div>Date: <span>{{ date('d.m.Y H:i:s')}}</span></div>
                            <div>Location: <span>{{$setup->location}}</span></div>
                            <div>Website: <a href="{{$setup->site_url}}">{{$setup->site_url}}</a></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
