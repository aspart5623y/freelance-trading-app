@extends('layouts.investor')

@section('title', 'Packages Details')

@section('content')

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card card-body border-0 h-100">
                <h3 class="fw-bold">{{ $package->title }} &dash; <span class="text-success fa-1x">{{ $package->roi }}% return in {{ $package->duration }} days</span></h3>
                <p class="text-muted">{{ $package->description }}</p>

                <ul class="px-0 mb-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <li class="d-flex justify-content-between py-2 mb-1">
                                <span><i class="far fa-clock text-muted" aria-hidden="true"></i> &nbsp; Investment Duration</span>
                                <span class="text-success">{{ $package->duration }} days</span>
                            </li>
                        </div>

                        <div class="col-sm-6">
                            <li class="d-flex justify-content-between py-2 mb-1">
                                <span><i class="fas fa-money-bill-alt text-muted"></i> &nbsp; Min Investment</span>
                                <span class="text-success">${{ number_format($package->minimum_amount, 2) }}</span>
                            </li>
                        </div>

                        <div class="col-sm-6">
                            <li class="d-flex justify-content-between py-2 mb-1">
                                <span><i class="fas fa-money-bill-wave text-muted"></i> &nbsp; Max Investment</span>
                                <span class="text-success">${{ number_format($package->maximum_amount, 2) }}</span>
                            </li>
                        </div>

                        <div class="col-sm-6">
                            <li class="d-flex justify-content-between py-2 mb-1">
                                <span><i class="fas fa-hand-holding-usd text-muted"></i> &nbsp; Daily Return</span>
                                <span class="text-success">${{ number_format(round(($package->minimum_amount * ($package->roi/100))/$package->duration, 2), 2) }} &dash; ${{ number_format(round(($package->maximum_amount * ($package->roi/100))/$package->duration, 2), 2) }}</span>
                            </li>
                        </div>

                        <div class="col-sm-6">
                            <li class="d-flex justify-content-between py-2 mb-1">
                                <span><i class="fas fa-hand-holding-usd text-muted"></i> &nbsp; Total Profit Margin</span>
                                <span class="text-success">${{ number_format($package->minimum_amount * ($package->roi/100), 2) }} &dash; ${{ number_format($package->maximum_amount * ($package->roi/100), 2) }}</span>
                            </li>
                        </div>
                    </div>
                </ul>
                <hr>


                <form action="{{ route('investor.investment.store') }}" id="transfer-form" method="post">
                    @csrf
                    <input type="hidden" name="investor_id" value="{{ auth()->user()->profileable->id }}">
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <input type="hidden" name="trader_id" value="{{ $package->trader->id }}">


                    <h4 class="fw-bold">Invest</h4>
                    <p class="text-muted text-lowercase">
                        Invest in this {{ $package->service->title }} plan and get 
                        between <span class="text-success">${{ number_format($package->minimum_amount * ($package->roi/100), 2) }} 
                            &dash; ${{ number_format($package->maximum_amount * ($package->roi/100), 2) }}</span> profit with 
                            <span class="text-success">
                                ${{ number_format(round(($package->minimum_amount * ($package->roi/100))/$package->duration, 2), 2) }} 
                                &dash; ${{ number_format(round(($package->maximum_amount * ($package->roi/100))/$package->duration, 2), 2) }}    
                            </span> as a daily return.
                    </p>

                    <div class="row">
                        <div class="col-xl-6 col-lg-8">
                            <div class="form-group mb-4">
                                <label for="" class="mb-1">Enter the amount you want to invest</label>
                                <div class="d-flex mt-3 justify-content-between">
                                    <small class="text-muted">${{ number_format($package->minimum_amount, 2) }}</small>
                                    <small class="text-muted">${{ number_format($package->maximum_amount, 2) }}</small>
                                </div>
                                <input type="range" min="{{ $package->minimum_amount }}" name="amount" max="{{ $package->maximum_amount }}" value="{{ $package->minimum_amount }}" id="range" class="form-range">
                            </div>
                        </div>

                        <div class="col-1"></div>

                        <div class="col-xl-6 col-lg-8">
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text px-4">$</span>
                                    <input type="text" placeholder="Amount" id="amount" data-min="{{ $package->minimum_amount }}" data-max="{{ $package->maximum_amount }}" value="{{ $package->minimum_amount }}" class="form-control min-height">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="submitBtn" data-bs-toggle="modal" data-bs-target="#checkPin" class="btn btn-success px-4">Proceed</button>
                </form>
            </div>
        </div>


        <div class="col-xl-4 col-lg-5">
            <div class="card card-body border-0 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold text-dark text-capitalize">{{ $package->service->title }}</h6>
                        <span class="text-muted">Packages</span> &nbsp; <span class="badge alert-success text-success">{{ $package->service->packages->count() > 1 ? $package->service->packages->count() - 1 . '+' : $package->service->packages->count()}}</span>
                    </div>
                    <div class="icon-container alert-{{ $package->service->color }}">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
                <a href="{{ route('investor.package.service', $package->service->id) }}" class="stretched-link"></a>
            </div>

            <div class="card card-body border-0 mb-4">
                <div class="text-center">
                    <div class="profile-img mx-auto mb-3" style="background-image: url('{{ $package->trader->profile_img ? asset('profile-image/' . $package->trader->profile->profileable_type . '/' . $package->trader->profile_img) : asset('/images/avatar/avatar.jpeg') }}')">
                    </div>
                    <h5 class="fw-bold mb-0">{{ $package->trader->firstname . ' ' . $package->trader->lastname }}</h5>
                    <p class="text-muted mb-0">{{ $package->trader->expertise }}</p>

                    @if ($package->trader->show_admin_rating)
                        <small class="text-warning">
                            @for($i = 1; $i <= $package->trader->admin_rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor

                            @for($i = 1; $i <= (5 - $package->trader->admin_rating); $i++)
                                <i class="far fa-star"></i>
                            @endfor
                        </small>
                    @else
                        <small class="text-warning">
                            
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </small>
                    @endif
                    <hr>
                    <span class="d-block text-start text-muted mb-2"> <i class="fas fa-location-arrow"></i> &nbsp; Location: &nbsp; {{ $package->trader->nationality }}</span>
                    <span class="d-block text-start text-muted mb-2"> <i class="fas fa-percentage"></i> &nbsp; Percentage: &nbsp; {{ $package->trader->percentage }}%</span>
                    <div class="row mt-4">
                        <div class="col-6">
                            <a href="{{ route('investor.trader.show', $package->trader->profile->id) }}" class="btn btn-success w-100"> <i class="fa fa-eye" aria-hidden="true"></i> &nbsp; View Profile</a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('investor.trader.chat', $package->trader->profile->id) }}" class="btn btn-light w-100"><i class="far fa-comment" aria-hidden="true"></i> &nbsp; Chat Trader</a>
                        </div>
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
        <script>
            $('#range').on('change', function() {
                $('#amount').val(($(this).val()))
                checkButton ()
            });


            $('#amount').on('keyup', function() {
                $('#range').val(($(this).val()))
                checkButton ()
            });


            function checkButton () { 
                $min = parseInt($('#amount').attr('data-min')) 
                $max = parseInt($('#amount').attr('data-max')) 
                $amount = parseInt($('#amount').val())
                

                if ($amount != "" && $amount != null) { 
                    if (!isNaN($amount)) { 
                        if ($amount < $min || $amount > $max) { 
                            $("#submitBtn").attr('disabled', true) 
                        } else { 
                            $("#submitBtn").attr('disabled', false) 
                        } 
                    } else { 
                        $("#submitBtn").attr('disabled', true) 
                    } 
                } else { 
                    $("#submitBtn").attr('disabled', true) 
                } 
            } 

        </script>


        <script src="{{ asset('js/validate-pin.js') }}"></script>
    @endpush

@endsection
