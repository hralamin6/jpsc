<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">product</li>
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
                            <button  wire:click.prevent="addNew" class="btn btn-primary float-right"><i class="fa fa-plus-circle mr-1"></i> Add product</button>
                            <p class="card-title">Manage your all Products</p>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-2 col-3">
                                    <input wire:model="paginate" type="number" class="form-control">

                                </div>
                                <div class="form-group col-md-2 col-6">
                                    <input wire:model="search" type="text" class="form-control" placeholder="Search by name">
                                </div>
                                <div class="form-group col-md-2 col-3">
                                    <input wire:click.prevent="generate_pdf" type="button" class="btn btn-info" value="PDF">
                                    <span wire:loading wire:target="generate_pdf" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
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
                                <table class="table table-bordered table-striped text-sm table-fit">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" wire:model="selectall"></th>
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
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($products as $key=>$product)
                                        <tr @if (is_array($selections)) @if(in_array($product->id, $selections)) class="bg-secondary" @endif @endif wire:key="row-{{ $product->id }}">
                                            <td><input type="checkbox" value="{{ $product->id }}" wire:model="selections"></td>
                                            <td class="text-capitalize">{{ $product->name }}</td>
                                            <td class="text-capitalize">{{ $product->full_quantity }}</td>
                                            <td class="text-capitalize">{{ $product->sell_quantity }}</td>
                                            <td class="text-capitalize">{{ $product->stock_quantity }}</td>
                                            <td class="text-capitalize">{{ $product->full_kg }}</td>
                                            <td class="text-capitalize">{{ $product->sell_kg }}</td>
                                            <td class="text-capitalize">{{ $product->stock_kg }}</td>
                                            <td class="text-capitalize">{{ $product->sells()->sum('total_price')}}</td>
                                            <td class="text-capitalize">{{ $product->purchases->sum('total_price')}}</td>
                                            <td class="@if($product->sells->sum('total_price')-$product->purchases->sum('total_price')<0) text-danger @endif"><a href="">{{$product->sells->sum('total_price')-$product->purchases->sum('total_price') }}</a></td>
                                            <td><span class="text-capitalize badge {{ $product->status==='active'?'badge-success':'badge-danger' }}" href="">{{ $product->status }}</span></td><td>
                                                <a wire:click.prevent="Edit({{ $product->id }})"><i class="fa fa-edit text-pink"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <th class="text-center" colspan="13">No product found</th>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="justify-content-center items-center row">
                                <div class="col-12"></div>
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $editmode ? 'update_product' : 'create_product' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($editmode)
                                <span>Edit product</span>
                            @else
                                <span>Add New product</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" wire:model.defer="state.name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                            @if($editmode)<span>Save Changes</span>@else<span>Save</span>@endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

