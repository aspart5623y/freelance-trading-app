@extends('layouts.investor')

@section('title', 'Packages')

@section('content')



    <div class="row">
        <div class="col-xl-3 col-lg-4 mb-4">
            <div class="card card-body border-0">
                <h5 class="fw-bold">Filter Search</h5>
                <form method="get" action="{{ route('investor.package.search') }}">
                    @csrf

                    <div class="form-group mb-2">
                        <label for="">Plan name</label>
                        <input type="text" name="title" value="{{ $data ? $data['title'] : '' }}" placeholder="Enter plan name" class="form-control">
                    </div>

                    <p class="text-muted mt-3 mb-1">Services</p>
                   
                    <div class="row">
                        @foreach ($services as $item)
                            <div class="col-4">
                                <div class="form-check mb-1">
                                    <input class="form-check-input" name="service_id[]" type="checkbox" value="{{ $item->id }}" id="{{ $item->id }}">
                                    <label class="form-check-label" for="{{ $item->id }}">
                                        {{ $item->title }}
                                    </label>
                                </div>
                            </div>
                            {{-- {{ $data ? $data['service_id'] : '' }} --}}
                        @endforeach
                    </div>
                      
                    
                    <p class="text-muted mt-4 mb-1">Roi</p>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="form-group mb-2">
                                <label for="">Min</label>
                                <div class="input-group">
                                    <input type="text" name="min_roi" placeholder="5" value="{{ $data ? $data['min_roi'] : '' }}" class="form-control">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="form-group mb-2">
                                <label for="">Max</label>
                                <div class="input-group">
                                    <input type="text" name="max_roi" placeholder="50" value="{{ $data ? $data['max_roi'] : '' }}" class="form-control">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>



                    <p class="text-muted mt-4 mb-1">Duration</p>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="form-group mb-2">
                                <label for="">Min</label>
                                <div class="input-group">
                                    <input type="text" name="min_duration" placeholder="7" value="{{ $data ? $data['min_duration'] : '' }}" class="form-control">
                                    <span class="input-group-text">days</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="form-group mb-2">
                                <label for="">Max</label>
                                <div class="input-group">
                                    <input type="text" name="max_duration" placeholder="30" value="{{ $data ? $data['max_duration'] : '' }}" class="form-control">
                                    <span class="input-group-text">days</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    
                    <p class="text-muted mt-4 mb-1">Investment Margin</p>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="form-group mb-2">
                                <label for="">Min</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="min_investment" placeholder="1.00" value="{{ $data ? $data['min_investment'] : '' }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="form-group mb-5">
                                <label for="">Max</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="max_investment" placeholder="1,000,000.00" value="{{ $data ? $data['max_investment'] : '' }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    
                    <button class="btn btn-success min-height w-100" type="submit">Filter</button>
                </form>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 mb-4">
            @if ($packages->count() > 0)
               <div class="row">
                 @foreach ($packages as $item)
                     <div class="col-xl-4 col-sm-6 mb-4">
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
                                     <span>Profit Margin</span>
                                     <span class="text-success">${{ number_format($item->minimum_amount * ($item->roi/100), 2) }} &dash; ${{ number_format($item->maximum_amount * ($item->roi/100), 2) }}</span>
                                 </li>
                
                                 <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                     <span>Daily Return</span>
                                     <span class="text-success">
                                         ${{ number_format(round(($item->minimum_amount * ($item->roi/100))/$item->duration, 2), 2) }} 
                                         &dash; ${{ number_format(round(($item->maximum_amount * ($item->roi/100))/$item->duration, 2), 2) }}    
                                     </span>
                                 </li> 
                             </ul>
                
                             <div class="text-center">
                                 @if ($item->description)
                                     <p class="text-muted mb-4">
                                         {{ Str::limit($item->description, 40, '...') }}
                                     </p>
                                 @endif
                             </div>
                
                             <a href="{{ route('investor.package.show', $item->id) }}" class="stretched-link"></a>
                         </div>
                     </div>
                 @endforeach
               </div>

               {{ $packages->links() }}
            @else
                <div class="col-12 mb-5">
                    <div>
                        <div class="text-center py-5">
                            <h6 class="fw-bold">No Item found</h6>
                            <p class="text-muted">This service is unavailable at the moment. Please check back later</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
    </div>


@endsection

