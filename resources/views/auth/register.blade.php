@extends('layouts.auth')

@section('content')
    <div class="">
        @section('title', 'Create Account')

        @section('image')
            <img src="{{ asset('images/auth/create-account.svg') }}" class="img-fluid" alt=""> 
        @endsection

        
        <form method="GET" action="{{ route('createAccount') }}">
            @csrf

            @error('account_type')
                <span class="text-danger d-block text-center">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- investor radio btn --}}
            <div class="card card-body my-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="account_type" value="investor" id="investor">
                    <label class="form-check-label ms-3" for="investor">
                        <p class="fw-bold mb-0">Investor Account</p>
                        <small class="text-muted">Create an investor's account with us so we can help you trade your assets.</small>
                    </label>
                </div>  
            </div>

            {{-- trader radio btn --}}
            <div class="card card-body my-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="account_type" value="trader" id="trader">
                    <label class="form-check-label ms-3" for="trader">
                        <p class="fw-bold mb-0">Trader Account</p>
                        <small class="text-muted">Do you have experience in trading crypto, forex?
                            Join our platform as a trader and help our investors trade their assets while you earn.</small>
                    </label>
                </div>
            </div>


            <div class="text-end">
                <button type="submit" class="btn btn-success px-4" id="">Proceed</button>

                @if (Route::has('login'))
                    <p class="text-muted text-center mb-0 mt-3">
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
