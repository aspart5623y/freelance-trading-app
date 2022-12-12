@extends('layouts.investor')

@section('title', 'Trader\'s Packages')

@section('content')
    
    <div class="row">
        @if ($packages && $packages->count() > 0)
            @foreach ($packages as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 card-body border-0 py-5 d-block">
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
                                <span>Daily Return</span>
                                <span class="text-success">${{ number_format($item->minimum_amount * ($item->roi/100), 2) }} &dash; ${{ number_format($item->maximum_amount * ($item->roi/100), 2) }}</span>
                            </li>
                        </ul>

                        <div class="text-center">
                            @if ($item->description)
                                <p class="text-muted mb-4">
                                    {{ $item->description }}
                                </p>
                            @endif
                        </div>

                        <a href="#" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="text-center">
                    <h6 class="fw-bold">No Item found</h6>
                    <p class="text-muted">{{ $profile->profileable->firstname }} have not created a service package yet</p>
                </div>
            </div>
        @endif
    </div>


@endsection