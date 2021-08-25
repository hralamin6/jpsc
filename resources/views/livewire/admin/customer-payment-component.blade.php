<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">sell</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <p class="card-title">Manage your all sells</p>
                            <h3 class="text-center text-primary">{{$customer->name}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-2 col-3">
                                    <input wire:model="paginate" type="number" class="form-control">
                                </div>
                                <div class="form-group col-md-2 col-8">
                                    <input wire:model="startDate" type="date" class="form-control">
                                </div>to
                                <div class="form-group col-md-2 col-8">
                                    <input wire:model="endDate" type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-1 col-3">
                                    <input wire:click.prevent="generate_pdf" type="button" class="btn btn-info" value="PDF">
                                    <span wire:loading wire:target="generate_pdf" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </div>
                                @if($data['due']>0)
                                    <div class="form-group col-md-2 col-8">
                                        <input wire:model.lazy="amount" type="text" class="form-control" id="amount" placeholder="Enter amount">
                                        @error('amount') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                    </div>
                                @endif
                                <div class="form-group col-md-2 col-4">
                                    <button wire:click.prevent="Save" type="button" class="btn btn-info" >Save<span wire:loading wire:target="Save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <div class="row table-responsive" wire:loading.delay.class="opacity-50" wire:target="paginate, search, FilterSerialize, selectall, selections">
                                <table class="table table-bordered table-striped text-sm">
                                    <thead>
                                    <tr>
                                        <th wire:click.prevent="FilterSerialize('product_id')">Product</th>
                                        <th wire:click.prevent="FilterSerialize('category_id')">Size</th>
                                        <th wire:click.prevent="FilterSerialize('quantity')">Quantity</th>
                                        <th wire:click.prevent="FilterSerialize('kg')">KG</th>
                                        <th wire:click.prevent="FilterSerialize('unit_price')">price</th>
                                        <th wire:click.prevent="FilterSerialize('total_price')">Total</th>
                                        <th wire:click.prevent="FilterSerialize('paid_price')">Paid</th>
                                        <th wire:click.prevent="FilterSerialize('due_price')">Due</th>
                                        <th wire:click.prevent="FilterSerialize('created_at')">Date</th>
                                        <th wire:click.prevent="FilterSerialize('price_status')">Paid Status</th>
                                    </tr>
                                    </thead>
                                    <div class="progress"><div class="progress-bar" style="width:{{@$data['progressBar']}}%"></div></div>
                                    <tbody>
                                    @forelse($sells->reverse() as $key=>$sell)
                                        <tr wire:key="row-{{ $sell->id }}">
                                            <td class="text-capitalize"><a href="{{route('dashboard.products')}}">{{ $sell->product->name }}</a></td>
                                            <td class="text-capitalize"><a href="{{route('dashboard.categories')}}">{{ $sell->category->name }}</a></td>
                                            <td class="text-capitalize">{{ $sell->quantity }}</td>
                                            <td class="text-capitalize">{{ $sell->kg }}</td>
                                            <td class="text-capitalize">{{ $sell->unit_price }}</td>
                                           <td class="text-capitalize">{{ $sell->total_price }}</td>
                                            <td class="text-capitalize">{{ $sell->paid_price }}</td>
                                            <td class="text-capitalize">{{ $sell->due_price }}</td>
                                            <td class="text-capitalize">{{ \Carbon\Carbon::parse($sell->created_at)->format('Y-m-d') }}</td>
                                            <td>
                                                <span class="text-capitalize badge @if($sell->price_status==='fullpaid') badge-success @elseif($sell->price_status==='subpaid') badge-warning @else badge-danger @endif ">{{ $sell->price_status }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <th class="text-center" colspan="10">No sell found</th>
                                    @endforelse
                                    <tr class="text-center">
                                        <th  colspan="4">Total</th>
                                        <td colspan="8">{{$data['total']}}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <th colspan="4">Paid</th>
                                        <td colspan="8">{{$data['paid']}}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <th colspan="4">Due</th>
                                        <td colspan="8">{{$data['due']}}</td>
                                    </tr>
                                    <tr class="text-center bg-secondary">
                                        <th colspan="2">Date</th>
                                        <th colspan="5">Amount</th>
                                        <th colspan="5">Due</th>
                                    </tr>
                                    <hr>
                                    <br>
                                    @php
                                        $due = 0;
                                    @endphp
                                    @foreach($payments->reverse() as $payment)
                                        @php
                                        $due += $payment->amount;
                                        $due2 = $data['total']-$due;
                                        @endphp
                                    <tr class="text-center">
                                        <td colspan="2">{{$payment->created_at}}</td>
                                        <td colspan="5">{{$payment->amount}}</td>
                                        <td colspan="5">{{$due2}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="justify-content-center items-center row">
                                <div class="col-12"></div>
                                {{ $payments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
