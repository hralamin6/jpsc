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
                            <h5 style="color: deepskyblue; padding-top: 5px;" class="card-title">All categories</h5>
                        </center>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th wire:click.prevent="FilterSerialize('name')">Name</th>
                                    <th>Purchases</th>
                                    <th>Sells</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Buying Quantity</th>
                                    <th>Selling Quantity</th>
                                    <th>Buying Kg</th>
                                    <th>Selling Kg</th>
                                    <th wire:click.prevent="FilterSerialize('status')">Status</th>
                                </tr>
                                </thead>
                                <div class="progress"><div class="progress-bar" style="width:{{@$data['progressBar']}}%"></div></div>
                                <tbody>
                                @forelse($categories->reverse() as $key=>$category)
                                    <tr  wire:key="row-{{ $category->id }}">
                                        <td class="text-capitalize"><a href="{{route('dashboard.categories')}}">{{ $category->name }}</a></td>
                                        <td>{{ $category->sells->count() }}</td>
                                        <td>{{ $category->purchases->count() }}</td>
                                        <td>{{ $category->sells->sum('total_price') }}</td>
                                        <td>{{ $category->purchases->sum('total_price') }}</td>
                                        <td>{{ $category->sells->sum('quantity') }}</td>
                                        <td>{{ $category->purchases->sum('quantity') }}</td>
                                        <td>{{ $category->sells->sum('kg') }}</td>
                                        <td>{{ $category->purchases->sum('kg') }}</td>
                                        <td><span class="text-capitalize" style="{{ $category->status=='active'?'color:green':'color:red'}}">{{ $category ->status }}</span></td>
                                    </tr>
                                @empty
                                    <th class="text-center" colspan="10">No categories found</th>
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
