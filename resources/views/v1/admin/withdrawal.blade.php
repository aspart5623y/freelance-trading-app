@extends('layouts.admin')

@section('title', 'Withdrawals')

@section('content')

    <div class="container-fluid">
      
        <div class="d-flex justify-content-between flex-wrap align-items-center mb-5">
            <div>
                <h4 class="fw-bold">Withdrawals</h4>
                <p class="text-muted">
                    This table contains a list of all your wuthdrawals on your platform.
                </p>
            </div>
            <div>
                @php
                    $company = \App\Models\CompanyInfo::first();
                @endphp
                <small class="text-muted fw-bold">Wallet Balance</small>
                <h2 class="fw-bold">${{ number_format($company ? $company->wallet_balance : 0, 2) }}</h2>
            </div>
        </div>


        <div class="card card-body border-0">
            <div class="table-responsive">
                <table class="table table-borderless data-table">
                    <thead>
                        <tr>
                            <th class="text-muted text-uppercase">s/n</th>
                            <th class="text-muted text-uppercase">Profile</th>
                            <th class="text-muted text-uppercase">Amount</th>
                            <th class="text-muted text-uppercase">payment channel</th>
                            <th class="text-muted text-uppercase">status</th>
                            <th class="text-muted text-uppercase">requested date</th>
                            <th class="text-muted text-uppercase">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sn = 1;   
                        @endphp
                        @foreach ($withdrawals as $item)
                            <tr class="border-bottom">
                                <td>{{ $sn++ }}</td>
                                <td>{{ $item->profile->profileable->firstname . ' ' . $item->profile->profileable->lastname }}</td>
                                <td>${{ number_format($item->amount, 2) }}</td>
                                <td>{{ $item->account->account_type }}</td>
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
                                <td>
                                    @if ($item->account->account_type == 'bank')
                                        <button 
                                            class="btn text-success approve-btn" 
                                            id="{{ $item->id }}" 
                                            data-route="{{ $item->account->bank->bank_name . ',' . $item->account->bank->account_name . ',' . $item->account->bank->account_number }}" 
                                            data-channel="{{ $item->account->account_type }}" 
                                            data-amount="{{ number_format($item->amount, 2) }}" 
                                            {{ $item->status == 'approved' || $item->status == 'rejected' ? 'disabled' : '' }}
                                        >
                                            <i class="far fa-check-circle text-success" aria-hidden="true"></i>
                                        </button>
                                    @elseif ($item->account->account_type == 'crypto')
                                        <button 
                                            class="btn text-success approve-btn" 
                                            id="{{ $item->id }}" 
                                            data-route="{{ $item->account->crypto->coin . ',' . $item->account->crypto->wallet_address }}" 
                                            data-channel="{{ $item->account->account_type }}" 
                                            data-amount="{{ number_format($item->amount, 2) }}" 
                                            {{ $item->status == 'approved' || $item->status == 'rejected' ? 'disabled' : '' }}
                                        >
                                            <i class="far fa-check-circle text-success" aria-hidden="true"></i>
                                        </button>
                                    @elseif ($item->account->account_type == 'paypal')
                                        <button 
                                            class="btn text-success approve-btn" 
                                            id="{{ $item->id }}" 
                                            data-route="{{ $item->account->paypal->account_name . ',' . $item->account->paypal->account_email }}" 
                                            data-channel="{{ $item->account->account_type }}" 
                                            data-amount="{{ number_format($item->amount, 2) }}" 
                                            {{ $item->status == 'approved' || $item->status == 'rejected' ? 'disabled' : '' }}
                                        >
                                            <i class="far fa-check-circle text-success" aria-hidden="true"></i>
                                        </button>
                                    @endif
                                    
            
                                    <button class="btn text-danger reject-btn" id="{{ $item->id }}" {{ $item->status == 'approved' || $item->status == 'rejected' ? 'disabled' : '' }}>
                                        <i class="far fa-times-circle text-danger" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>









    <div class="modal fade" id="approveModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Approve Withdrawal</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">
                        Are you sure you want to approve this withdrawal? <br> 
                        <strong>Action:</strong> 
                        <span id="modalMessage"></span>
                    </p>

                    <div class="" id="walletAddress"></div>

                    <div class="my-4 d-flex justify-content-center" id="qrContainer"></div>
                    
                    <div class="text-end">
                        <button class="btn btn-light text-success px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-success px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('approve-form').submit();">
                            Done
                        </a>
                    
                        <form id="approve-form" action="{{ route('admin.withdrawal.approve') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" id="approveId" name="id">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="rejectModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Reject Withdrawal</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">
                        Are you sure you want to reject this withdrawal? <br> 
                        <strong>Note:</strong> Your wallet balance would not be deducted after this.
                    </p>
                    
                    <div class="text-end">
                        <button class="btn btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('reject-form').submit();">
                            Confirm
                        </a>
                    
                        <form id="reject-form" action="{{ route('admin.withdrawal.reject') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" id="rejectId" name="id">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @push('js')
        <script src="{{ asset('js/copy.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('.data-table').DataTable();
            });
        </script>


        <script>
            $('.approve-btn').on('click', function() {
                $id = $(this).attr('id');
                $channel = $(this).attr('data-channel');
                $amount = $(this).attr('data-amount');
                $routes = $(this).attr('data-route');
                $('#approveModal').on('show.bs.modal', function() {
                    $('#approveId').val($id);
                    $route = $routes.split(',');

                    if ($channel == 'bank') {
                        $('#modalMessage').html(`
                            In order to complete this action, transfer <strong>$${$amount}</strong> to the client's <span class="text-bg-warning p-1">bank account</span>. <br> 
                            An automatic mail would be sent to the client after this action and your wallet balance would be deducted.
                        `);
                        $("#walletAddress").removeClass();
                        $('#walletAddress').addClass('text-center')
                        $('#walletAddress').html(`
                            <h1 class="fw-bold mb-0">${$route[2]}</h1>
                            <p class="mb-0">${$route[1]}</p>
                            <p class="text-muted">${$route[0]}</p>
                        `);
                        $('#qrContainer').html(``)
                    } else if ($channel == 'crypto') {
                        $('#modalMessage').html(`
                            In order to complete this action, transfer <strong>$${$amount}</strong> worth of ${$route[0]} to the client's <span class="text-bg-warning p-1">crypto wallet</span> below or scan the barcode to get the wallet address. <br> 
                            An automatic mail would be sent to the client after this action and your wallet balance would be deducted.
                        `);
                        $("#walletAddress").removeClass();
                        $('#walletAddress').addClass('input-group')
                        $('#walletAddress').html(`
                            <input type="text" disabled id="copyInput" class="form-control min-height" value="${$route[1]}">
                            <button type="button" class="btn btn-dark" onclick="copy()">copy &nbsp; <i class="fa fa-copy" aria-hidden="true"></i></button>
                        `);
                        $('#qrContainer').html(`
                            {!! DNS2D::getBarcodeHTML('${$route[1]}', 'QRCODE') !!}
                        `);
                    } else if ($channel == 'paypal') {
                        $('#modalMessage').html(`
                            In order to complete this action, transfer <strong>$${$amount}</strong> to the client's <span class="text-bg-warning p-1">paypal account</span>. <br> 
                            An automatic mail would be sent to the client after this action and your wallet balance would be deducted.
                        `);
                        $("#walletAddress").removeClass();
                        $('#walletAddress').addClass('text-center')
                        $('#walletAddress').html(`
                            <h6 class="fw-bold">${$route[0]}</h6>
                            <p>${$route[1]}</p>
                        `);
                        $('#qrContainer').html(``)
                    }

                })
                $('#approveModal').modal('show')
            })


            $('.reject-btn').on('click', function() {
                $id = $(this).attr('id');
                $('#rejectModal').on('show.bs.modal', function() {
                    $('#rejectId').val($id);
                })
                $('#rejectModal').modal('show')
            })
        </script>
    @endpush
@endsection