<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">category</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <p class="card-title">{{$editmode?'Edit':'Add'}} Category</p>
                        </div>
                        <form class="">
                            <div class="card-body row">
                                <div class="form-group col-md-6 col-10">
                                    <input wire:model.lazy="name" type="text" class="form-control" id="name" placeholder="Enter Name">
                                    @error('name') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                </div>
                                <div class="form-group col-md-4 col-2">
                                    @if($editmode)
                                        <button wire:click.prevent="Update" type="button" class="btn btn-info" >Edit<span wire:loading wire:target="Update" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                                    @else
                                        <button  wire:click.prevent="Save" type="button" class="btn btn-outline-danger" >Add<span wire:loading wire:target="Save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <p class="card-title">Manage your all categories</p>
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
                                </div>
                            </div>
                            <div class="row table-responsive" wire:loading.delay.class="opacity-50" wire:target="paginate, search, FilterSerialize, selectall, selections">
                                <table class="table table-bordered table-striped text-sm">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" wire:model="selectall"></th>
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
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($categories as $key=>$category)
                                        <tr @if (is_array($selections)) @if(in_array($category->id, $selections)) class="bg-secondary" @endif @endif wire:key="row-{{ $category->id }}">
                                            <td><input type="checkbox" value="{{ $category->id }}" wire:model="selections"></td>
                                            <td class="text-capitalize"><a href="">{{ $category->name }}</a></td>
                                            <td>{{ $category->sells->count() }}</td>
                                            <td>{{ $category->purchases->count() }}</td>
                                            <td>{{ $category->sells->sum('total_price') }}</td>
                                            <td>{{ $category->purchases->sum('total_price') }}</td>
                                            <td>{{ $category->sells->sum('quantity') }}</td>
                                            <td>{{ $category->purchases->sum('quantity') }}</td>
                                            <td>{{ $category->sells->sum('kg') }}</td>
                                            <td>{{ $category->purchases->sum('kg') }}</td>
                                            <td><span class="text-capitalize badge {{ $category->status==='active'?'badge-success':'badge-danger' }}" href="">{{ $category->status }}</span></td><td>
                                                <a wire:click.prevent="Edit({{ $category->id }})"><i class="fa fa-edit text-pink"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <th class="text-center" colspan="12">No category found</th>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="justify-content-center items-center row">
                                <div class="col-12"></div>
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
