@extends('layouts.trader')

@section('title', 'Change Password')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
            <div class="card my-5 card-body border-0 py-4 d-block">
                <form action="{{ route('trader.update.password') }}" method="post">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label class="mb-1">Current Password</label>
                        <input type="password" placeholder="Enter current password" class="form-control min-height @error('current_password') is-invalid @enderror" name="current_password">
            
                        @error('current_password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-1">New Password</label>
                        <input type="password" placeholder="Enter new password" class="form-control min-height @error('new_password') is-invalid @enderror" name="new_password">
            
                        @error('new_password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-1">Confirm new Password</label>
                        <input type="password" placeholder="Confirm new password" class="form-control min-height @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation">
            
                        @error('new_password_confirmation')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button class="btn btn-success px-4">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection