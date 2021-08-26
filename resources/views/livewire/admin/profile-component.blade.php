<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Profile</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <div class="user-avatar justify-content-center">
                                        <center><img src="{{$user->profile_photo_path}}" alt="{{$user->name}}"></center>
                                    </div>
                                    <h5 class="user-name text-capitalize">{{$user->name}}</h5>
                                    <h6 class="user-name">{{$user->email}}</h6>
                                    <h6 class="user-name pt-2">{{$user->phone}}</h6>
                                </div>
                                <div class="about">
                                    <h5>Address</h5>
                                    <p>{!! $user->address !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">Personal Details</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">Full Name</label>
                                        @error('name') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                        <input wire:model.lazy="name" type="text" class="form-control" id="fullName" placeholder="Enter full name">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail">Email</label>
                                        @error('email') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                        <input wire:model.lazy="email" type="email" class="form-control" id="eMail" placeholder="Enter email ID">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        @error('phone') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                        <input wire:model.lazy="phone" type="text" class="form-control" id="phone" placeholder="Enter phone number">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="website">Website URL</label>
                                        @error('image') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                        <input wire:model.lazy="image" type="url" class="form-control" id="website" placeholder="Image url">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div wire:ignore class="form-group">
                                        <label for="website">Address</label>
                                        @error('address') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                        <trix-editor class="formatted-content" x-data x-on:trix-change="$dispatch('input', event.target.value)" wire:model.debounce.1000ms="address" wire:key="uniqueKey"></trix-editor>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button wire:click.prevent="Update" type="button" id="submit" name="submit" class="btn btn-primary">Update
                                            <span wire:loading wire:target="Update" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mt-3 mb-2 text-primary">Change Password</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        @error('password') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                        <input wire:model.lazy="password" type="password" class="form-control" placeholder="Enter Current Password">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="Street">New Password</label>
                                        @error('newPassword') <span class="text-danger text-bold"> {{$message}}</span>@enderror
                                        <input wire:model.lazy="newPassword" type="password" class="form-control" id="Street" placeholder="Enter New Password">
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button wire:click.prevent="ChangePassword" type="button" class="btn btn-primary">Change Password
                                            <span wire:loading wire:target="ChangePassword" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
