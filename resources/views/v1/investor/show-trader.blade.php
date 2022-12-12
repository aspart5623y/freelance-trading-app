@extends('layouts.investor')

@section('title', 'Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            
            @if($profile->profileable_type == 'trader' && !$profile->profileable->verify)
                <div class="alert alert-warning" role="alert">
                    This trader's account have not been verified.
                </div>
            @endif

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-12 col-md-5">
            <div class="card card-body border-0 mb-4">
                <div class="flex-wrap justify-content-between align-items-end {{ $profile->profileable_type == 'admin' ? 'd-none' : 'd-flex' }}">
                    <div class="profile-img" style="background-image: url('{{ $profile->profileable->profile_img ? asset('profile-image/' . $profile->profileable_type . '/' . $profile->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')">
                    </div>
                    
                    <div>
                        <a href="{{ route('investor.trader.chat', $profile->id) }}" class="btn btn-light px-4"><i class="far fa-comment" aria-hidden="true"></i> &nbsp; Chat Trader</a>
                    </div>

                </div>
                <hr>
                <ul class="list-unstyled">
                    <li class="d-flex justify-content-between my-3">
                        <span class="fw-bold">Fullname</span>
                        <span class="text-muted">{{ $profile->profileable->firstname . ' ' . $profile->profileable->lastname }}</span>
                    </li>
                   
                    <li class="d-flex justify-content-between my-3">
                        <span class="fw-bold">Account type</span>
                        <span class="text-muted text-uppercase">{{ $profile->profileable_type }}</span>
                    </li>
                    <li class="d-flex justify-content-between my-3">
                        <span class="fw-bold">Account Status</span>
                        <span class="fw-bold p-1 {{ $profile->blocked ? 'text-bg-danger' : 'text-bg-success' }}">{{ $profile->blocked ? 'Blocked' : 'Active' }}</span>
                    </li>
                </ul>
            </div>
            <div class="mb-4">
                <a href="{{ route('investor.trader.packages', $profile->id) }}" class="btn btn-success w-100">View Packages</a>
            </div>
        </div>

        <div class="col-xl-8 col-lg-12 col-md-7">
            <div class="accordion" id="profileAccordion">
                <div class="accordion-item border-0 rounded overflow-hidden mb-4">
                    <button class="accordion-button bg-white text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h5 class="fw-bold mb-0" id="headingOne">
                            Profile Details
                        </h5>
                        
                    </button>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#profileAccordion">
                        <div class="accordion-body bg-white">
    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Firstname</small>
                                        <p>{{$profile->profileable->firstname}}</p>
                                    </div>
                                </div>
    
                                <div class="col-md-6" >
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Lastname</small>
                                        <p>{{$profile->profileable->lastname}}</p>
                                    </div>
                                </div>
                                

                                <div class="col-md-6" >
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Gender</small>
                                        <p>{{$profile->profileable->gender}}</p>
                                    </div>
                                </div>    


                                <div class="col-md-6" >
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Date of Birth</small>
                                        <p>{{$profile->profileable->date_of_birth}}</p>
                                    </div>
                                </div>    

                                <div class="col-md-6" >
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Nationality</small>
                                        <p>{{ $profile->profileable->nationality }}</p>
                                    </div>
                                </div>    


                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Expertise</small>
                                        <p>{{ $profile->profileable->expertise }}</p>
                                    </div>                                        
                                </div>  


                                <div class="col-md-6" >
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Percentage</small>
                                        <p>{{$profile->profileable->percentage}}%</p>
                                    </div>
                                </div>   
                                
                                

                                <div class="col-md-6" >
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Liquidity</small>
                                        <p>{{ $profile->profileable->liquidity}}</p>
                                    </div>
                                </div>    

                                <div class="col-md-6" >
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Liquidity Amount</small>
                                        <p>{{$profile->profileable->liquidity_amt}}</p>
                                    </div>
                                </div>   


                                <div class="col-md-6" >
                                    <div class="form-group mb-3">
                                        <small class="mb-1 text-muted">Rating</small> <br>
                                        @if ($profile->profileable->show_admin_rating)
                                            <small class="text-warning">
                                                @for($i = 1; $i <= $profile->profileable->admin_rating; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor

                                                @for($i = 1; $i <= (5 - $profile->profileable->admin_rating); $i++)
                                                    <i class="far fa-star"></i>
                                                @endfor
                                            </small>
                                        @else
                                            <small class="text-warning">
                                                @php
                                                    $rate = $profile->profileable->ratings->count() > 0 ? $profile->profileable->ratings()->sum('rating')/$profile->profileable->ratings()->count() : 0
                                                @endphp
                                                
                                                @for($i = 1; $i <= $rate; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor

                                                @for($i = 1; $i <= (5 - $rate); $i++)
                                                    <i class="far fa-star"></i>
                                                @endfor
                                            </small>
                                        @endif
                                    </div>
                                </div>   

                            </div>
                            
                        </div>
                    </div>
                </div>


            </div>

            @php
                $investments = \App\Models\Investment::where('investor_id', auth()->user()->profileable->id) 
                                                        ->where('trader_id', $profile->profileable->id)
                                                        ->count(); 

                $rating = \App\Models\Rating::where('investor_id', auth()->user()->profileable->id) 
                                                        ->where('trader_id', $profile->profileable->id)
                                                        ->first(); 
            @endphp

            @if ($investments > 0)
                <div class="card card-body border-0">
                    <h5 class="fw-bold">Rate this trader</h5>

                    @if ($rating)
                        <p>Last rating: &nbsp; <i class="fas text-warning fa-star" aria-hidden="true"></i> {{ $rating->rating }} rating.</p>
                    @endif

                    <form action="{{ route('investor.trader.rate') }}" method="post">
                        @csrf

                        <input type="hidden" name="investor_id" value="{{ auth()->user()->profileable->id }}">
                        <input type="hidden" name="trader_id" value="{{ $profile->profileable->id }}">

                        <div class="d-flex flex-wrap my-3">
                            <div class="form-check pe-4">
                                <input class="form-check-input" type="radio" name="rating" value="0" id="flexRadioDefault0">
                                <label class="form-check-label" for="flexRadioDefault0">
                                    0 star
                                </label>
                            </div>
                            <div class="form-check pe-4">
                                <input class="form-check-input" type="radio" name="rating" value="1" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    1 star
                                </label>
                            </div>
                            <div class="form-check pe-4">
                                <input class="form-check-input" type="radio" name="rating" value="2" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    2 star
                                </label>
                            </div>
                            <div class="form-check pe-4">
                                <input class="form-check-input" type="radio" name="rating" value="3" id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3">
                                    3 star
                                </label>
                            </div>
                            <div class="form-check pe-4">
                                <input class="form-check-input" type="radio" name="rating" value="4" id="flexRadioDefault4">
                                <label class="form-check-label" for="flexRadioDefault4">
                                    4 star
                                </label>
                            </div>
                            <div class="form-check pe-4">
                                <input class="form-check-input" type="radio" name="rating" value="5" id="flexRadioDefault5">
                                <label class="form-check-label" for="flexRadioDefault5">
                                    5 star
                                </label>
                            </div>
                        </div>

                        @error('rating')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>


                        <button type="submit" class="btn btn-success px-4">Submit Rating</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

@endsection