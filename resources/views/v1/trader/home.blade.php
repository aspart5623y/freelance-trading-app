@extends('layouts.trader')

@section('title', 'Overview')

@section('content')

    <div class="row">
        <div class="col-sm-6 col-lg-3 my-4">
            <div class="card card-body h-100 border-0">
                <div class="d-flex justify-content-between align-items-center h-100">
                    <div>
                        <p class="mb-0 text-muted">Wallet</p>
                        <h3 class="mb-0 fw-bold">${{ auth()->user()->profileable->wallet_balance }}</h3>
                    </div>
                    <div class="dashboard-icon">
                        <i class="fas fa-wallet"></i> 
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 my-4">
            <div class="card card-body h-100 border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Investments</p>
                        <h3 class="fw-bold mb-0">${{ number_format($sum_investment, 2) }}</h3>
                        <small class="text-muted">This month</small> 
                        <span class="badge alert-success text-success">+{{$this_month_investment}}</span> 
                    </div>
                    <div class="dashboard-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 my-4">
            <div class="card card-body h-100 border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Withdrawals</p>
                        <h3 class="fw-bold mb-0">${{ number_format($sum_withdrawals, 2) }}</h3>
                        <small class="text-muted">This month</small> 
                        <span class="badge alert-success text-success">+{{$total_withdrawals}}</span> 
                    </div>
                    <div class="dashboard-icon">
                        <i class="fas fa-download"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 my-4">
            <div class="card card-body h-100 border-0">
                <div class="d-flex justify-content-between h-100 align-items-center">
                    <div>
                        <p class="text-muted mb-0">My packages</p>
                        <h3 class="fw-bold mb-0">{{ auth()->user()->profileable->packages()->count() }}</h3>
                    </div>
                    <div class="dashboard-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4 col-md-5 order-md-1">
            <h4 class="fw-bold">Profile Level</h4>
            <div class="card card-body border-0 mb-4">
                <ul class="list-unstyled profile-level">
                    <li class="level done">Create Account</li>
                    <li class="level {{ $complete_profile ? 'done' : '' }}">Complete Profile</li>
                    <li class="level {{ $complete_kyc ? 'done' : '' }}">KYC Verification</li>
                    <li class="level {{ $complete_meeting ? 'done' : '' }}">Google Meeting with admin</li>
                    <li class="level {{ auth()->user()->profileable->verify ? 'done' : '' }}">Admin Verification</li>
                </ul>
            </div>
        </div>

        <div class="col-lg-8 col-md-7 order-md-0">
            <div class="d-flex justify-content-between flex-wrap">
                <h4 class="fw-bold">My packages</h4>
                <a href="{{ route('trader.packages') }}" class="text-success">View all</a>
            </div>

            @if ($packages && $packages->count() > 0)
                <div class="owl-carousel owl-carousel-2 owl-theme">
                    @foreach ($packages as $item)
                        <div class="item h-100">
                            <div class="card h-100 card-body border-0 py-5 d-block">
                                <div class="position-absolute end-0 top-0 m-2">
                                    <a href="{{ route('trader.package.edit', $item->id) }}" class="btn px-1 text-success"><i class="far fa-edit"></i></a>
                                </div>
                                
                                <div class="text-center">
                                    <h6 class="text-uppercase fw-bold text-dark">{{ $item->title }}</h6>
                                    <h2 class="fw-bold text-capitalize text-dark">{{ $item->roi }}% ROI</h2>
                                    <span class="badge package-banner bg-{{ $item->service->color }}">{{ $item->service->title }}</span>
                                </div>
                    
                    
                                <ul class="list-unstyled my-4">
                                    <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                        <span>Investment Duration</span>
                                        <span class="text-success">{{ $item->duration }} days</span>
                                    </li>
                    
                                    <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                        <span>Min Investment</span>
                                        <span class="text-success">${{ number_format($item->minimum_amount, 2) }}</span>
                                    </li>
                    
                                    <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                        <span>Max Investment</span>
                                        <span class="text-success">${{ number_format($item->maximum_amount, 2) }}</span>
                                    </li>
                    
                                    <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                        <span>Total Profit</span>
                                        <span class="text-success">${{ number_format($item->minimum_amount * ($item->roi/100), 2) }} &dash; ${{ number_format($item->maximum_amount * ($item->roi/100), 2) }}</span>
                                    </li>
                                </ul>
                    
                                <div class="text-center">
                                    @if ($item->description)
                                        <p class="text-muted mb-4">
                                            {{ Str::limit($item->description, 40, '...') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-12">
                    <div class="text-center">
                        <h6 class="fw-bold">No Item found</h6>
                        <p class="text-muted">You have not created a service package yet</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="d-flex mt-4 justify-content-between flex-wrap">
        <h4 class="fw-bold">Investments</h4>
        <a href="{{ route('trader.investment.index') }}" class="text-success">View all</a>
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


    

    @push ('js')
        <script>
            var owl = $('.owl-carousel-2');
                owl.owlCarousel({
                    loop:true,
                    margin:10,
                    autoplay:true,
                    nav: false,
                    responsive:{
                        0:{
                            items:1
                        },
                        576:{
                            items:2
                        },
                        765:{
                            items:1
                        },
                        991:{
                            items:2
                        },
                    }
                });
        </script>
    @endpush
@endsection
