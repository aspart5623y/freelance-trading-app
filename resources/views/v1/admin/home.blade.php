@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
    <div class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif


        


        <div class="row">
            <div class="col-xxl-6">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-sm-4 my-4">
                            <div class="card card-body border-0 h-100">
                                <div class="d-flex justify-content-between h-100 align-items-center">
                                    <div>
                                        <p class="mb-0 text-muted">Wallet</p>
                                        <h3 class="mb-0 fw-bold">${{ number_format($wallet_balance, 2) }}</h3>
                                    </div>
                                    <div class="dashboard-icon">
                                        <i class="fas fa-wallet"></i> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 my-4">
                            <div class="card card-body border-0 h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-0">Investments</p>
                                        <h3 class="fw-bold mb-0">${{ number_format($sum_investment, 2) }}</h3>
                                        <small class="text-muted">This month</small> 
                                        <span class="badge alert-success text-success">+{{ $total_investment }}</span> 
                                    </div>
                                    <div class="dashboard-icon">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 my-4">
                            <div class="card card-body border-0 h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-0">Withdrawals</p>
                                        <h3 class="fw-bold mb-0">${{ number_format($sum_withdrawals, 2) }}</h3>
                                        <small class="text-muted">This month</small> 
                                        <span class="badge alert-success text-success">+{{ $total_withdrawals }}</span> 
                                    </div>
                                    <div class="dashboard-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-6">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-sm-4 my-4">
                            <div class="card card-body border-0 h-100 text-center">
                                <p class="text-muted">Investors</p>
                                <h3 class="fw-bold">{{ $investors_count }}</h3>
                            </div>
                        </div>

                        <div class="col-sm-4 my-4">
                            <div class="card card-body border-0 h-100 text-center">
                                <p class="text-muted">Traders</p>
                                <h3 class="fw-bold">{{ $traders_count }}</h3>
                            </div>
                        </div>

                        <div class="col-sm-4 my-4">
                            <div class="card card-body border-0 h-100 text-center">
                                <p class="text-muted">Admins</p>
                                <h3 class="fw-bold">{{ $admins_count - 1 }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 overflow-hidden mb-4">
                <div class="d-flex mt-3 flex-wrap justify-content-between">
                    <h5 class="fw-bold">Recent Investors</h5>
                    <a href="{{ route('admin.investors') }}" class="text-success">View all</a>
                </div>
                <div class="card card-body h-100 border-0">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-muted text-uppercase">s/n</th>
                                    <th class="text-muted text-uppercase">image</th>
                                    <th class="text-muted text-uppercase">fullname</th>
                                    <th class="text-muted text-uppercase">email</th>
                                    <th class="text-muted text-uppercase">gender</th>
                                    <th class="text-muted text-uppercase"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sn = 1;   
                                @endphp
                                @foreach ($investors as $user)
                                    <tr class="border-bottom">
                                        <td>{{ $sn++ }}</td>
                                        <td>
                                            <div class="table-img" style="background-image: url('{{ $user->profile_img ? asset('profile-image/' . $user->profile->profileable_type . '/' . $user->profile_img) : asset('/images/avatar/avatar.jpeg') }}')">
                                            </div>
                                        </td>
                                        <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
                                        <td>{{ $user->profile->email }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.show', $user->profile->id) }}" class="btn btn-success btn-sm">View</a> 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-6 overflow-hidden mb-4">
                <div class="d-flex mt-3 flex-wrap justify-content-between">
                    <h5 class="fw-bold">Recent Traders</h5>
                    <a href="{{ route('admin.traders') }}" class="text-success">View all</a>
                </div>
                <div class="card card-body h-100 border-0">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-muted text-uppercase">s/n</th>
                                    <th class="text-muted text-uppercase">image</th>
                                    <th class="text-muted text-uppercase">fullname</th>
                                    <th class="text-muted text-uppercase">email</th>
                                    <th class="text-muted text-uppercase">gender</th>
                                    <th class="text-muted text-uppercase"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sn = 1;
                                @endphp
                                @foreach ($traders as $user)
                                    <tr class="border-bottom">
                                        <td>{{ $sn++ }}</td>
                                        <td>
                                            <div class="table-img" style="background-image: url('{{ $user->profile_img ? asset('profile-image/' . $user->profile->profileable_type . '/' . $user->profile_img) : asset('/images/avatar/avatar.jpeg') }}')">
                                            </div>
                                        </td>
                                        <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
                                        <td>{{ $user->profile->email }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.show', $user->profile->id) }}" class="btn btn-success btn-sm">View</a> 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="fw-bold">Investments</h5>
            <a href="{{ route('admin.investment.index') }}" class="text-success">View all</a>
        </div>
        <div class="card card-body mb-4 border-0"> 
            <div class="table-responsive"> 
                <table class="table table-borderless"> 
                    <thead> 
                        <tr> 
                            <th class="text-muted text-uppercase">s/n</th> 
                            <th class="text-muted text-uppercase">Amount</th> 
                            <th class="text-muted text-uppercase">package</th> 
                            <th class="text-muted text-uppercase">duration</th> 
                            <th class="text-muted text-uppercase">PRofits</th> 
                            <th class="text-muted text-uppercase">status</th> 
                            <th class="text-muted text-uppercase">requested date</th> 
                            <th></th>
                        </tr> 
                    </thead> 
                    <tbody> 
                        @php 
                            $sn = 1; 
                        @endphp 
                        @foreach ($investments as $item) 
                            <tr class="border-bottom"> 
                                <td>{{ $sn++ }}</td> 
                                <td>${{ number_format($item->amount, 2) }}</td> 
                                <td>{{ $item->package->title }}</td> 
                                <td>{{ $item->package->duration }}days</td> 
                                <td>${{ number_format($item->amount * ($item->package->roi/100), 2) }}/daily</td> 
                                <td> 
                                    @if ($item->status == 'accepted' || $item->status == 'completed') 
                                        <span class="badge bg-success">{{ $item->status }}</span> 
                                    @elseif ($item->status == 'running') 
                                        <i class="fas fa-spinner text-success fa-pulse"></i>
                                        <span class="badge text-success bg-light">{{ $item->status }}</span> 
                                        <i class="fas fa-spinner text-success fa-pulse"></i>
                                    @elseif ($item->status == 'rejected' || $item->status == 'cancelled') 
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


    @push('js')
        <script src="{{ asset('js/chart.min.js') }}"></script>
        <script src="{{ asset('js/line-chart.js') }}"></script>
    @endpush

@endsection
