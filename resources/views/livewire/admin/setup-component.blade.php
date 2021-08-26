<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
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
            <div class="col-md-8 offset-md-2">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General Setting</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form wire:submit.prevent="updateSetting">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Admin Name</label>
                                    <input wire:model.defer="state.admin" type="text" class="form-control" placeholder="Enter admin name">
                                    @error('state.admin') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input wire:model.defer="state.phone" type="text" class="form-control" placeholder="Enter phone no">
                                    @error('state.phone') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input wire:model.defer="state.email" type="email" class="form-control" placeholder="Enter email">
                                    @error('state.email') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input wire:model.defer="state.logo" type="url" class="form-control" placeholder="Enter image url">
                                    @error('state.logo') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>Site name</label>
                                    <input wire:model.defer="state.site_name" type="text" class="form-control" placeholder="Enter site name">
                                    @error('state.site_name') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>Site url</label>
                                    <input wire:model.defer="state.site_url" type="url" class="form-control" placeholder="Enter site url">
                                    @error('state.site_url') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>Facobook url</label>
                                    <input wire:model.defer="state.facebook" type="url" class="form-control" placeholder="Enter facebook url">
                                    @error('state.facebook') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>Twitter url</label>
                                    <input wire:model.defer="state.twitter" type="url" class="form-control" placeholder="Enter twitter url">
                                    @error('state.twitter') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>Youtube url</label>
                                    <input wire:model.defer="state.youtube" type="url" class="form-control" placeholder="Enter youtube url">
                                    @error('state.youtube') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <input wire:model.defer="state.location" type="text" class="form-control" placeholder="Enter location">
                                    @error('state.location') <span class="text-danger text-bold"> {{$message}}</span>@enderror

                                </div>
                                <div class="form-group">
                                    <label>About</label>
                                    <span wire:ignore>
                                        <trix-editor class="formatted-content" x-data x-on:trix-change="$dispatch('input', event.target.value)" wire:model.debounce.1000ms="state.about" wire:key="uniqueKey"></trix-editor>
                                    </span>
                                    @error('state.about') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input wire:model="nightMode" type="checkbox" class="custom-control-input" id="nightMode">
                                        <label class="custom-control-label" for="nightMode">Night Mode</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input wire:model="sidebarCollapse" type="checkbox" class="custom-control-input" id="sidebarCollapse">
                                        <label class="custom-control-label" for="sidebarCollapse">Sidebar Collapse</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save changes
                                    <span wire:loading wire:target="updateSetting" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </button>
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
            $('#nightMode').on('change', function() {
                $('#bodyId').toggleClass('dark-mode');
                    $('#navbarId').removeClass('navbar-light');
                    $('#navbarId').removeClass('navbar-dark');
                    $('#sidebarId').removeClass('sidebar-light-primary');
                    $('#sidebarId').removeClass('sidebar-dark-primary');
            })
        $('#sidebarCollapse').on('change', function() {
            $('body').toggleClass('sidebar-collapse');
        })
    </script>
@endpush
