@extends('layouts.investor')

@section('title', 'Change Transaction pin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
            <div class="card card-body border-0 d-block">
                <form action="{{ route('investor.update.pin') }}" method="post">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label class="mb-1">Enter new transaction pin</label>
                        <input type="password" placeholder="Update transaction pin" class="form-control min-height @error('pin') is-invalid @enderror" name="pin">
            
                        @error('pin')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-success px-4">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
