<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="h5">Manage sell</div>
                </div>
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
                            <button  wire:click.prevent="addNew" class="btn btn-primary float-right"><i class="fa fa-plus-circle mr-1"></i> Add sell</button>
                            <p class="card-title">Manage your all sells</p>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-2 col-3">
                                    <input wire:model.lazy="paginate" type="number" class="form-control">

                                </div>
                                <div class="form-group col-md-2 col-6">
                                    <input wire:model.lazy="search" type="date" class="form-control" placeholder="Search by date">
                                </div>
                                <div class="form-group col-md-2 col-3">
                                    <input type="submit" class="btn btn-success" value="Filter">
                                </div>
                                <div class="form-group col-md-2 col-12 float-right">
                                    @if($selections)
                                        <div class="btn-group ml-2">
                                            <button type="button" class="btn btn-default">Bulk Actions</button>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a wire:click.prevent="confirmRemoval" class="dropdown-item" href="#">Delete Selected</a>
                                                <a wire:click.prevent="activeStatus" class="dropdown-item" href="#">Mark as Active</a>
                                                <a wire:click.prevent="inactiveStatus" class="dropdown-item" href="#">Mark as Inactive</a>

                                            </div>
                                        </div>
                                        <span wire:loading wire:target="confirmRemoval, inactiveStatus, activeStatus" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    @endif
                                    @error('selections')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                </div>
                            </div>
                            <div class="row table-responsive" wire:loading.delay.class="opacity-50" wire:target="paginate, search, FilterSerialize, selectall, selections">
                                <table class="table table-bordered table-striped text-sm">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" wire:model="selectall"></th>
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
                                        <tr @if (is_array($selections)) @if(in_array($sell->id, $selections)) class="bg-secondary" @endif @endif wire:key="row-{{ $sell->id }}">

                                            <td><input type="checkbox" value="{{ $sell->id }}" wire:model="selections"></td>
                                            <td class="text-capitalize"><a href="">{{ $sell->product->name }}</a></td>
                                            <td class="text-capitalize"><a href="">{{ $sell->category->name }}</a></td>
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
                                        <th class="text-center" colspan="12">No sell found</th>
                                    @endforelse
                                    <tr class="text-center">
                                        <th  colspan="7">Total</th>
                                        <td colspan="5">{{$data['total']}}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <th colspan="7">Paid</th>
                                        <td colspan="5">{{$data['paid']}}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <th colspan="7">Due</th>
                                        <td colspan="5">{{$data['due']}}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <th colspan="4">Date</th>
                                        <th colspan="4">Amount</th>
                                        <th colspan="4">Due</th>
                                    </tr>
                                    @php
                                        $due = 0;
                                    @endphp
                                    @foreach($payments as $payment)
                                        @php
                                        $due += $payment->amount;
                                        $due2 = $data['total']-$due;
                                        @endphp
                                    <tr class="text-center">
                                        <td colspan="4">{{$payment->created_at}}</td>
                                        <td colspan="4">{{$payment->amount}}</td>
                                        <td colspan="4">{{$due2}}</td>
                                    </tr>
                                    @endforeach
                                    <tr class="text-center">
                                        <td colspan="6">Total payment</td>
                                        <td colspan="6">{{$payments->sum('amount')}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="justify-content-center items-center row">
                                <div class="col-12"></div>
                                {{ $sells->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <p class="card-title">Add payment</p>
                        </div>
                        <form class="">
                            <div class="card-body row">
                                <div class="form-group col-md-4 col-12">
                                    <input wire:model.lazy="amount" type="text" class="form-control" id="amount" placeholder="Enter amount">
                                    @error('amount') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                </div>
                                <div class="form-group col-md-4 col-12">
                                    <input wire:model.lazy="date" type="date" class="form-control" id="date" placeholder="Enter date">
                                    @error('date') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                </div>
                                <div class="form-group col-md-4 col-2">
                                        <button wire:click.prevent="Save" type="button" class="btn btn-info" >Save<span wire:loading wire:target="Save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

@push('js')
    <script>
        window.addEventListener('show-sell-confirmation', event => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do  it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('sell_confirmed')
                }
            })
        })

        window.addEventListener('selled', event => {
            Swal.fire(
                'updated!',
                event.detail.message,
                'success'
            )
        })
    </script>
@endpush
