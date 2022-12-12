@extends('layouts.investor')

@section('title', 'Payment')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
            <div class="card card-body border-0 d-block mb-4">
                <p class="text-muted">
                    Transfer <strong>${{$amount}}</strong> worth of <strong>{{$account->crypto->coin}}</strong> to the wallet address below. You can choose to scan or copy the wallet address below. <br>
                    <strong>Note:</strong> Upload a proof of transfer below so your wallet can be credited.
                </p>
        

                <form action="{{ route('investor.fund.proof') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label class="mb-1">Amount</label>
                        <input type="text" placeholder="Enter amount" class="form-control min-height @error('amount') is-invalid @enderror" value="{{ $amount }}" name="amount" readonly>
            
                        @error('amount')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    


                    <input type="hidden" value="{{ $account->id }}" name="account_id">




                    <div class="form-group mb-3">
                        <label class="mb-1">Wallet Address</label>

                        <div class="input-group">
                            <input type="text" placeholder="Enter wallet_address" id="copyInput" class="form-control min-height @error('wallet_address') is-invalid @enderror" value="{{ $account->crypto->wallet_address }}" name="wallet_address" readonly>
                            <button type="button" class="btn btn-dark" onclick="copy()">copy &nbsp; <i class="fa fa-copy" aria-hidden="true"></i></button>
                        </div>
            
                        @error('wallet_address')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <div class="my-4 d-flex justify-content-center">
                        {!! DNS2D::getBarcodeHTML($account->crypto->wallet_address, 'QRCODE') !!}
                    </div>


                    <div class="form-group mb-3">
                        <label class="mb-1">Proof of payment</label>
                        <input type="file" name="proof" placeholder="Enter proof" class="form-control @error('proof') is-invalid @enderror">
                        <small class="text-muted">(You can upload a screenshot or a pdf document of transfer)</small> <br>
            
                        @error('proof')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-success px-4">Upload</button>
                </form>
            </div>
        </div>
    </div>



    @push('js')
        <script src="{{ asset('js/copy.js') }}"></script>
    @endpush
@endsection