<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">admin</li>
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
                            <button  wire:click.prevent="addNew" class="btn btn-primary float-right"><i class="fa fa-plus-circle mr-1"></i> Add admin</button>
                            <p class="card-title">Manage your all admins</p>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-2 col-3">
                                    <input wire:model.lazy="paginate" type="number" class="form-control">

                                </div>
                                <div class="form-group col-md-2 col-6">
                                    <input wire:model.lazy="search" type="text" class="form-control" placeholder="Search by name">
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
                                </div>
                            </div>
                            <div class="row table-responsive" wire:loading.delay.class="opacity-50" wire:target="paginate, search, FilterSerialize, selectall, selections">
                                <table class="table table-bordered table-striped text-sm">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" wire:model="selectall"></th>
                                        <th wire:click.prevent="FilterSerialize('name')">Name</th>
                                        <th wire:click.prevent="FilterSerialize('phone')">Phone</th>
                                        <th wire:click.prevent="FilterSerialize('status')">Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($admins as $key=>$admin)
                                        <tr @if (is_array($selections)) @if(in_array($admin->id, $selections)) class="bg-secondary" @endif @endif wire:key="row-{{ $admin->id }}">
                                            <td><input type="checkbox" value="{{ $admin->id }}" wire:model="selections"></td>
                                            <td class="text-capitalize"><a href="">{{ $admin->name }}</a></td>
                                            <td class="text-capitalize"><a href="">{{ $admin->phone }}</a></td>
                                            <td><span class="text-capitalize badge {{ $admin->status==='active'?'badge-success':'badge-danger' }}" href="">{{ $admin->status }}</span></td><td>
                                                <a wire:click.prevent="Edit({{ $admin->id }})"><i class="fa fa-edit text-pink"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <th class="text-center" colspan="6">No admin found</th>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="justify-content-center items-center row">
                                <div class="col-12"></div>
                                {{ $admins->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $editmode ? 'update_admin' : 'create_admin' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($editmode)
                                <span>Edit admin</span>
                            @else
                                <span>Add New admin</span>
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
                        <div class="form-group">
                            <label for="email">Phone</label>
                            <input type="tel" wire:model.defer="state.phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" wire:model.defer="state.email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" wire:model.defer="state.address" name="address" class="form-control @error('address') is-invalid @enderror"  placeholder="Enter address">
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
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

