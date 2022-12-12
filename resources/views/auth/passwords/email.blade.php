@extends('layouts.auth')

@section('content')
@section('title', 'Forgot Password')

@section('image')
    <img src="{{ asset('images/auth/forgot-password.svg') }}" class="img-fluid" alt=""> 
@endsection
<div class="">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="form-group mb-4">
                <label for="email" class="">{{ __('Email Address') }}</label>
                <input id="email" type="email" placeholder="Email address" class="form-control min-height @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="text-center">
                <button type="submit" class="btn btn-success">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
            
        </form>
    </div>
@endsection
