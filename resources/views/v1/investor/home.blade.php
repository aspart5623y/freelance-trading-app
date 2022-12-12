@extends('layouts.investor')

@section('title', 'Overview')

@section('content')

    {{-- O V E R V I E W     H E A D E R --}}
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5 my-4">
            <div class="card card-body h-100 border-0 d-block text-center">
                <div class="py-5 my-auto">
                    <h5>Hi {{ auth()->user()->profileable->firstname }},</h5>
                    <p class="fw-lighter">Find the best package for your budget.</p>
                    <a href="{{ route('investor.package.index') }}" class="btn btn-success px-4 btn-height">Get Matched</a>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7 my-4">
            <div class="card card-body h-100 border-0 d-block">
                <div class="row align-items-center">
                    <div class="col-xl-6">
                        <div class="py-5">
                            <h4>{{ auth()->user()->profileable->firstname }},</h4>
                            <h3 class="fw-bold text-muted">Here are some of our services you might be interested in.</h3>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        @if ($services->count() > 0)
                            <div class="owl-carousel owl-carousel-1 owl-theme">
                                @foreach ($services as $item)
                                    <div class="item">
                                        <div class="card card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="fw-bold text-dark text-capitalize">{{ $item->title }}</h6>
                                                    <span class="badge alert-success text-success">{{ $item->packages->count() > 1 ? $item->packages->count() - 1 . '+' : $item->packages->count()}}</span>
                                                </div>
                                                <div class="icon-container alert-{{ $item->color }}">
                                                    <i class="fas fa-briefcase"></i>
                                                </div>
                                            </div>

                                            <a href="{{ route('investor.package.service', $item->id) }}" class="stretched-link"></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center">
                                <h5 class="fw-bold text-muted">Coming Soon!</h5>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- POPULAR PACKAGES show packages that are more chosen by investors --}}
    <div class="d-flex justify-content-between mt-4 mb-2 flex-wrap">
        <h4 class="text-dark">Packages you may like.</h4>
        <a href="{{ route('investor.package.index') }}" class="text-success">View all</a>
    </div>

    @if ($packages)
        <div class="owl-carousel owl-carousel-2 owl-theme">
            @foreach ($packages as $item)
                <div class="item h-100">
                    <div class="card h-100 card-body border-0 py-5 d-block">
                        <div class="text-center">
                            <h6 class="text-uppercase fw-bold text-dark">{{ $item['title'] }}</h6>
                            <h2 class="fw-bold text-capitalize text-dark">{{ $item['roi'] }}% ROI</h2>
                            <span class="badge package-banner bg-{{ $item['service_color'] }}">{{ $item['service_title'] }}</span>
                        </div>


                        <ul class="list-unstyled my-4">
                            <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                <span>Investment Duration</span>
                                <span class="text-success">{{ $item['duration'] }} days</span>
                            </li>

                            <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                <span>Min Investment</span>
                                <span class="text-success">${{ number_format($item['minimum_amount'], 2) }}</span>
                            </li>

                            <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                <span>Max Investment</span>
                                <span class="text-success">${{ number_format($item['maximum_amount'], 2) }}</span>
                            </li>

                            <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                <span>Profit Margin</span>
                                <span class="text-success">${{ number_format($item['minimum_amount'] * ($item['roi']/100), 2) }} &dash; ${{ number_format($item['maximum_amount'] * ($item['roi']/100), 2) }}</span>
                            </li>

                            <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                <span>Daily Return</span>
                                <span class="text-success">
                                    ${{ number_format(round(($item['minimum_amount'] * ($item['roi']/100))/$item['duration'], 2), 2) }} 
                                    &dash; ${{ number_format(round(($item['maximum_amount'] * ($item['roi']/100))/$item['duration'], 2), 2) }}    
                                </span>
                            </li> 
                        </ul>

                        <div class="text-center">
                            @if ($item['description'])
                                <p class="text-muted mb-4">
                                    {{ Str::limit($item['description'], 40, '...') }}
                                </p>
                            @endif
                        </div>

                        <a href="{{ route('investor.package.show', $item['id']) }}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="col-12 mb-5">
            <div class="text-center">
                <h6 class="fw-bold">No Item found</h6>
                <p class="text-muted">This service is unavailable at the moment. Please check back later</p>
            </div>
        </div>
    @endif


    {{-- Our top experts == recommend trader's with 3 star an above --}}
    <div class="d-flex justify-content-between mt-4 mb-2 flex-wrap">
        <h4 class="text-dark">Our Top experts</h4>
        <a href="{{ route('investor.trader.index') }}" class="text-success">View all</a>
    </div>

    @if ($traders)
        <div class="owl-carousel mb-5 owl-carousel-2 owl-theme">
            {{-- Team member --}}
            @foreach ($traders as $item)
                <div class="item h-100">
                    <div class="card card-body h-100 border-0">
                        <div class="text-center">
                            <div class="profile-img mx-auto mb-3" style="background-image: url('{{ $item->profile_img ? asset('profile-image/' . $item->profile->profileable_type . '/' . $item->profile_img) : asset('/images/avatar/avatar.jpeg') }}')">
                            </div>
                            <h5 class="fw-bold mb-0">{{ $item->firstname . ' ' . $item->lastname }}</h5>
                            <p class="text-muted mb-0">{{ Str::limit($item->expertise, 40, '...') }}</p>

                            @if ($item->show_admin_rating)
                                <small class="text-warning">
                                    @for($i = 1; $i <= $item->admin_rating; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor

                                    @for($i = 1; $i <= (5 - $item->admin_rating); $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </small>
                            @else
                                <small class="text-warning">
                                    @php
                                        $rate = $item->ratings->count() > 0 ? $item->ratings()->sum('rating')/$item->ratings()->count() : 0
                                    @endphp
                                    
                                    @for($i = 1; $i <= $rate; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor

                                    @for($i = 1; $i <= (5 - $rate); $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </small>
                            @endif
                            <hr>
                            <span class="d-block text-start text-muted mb-2"> <i class="fas fa-location-arrow"></i> &nbsp; Location: &nbsp; {{ $item->nationality }}</span>
                            <span class="d-block text-start text-muted mb-2"> <i class="fas fa-percentage"></i> &nbsp; Percentage: &nbsp; {{ $item->percentage }}%</span>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <a href="{{ route('investor.trader.show', $item->profile->id) }}" class="btn btn-success w-100"> <i class="fa fa-eye" aria-hidden="true"></i> &nbsp; View Profile</a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('investor.trader.chat', $item->profile->id) }}" class="btn btn-light w-100"><i class="far fa-comment" aria-hidden="true"></i> &nbsp; Chat Trader</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            @endforeach
        </div>
    @else
        <h5 class="text-muted text-center mb-5">Coming Soon</h5>
    @endif
    
    <div class="card py-4 card-body border-0 bg-white text-dark">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4 col-md-5 order-md-1">
                <img src="{{ asset('images/laptop.png') }}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-6 col-md-7 order-md-0">
                <h5 class="fw-bold text-muted">Get mached with a Trader around you</h5>
                <h1 class="">Get matched with a trader in your country</h1>
                <a href="{{ route('investor.trader.index') }}" class="btn btn-success btn-height px-4">Get Started</a>
            </div>
        </div>
    </div>



    @push('js')
        <script>
            var owl = $('.owl-carousel-1');
                owl.owlCarousel({
                    loop:true,
                    margin:10,
                    autoplay:true,
                    nav: false,
                    responsive:{
                        0:{
                            items:2
                        },
                        992:{
                            items:3
                        },
                    }
                });

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
                        992:{
                            items:3
                        },
                        1200:{
                            items:4
                        },
                    }
                });
        </script>
    @endpush

@endsection
