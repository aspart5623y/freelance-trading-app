@extends('layouts.auth')

@section('content')
    <div class="">

        @section('title', 'Create Account')

        @section('image')
            <img src="{{ asset('images/auth/upload.svg') }}" class="img-fluid" alt=""> 
        @endsection

        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="hidden" value="{{ $type }}" name="account_type">
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label for="firstname" class="mb-1">{{ __('Firstname') }}</label>
                        <input id="firstname" type="text" placeholder="Firstname" class="form-control min-height @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
            
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label for="lastname" class="mb-1">{{ __('Lastname') }}</label>
                        <input id="lastname" type="text" placeholder="Lastname" class="form-control min-height @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" autofocus>
            
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            
            
            <div class="form-group mb-3">
                <label for="email" class="mb-1">{{ __('Email Address') }}</label>
                <input id="email" type="email" placeholder="Email Address" class="form-control min-height @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
            
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label for="password" class="mb-1">{{ __('Password') }}</label>
                        <input id="password" type="password" placeholder="Password" class="form-control min-height @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
            
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label for="password-confirm" class="mb-1">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control min-height" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>
            </div>
            
            
            
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success">
                    {{ __('Create Account') }}
                </button>
            
                @if (Route::has('login'))
                    <p class="text-muted mb-0 mt-3">
                        Already have an account? 
                        <a class="text-success" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    </p>
                @endif
            </div>
            
        </form>
    </div>

@endsection
