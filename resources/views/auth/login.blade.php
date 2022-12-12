@extends('layouts.auth')

@section('content')
<div class="">

    @section('title', 'Login')

    @section('image')
        <img src="{{ asset('images/auth/access account.svg') }}" class="img-fluid" alt=""> 
    @endsection

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        
        <div class="form-group mb-3">
            <label for="email" class="mb-1">{{ __('Email Address') }}</label>
            <input id="email" type="email" placeholder="Email address" class="form-control min-height @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="password" class="mb-1">{{ __('Password') }}</label>
            <input id="password" type="password" placeholder="password" class="form-control min-height @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Remember me') }}
            </label>
        </div>
        

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-success px-4">
                {{ __('Login') }}
            </button>

            <br>
            <br>
            

            @if (Route::has('register'))
                <p class="text-muted mb-0">
                    Do not have an account? 
                    <a class="text-success" href="{{ route('register') }}">
                        {{ __('Create Account') }}
                    </a>
                </p>
            @endif

            @if (Route::has('password.request'))
                <a class="text-success" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
        
    </form>
</div>
@endsection
