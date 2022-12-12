@extends('layouts.trader')

@section('title', 'Request Withdrawal')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
            <div class="card card-body border-0 d-block">
                <p class="text-muted">Fill the form to request withdrawal.</p>
                @if (auth()->user()->account->count() < 1)
                    <p class="alert alert-danger">
                        You have not addedd an account to your profile. Click the account type you want to add &dash; 
                        <a href="{{ route('trader.bank') }}" class="text-success">Bank Account</a>, <a href="{{ route('trader.crypto') }}" class="text-success">Crypto wallet</a> and <a href="{{ route('trader.paypal') }}" class="text-success">Paypal</a> .</p>
                @endif

                <form action="{{ route('trader.withdrawal.store') }}" method="post">
                    @csrf
                    
                    <input type="hidden" name="profile_id" value="{{ auth()->user()->id }}">
                    <div class="form-group mb-3">
                        <label class="mb-1">Amount</label>
                        <input type="text" placeholder="Enter withdrawal amount" class="form-control min-height @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}">
            
                        @error('amount')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <label class="mb-1">Account</label>
                        <select name="account_id" id="" class="form-select min-height @error('account_id') is-invalid @enderror">
                            @if (auth()->user()->account->count() > 0)
                                <option value="">Select account</option>
                                @if (auth()->user()->account->where('account_type', 'bank')->count() > 0)
                                    <optgroup label="bank">
                                        @foreach (auth()->user()->account->where('account_type', 'bank') as $account)
                                            <option value="{{ $account->id }}">{{ $account->bank->bank_name }} &dash; {{ $account->bank->account_number }}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                                @if (auth()->user()->account->where('account_type', 'crypto')->count() > 0)
                                    <optgroup label="crypto">
                                        @foreach (auth()->user()->account->where('account_type', 'crypto') as $account)
                                            <option value="{{ $account->id }}">{{ $account->crypto->coin }} &dash; {{ $account->crypto->wallet_address }}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                                @if (auth()->user()->account->where('account_type', 'paypal')->count() > 0)
                                    <optgroup label="paypal">
                                        @foreach (auth()->user()->account->where('account_type', 'paypal') as $account)
                                            <option value="{{ $account->id }}">{{ $account->paypal->account_name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            @else
                                <option value="">You have not added any account</option>
                            @endif                     
                        </select>

                        @error('account_id')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-success px-4">Request</button>
                </form>
            </div>
        </div>
    </div>
@endsection
