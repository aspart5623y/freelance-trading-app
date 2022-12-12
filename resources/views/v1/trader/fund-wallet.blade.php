@extends('layouts.trader')

@section('title', 'Fund Wallet')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-12 col-md-5">
            <div class="card card-body border-0 mb-4 d-block">
                <h5 class="fw-bold">Fund wallet</h5>
                <p class="text-muted">Fill the form below to fund your wallet.</p>


                <div class="alert alert-danger" id="errorBox" style="display: none;"></div>

                <form action="{{ route('trader.wallet.transfer') }}" id="transfer-form" method="post">
                    @csrf

                    <div class="form-group mb-3">
                        <label class="mb-1">Amount</label>
                        <input type="text" placeholder="Enter amount" class="form-control min-height @error('amount') is-invalid @enderror" value="{{ old('amount') }}" name="amount">
            
                        @error('amount')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <div class="form-group mb-3">
                        <label class="mb-1">Coin</label>
                        <select name="coin" class="form-select min-height @error('coin') is-invalid @enderror">
                            <option value="">Select Coin</option>
                            @foreach($accounts as $account) 
                            <option value="{{ $account->id }}">{{ $account->crypto->coin }}</option>
                            @endforeach
                        </select>
            
                        @error('coin')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-success px-4">Proceed</button>
                </form>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12 col-md-7">
            <div class="card card-body border-0 mb-4">
                <h5 class="fw-bold mb-4"><i class="fa fa-wallet" aria-hidden="true"></i> &nbsp; My Deposits</h5>

                <div class="table-responsive">
                    <table class="table table-borderless data-table">
                        <thead>
                            <tr>
                                <th class="text-muted text-uppercase">s/n</th>
                                <th class="text-muted text-uppercase">amount</th>
                                <th class="text-muted text-uppercase">payment channel</th>
                                <th class="text-muted text-uppercase">proof</th>
                                <th class="text-muted text-uppercase">status</th>
                                <th class="text-muted text-uppercase">date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sn = 1;   
                            @endphp
                            @foreach ($deposits as $item)
                                <tr class="border-bottom">
                                    <td>{{ $sn++ }}</td>
                                    <td>${{ number_format($item->amount, 2) }}</td>
                                    <td>{{ $item->account->account_type }}</td>
                                    <td>
                                        <a href="{{ asset('deposits/proof' . '/' .$item->proof) }}" target="_blank">
                                            <img src="{{ asset('deposits/proof' . '/' .$item->proof) }}" width="100" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        @if ($item->status == 'approved')
                                            <span class="badge bg-success">{{ $item->status }}</span>
                                        @elseif ($item->status == 'rejected')
                                            <span class="badge bg-danger">{{ $item->status }}</span>
                                        @elseif ($item->status == 'pending')
                                            <span class="badge bg-secondary">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ Carbon\Carbon::create($item->created_at)->format('l jS \of F Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection