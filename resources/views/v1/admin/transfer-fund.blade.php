@extends('layouts.admin')

@section('title', 'Transfer Fund')

@section('content')
    <div class="container-fluid">
       
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-12 col-md-5">
                <div class="card card-body border-0 d-block">
                    <h5 class="fw-bold">Transfer Fund</h5>
                    <p class="text-muted">Fill the form below to transfer funds from your wallet.</p>


                    <div class="alert alert-danger" id="errorBox" style="display: none;"></div>

                    <form action="{{ route('admin.fund') }}" id="transfer-form" method="post">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label class="mb-1">Account Address</label>
                            <input type="text" placeholder="Enter account address" id="accountAddress" data-address="{{ auth()->user()->id }}" class="form-control min-height @error('address') is-invalid @enderror" value="{{ old('address') }}" name="address">
                            <small class="text-muted">(Get account address from reciepient)</small>
                            @error('address')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label class="mb-1">Account name</label>
                            <input type="text" id="accountName" placeholder="Account name" class="form-control min-height" disabled>
                        </div>


                        <div class="form-group mb-3">
                            <label class="mb-1">Amount</label>
                            <input type="text" placeholder="Enter amount" id="accountNumber" class="form-control min-height @error('amount') is-invalid @enderror" value="{{ old('amount') }}" name="amount">
                
                            @error('amount')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                        <button type="button" id="submitBtn" data-bs-toggle="modal" data-bs-target="#checkPin" class="btn btn-success px-4" disabled>Proceed</button>
                    </form>
                </div>
            </div>

            <div class="col-xl-8 col-lg-12 col-md-7">
                <div class="card card-body border-0 mb-4">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold"><i class="fa fa-exchange-alt" aria-hidden="true"></i> &nbsp; My Transactions</h5>    
                        <span class="float-end">
                            <strong>Balance:</strong> ${{ number_format(auth()->user()->profileable->wallet_balance, 2) }}
                        </span>
                    </div>

                    @if ($transfers->count() > 0)
                        @foreach ($transfers as $item)
                            @if ($item->profile_id == auth()->user()->id)
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-5">
                                        <small class="text-muted fw-bold">Reciever</small>
                                        <h6 class="mb-0">{{ App\Models\Profile::find($item->reciever_address)->profileable->firstname . ' ' . App\Models\Profile::find($item->reciever_address)->profileable->lastname }}</h6>
                                        <span class="text-muted">{{ $item->reciever_address }}</span>
                                    </div>

                                    
                                
                                    <div class="col-sm-2">
                                        <small class="text-muted fw-bold">Amount</small>
                                        <h6 class="text-danger">-${{ number_format($item->amount, 2) }}</h6>
                                    </div>

                                    <div class="col-sm-2">
                                        <small class="text-muted d-block fw-bold">Status</small>
                                        @if ($item->status == 'successful')
                                            <span class="badge bg-success">{{ $item->status }}</span>
                                        @elseif ($item->status == 'failed')
                                            <span class="badge bg-danger">{{ $item->status }}</span>
                                        @endif
                                    </div>

                                    <div class="col-sm-3">
                                        <small class="text-muted fw-bold">Message</small>
                                        <h6>{{ $item->message }}</h6>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    @else
                        <hr>
                        <p class="text-muted text-center fw-bold">You dont have any transaction</p>
                    @endif

                    <div class="py-4">
                        {{ $transfers->links() }}
                    </div>


                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="checkPin">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Transaction Pin</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">
                        Enter your pin to confirm this transaction
                    </p>


                    <form>
                        @csrf

                        <div class="form-group mb-4">
                            <input type="password" name="pin" id="pinInput" class="form-control text-center min-height">
                            <span class="text-danger" id="pinError"></span>
                        </div>
    
                        <div class="text-center">
                            <button id="confirmBtn" data-type="{{ auth()->user()->profileable_type }}" type="button" class="btn btn-success px-4">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    @push('js')
        <script src="{{ asset('js/transfer-fund.js') }}"></script>
        <script src="{{ asset('js/validate-pin.js') }}"></script>
    @endpush
@endsection
