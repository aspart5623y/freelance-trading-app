@extends('layouts.trader')

@section('title', 'Confirm Password')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
            <div class="card card-body border-0 d-block">
                <form action="{{ route('trader.confirm.password') }}" method="post">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label class="mb-1">Enter password to proceed</label>
                        <input type="password" placeholder="Confirm password" class="form-control min-height @error('password') is-invalid @enderror" name="password">
            
                        @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-success px-4">Confirm</button>
                </form>
            </div>
        </div>
    </div>
@endsection
