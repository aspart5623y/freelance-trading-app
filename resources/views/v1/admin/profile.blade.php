@extends('layouts.admin')

@section('title', 'Profile')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card card-body border-0 border-0">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf

                        <div class="d-flex flex-wrap justify-content-between align-items-end">
                            <h2 class="fw-bold mb-0">Profile</h2>
                        
                            <div class="text-end">
                                <button class="btn btn-success px-4" type="submit">Update</button>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Firstname</label>
                                    <input type="text" placeholder="Enter your firstname" name="firstname" value="{{ auth()->user()->profileable->firstname }}" class="form-control min-height @error('firstname') is-invalid @enderror">

                                    @error('firstname')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Lastname</label>
                                    <input type="text" placeholder="Enter your lastname" name="lastname" value="{{ auth()->user()->profileable->lastname }}" class="form-control min-height @error('lastname') is-invalid @enderror">

                                    @error('lastname')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-1">Email</label>
                            <input type="email" placeholder="Enter your email" name="email"  value="{{ auth()->user()->email }}" class="form-control min-height @error('email') is-invalid @enderror">
                            <small class="text-muted d-block">(you would have to go through another verification if you update your email address)</small>
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                        <div class="form-group mb-3">
                            <p class="text-success mb-0 fw-bold"><span class="text-dark">Level</span> &nbsp; &dash; &nbsp; {{ auth()->user()->profileable->level }}</p>
                            <small class="text-muted">(you cannot update this information)</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    
@endsection
    