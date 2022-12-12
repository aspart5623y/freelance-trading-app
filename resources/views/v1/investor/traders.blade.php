@extends('layouts.investor')

@section('title', 'Traders')

@section('content')


    <div class="row">
        <div class="col-xl-3 col-lg-4 mb-4">
            <div class="card card-body border-0">
                <h5 class="fw-bold">Filter Search</h5>
                <form method="get" action="{{ route('investor.trader.search') }}">
                    @csrf
                   
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" placeholder="Enter name" name="name" value="{{ $data ? $data['name'] : '' }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Country</label>
                        <select name="nationality" class="form-select">
                            <option value="">Select country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country }}" {{ $data ? ($data['nationality'] == $country ? 'selected' : '') : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select gender</option>
                            <option value="male" {{ $data ? ($data['gender'] == "male" ? 'selected' : '') : '' }}>male</option>
                            <option value="female" {{ $data ? ($data['gender'] == "female" ? 'selected' : '') : '' }}>female</option>
                        </select>
                    </div>

                    <p class="text-muted">Rating</p>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="form-group mb-3">
                                <label for="">Min</label>
                                <select name="min_rating" id="" class="form-select">
                                    <option value="">Select minimum rating</option>
                                    <option value="1" {{ $data ? ($data['min_rating'] == "1" ? 'selected' : '') : '' }}>1</option>
                                    <option value="2" {{ $data ? ($data['min_rating'] == "2" ? 'selected' : '') : '' }}>2</option>
                                    <option value="3" {{ $data ? ($data['min_rating'] == "3" ? 'selected' : '') : '' }}>3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="form-group mb-3">
                                <label for="">Max</label>
                                <select name="max_rating" id="" class="form-select">
                                    <option value="">Select minimum rating</option>
                                    <option value="3" {{ $data ? ($data['max_rating'] == "3" ? 'selected' : '') : '' }}>3</option>
                                    <option value="4" {{ $data ? ($data['max_rating'] == "4" ? 'selected' : '') : '' }}>4</option>
                                    <option value="5" {{ $data ? ($data['max_rating'] == "5" ? 'selected' : '') : '' }}>5</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Liquidity</label>
                        <select name="liquidity" id="" class="form-select">
                            <option value="">Select liquidity</option>
                            <option value="low" {{ $data ? ($data['liquidity'] == "low" ? 'selected' : '') : '' }}>low</option>
                            <option value="medium" {{ $data ? ($data['liquidity'] == "medium" ? 'selected' : '') : '' }}>medium</option>
                            <option value="high" {{ $data ? ($data['liquidity'] == "high" ? 'selected' : '') : '' }}>high</option>
                        </select>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="">Liquidity Amount</label>
                        <input type="text" value="{{ $data ? $data['liquidity_amt'] : '' }}" name="liquidity_amt" placeholder="Enter liquidity amount" class="form-control">
                    </div>

                    
                    <button class="btn btn-success min-height w-100" type="submit">Filter</button>
                </form>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 mb-4">
            @if ($traders->count() > 0)
               <div class="row">
                 @foreach ($traders as $item)
                     <div class="col-xl-4 col-sm-6 mb-4">
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

               {{ $traders->links() }}
            @else
                <div class="col-12 mb-5">
                    <div>
                        <div class="text-center">
                            <h6 class="fw-bold">No Item found</h6>
                            <p class="text-muted">This service is unavailable at the moment. Please check back later</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
    </div>


@endsection

