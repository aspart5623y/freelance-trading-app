@extends('layouts.auth')

@section('content')
<div class="">
    @section('title', 'Reset Password')

    @section('image')
        <img src="{{ asset('images/auth/my password.svg') }}" class="img-fluid" alt=""> 
    @endsection

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">


        <div class="form-group mb-3">
            <label for="email" class="mb-1">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control min-height @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus readonly>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        
        <div class="form-group mb-3">
            <label for="password" class="mb-1">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control min-height @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        

        <div class="form-group mb-3">
            <label for="password-confirm" class="mb-1">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control min-height" name="password_confirmation" autocomplete="new-password">
        </div>


        <div class="text-center">
            <button type="submit" class="btn btn-success">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</div>
@endsection
