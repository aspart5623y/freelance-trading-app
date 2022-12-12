@extends('layouts.trader')

@section('title', 'Withdrawal')

@section('content')


    <div class="d-flex justify-content-between flex-wrap mb-5 align-items-center">
        <div>
            <h4 class="fw-bold">Withdrawals</h4>
            <p class="text-muted">
                This table contains a list of all your wuthdrawals on this platform.
            </p>
        </div>
        <div class="text-end">
            <small class="text-muted fw-bold">Wallet Balance</small>
            <h2 class="fw-bold">${{ number_format(auth()->user()->profileable->wallet_balance, 2) }}</h2>
            <a href="{{ route('trader.withdrawal.create') }}" class="btn btn-success">Request withdrawal</a>
        </div>
    </div>

    <div class="card card-body border-0">
        <div class="table-responsive">
            <table class="table table-borderless data-table">
                <thead>
                    <tr>
                        <th class="text-muted text-uppercase">s/n</th>
                        <th class="text-muted text-uppercase">Amount</th>
                        <th class="text-muted text-uppercase">Payment channel</th>
                        <th class="text-muted text-uppercase">status</th>
                        <th class="text-muted text-uppercase">requested date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1;   
                    @endphp
                    @foreach ($withdrawals as $item)
                        <tr class="border-bottom">
                            <td>{{ $sn++ }}</td>
                            <td>${{ number_format($item->amount, 2) }}</td>
                            <td>{{ $item->account->account_type }}</td>
                            <td>
                                @if ($item->status == 'approved')
                                    <span class="badge bg-green">{{ $item->status }}</span>
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










@push('js')
    <script>
        $(document).ready(function () {
            $('.data-table').DataTable();
        });
    </script>
@endpush
@endsection