@extends('layouts.auth')

@section('content')
@section('title', 'Set your password')

@section('image')
    <img src="{{ asset('images/auth/secure login.svg') }}" class="img-fluid" alt=""> 
@endsection
    <div class="">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif 

        <form method="POST" action="{{ route('password.save') }}">
            @csrf

            <input type="hidden" name="email" value="{{ $email }}">
            
            <div class="form-group mb-4">
                <label for="password" class="mb-1">{{ __('New Password') }}</label>
                <input type="password" placeholder="Enter new password" class="form-control min-height @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group mb-3">
                <label for="password-confirm" class="mb-1">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" placeholder="Confirm password" class="form-control min-height" name="password_confirmation" autocomplete="new-password">
            </div>


            <div class="text-center">
                <button type="submit" class="btn btn-success">
                    {{ __('Set Password') }}
                </button>
            </div>
            
        </form>
    </div>
@endsection
