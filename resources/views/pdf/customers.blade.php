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
                            <h5 style="color: deepskyblue; padding-top: 5px;" class="card-title">All customers</h5>
                        </center>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th wire:click.prevent="FilterSerialize('name')">{{__('Name')}}</th>
                                    <th wire:click.prevent="FilterSerialize('due_amount')">{{__('Due')}}</th>
                                    <th wire:click.prevent="FilterSerialize('phone')">{{__('Phone')}}</th>
                                    <th>{{__('Purchases')}}</th>
                                    <th>{{__('Total')}} {{__('Price')}}</th>
                                    <th>{{__('Paid')}} {{__('Price')}}</th>
                                    <th>{{__('Total')}} {{__('Quantity')}}</th>
                                    <th>{{__('Total')}} {{__('KG')}}</th>
                                    <th wire:click.prevent="FilterSerialize('address')">{{__('Address')}}</th>
                                    <th wire:click.prevent="FilterSerialize('status')">{{__('Status')}}</th>
                                </tr>
                                </thead>
                                <div class="progress"><div class="progress-bar" style="width:{{@$data['progressBar']}}%"></div></div>
                                <tbody>
                                @forelse($customers->reverse() as $key=>$customer)
                                    <tr  wire:key="row-{{ $customer->id }}">
                                        <td class="text-capitalize"><a href="{{route('dashboard.customer.payment', $customer->id)}}">{{ $customer->name }}</a></td>
                                        <td>{{ $customer->due_amount }}</td>
                                        <td><a href="tel:{{ $customer->phone }}">{{ $customer->phone }}</a></td>
                                        <td>{{ $customer->sells->count() }}</td>
                                        <td>{{ $customer->sells->sum('total_price') }}</td>
                                        <td>{{ $customer->sells->sum('paid_price') }}</td>
                                        <td>{{ $customer->sells->sum('quantity') }}</td>
                                        <td>{{ $customer->sells->sum('kg') }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td><span class="text-capitalize" style="{{ $customer->status=='active'?'color:green':'color:red'}}">{{ $customer ->status }}</span></td>
                                    </tr>
                                @empty
                                    <th class="text-center" colspan="10">No customers found</th>
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
