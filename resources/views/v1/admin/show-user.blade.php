@extends('layouts.admin')

@section('title', 'Profile')

@section('content')
    <div class="py-5">
        <div class="container-fluid">

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
                            
                            <div class="text-end">
                                <h4 class="fw-bold mb-3">${{ number_format($profile->profileable->wallet_balance, 2) }}</h4>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle px-0" type="button" data-bs-toggle="dropdown">View Accounts ({{ $profile->account->count() }}) </button>
    
                                    <div class="dropdown-menu border-0 shadow">
                                        <a href="#bankModal" data-bs-toggle="modal" class="dropdown-item">Bank Account ({{ $profile->account->where('account_type', 'bank')->count() }})</a>
                                        <a href="#paypalModal" data-bs-toggle="modal" class="dropdown-item">Paypal ({{ $profile->account->where('account_type', 'paypal')->count() }})</a>
                                        <a href="#cryptoModal" data-bs-toggle="modal" class="dropdown-item">Crypto ({{ $profile->account->where('account_type', 'crypto')->count() }})</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between my-3">
                                <span class="fw-bold">Fullname</span>
                                <span class="text-muted">{{ $profile->profileable->firstname . ' ' . $profile->profileable->lastname }}</span>
                            </li>
                            <li class="d-flex justify-content-between my-3">
                                <span class="fw-bold">Email</span>
                                <span class="text-muted">{{ $profile->email }}</span>
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
                        <hr>
                        <div>
                            <button class="btn btn-danger px-4" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Account</button>
                            <button class="btn {{ $profile->blocked ? 'btn-success' : 'btn-danger' }} px-4" type="button" data-bs-toggle="modal" data-bs-target="#disableModal" {{ $profile->profileable->level === "admin" ? "disabled" : '' }}>{{ $profile->blocked ? 'Enable' : 'Disable' }}</button>
                        </div>
                    </div>

                    @if($profile->profileable_type == 'trader')
                        <div class="mb-4">
                            <a href="{{ route('admin.user.packages', $profile->id) }}" class="btn btn-success w-100">View Packages</a>
                        </div>
                    @endif
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
                                    @if ($profile->profileable_type == 'admin')
                                        <form action="{{ route('admin.user.updateAdmin', $profile->id) }}" method="POST">
                                    @elseif ($profile->profileable_type == 'investor')
                                        <form action="{{ route('admin.user.updateInvestor', $profile->id) }}" method="POST">
                                    @elseif ($profile->profileable_type == 'trader')
                                        <form action="{{ route('admin.user.updateTrader', $profile->id) }}" method="POST">
                                    @endif
                                            @csrf
                
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="mb-1">Firstname</label>
                                                    <input type="text" placeholder="Enter firstname" name="firstname" value="{{ old('firstname') ? old('firstname') : $profile->profileable->firstname }}" class="form-control min-height @error('firstname') is-invalid @enderror">
                
                                                    @error('firstname')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <div class="col-md-6" >
                                                <div class="form-group mb-3">
                                                    <label class="mb-1">Lastname</label>
                                                    <input type="text" placeholder="Enter lastname" name="lastname" value="{{ old('lastname') ? old('lastname') : $profile->profileable->lastname }}" class="form-control min-height @error('lastname') is-invalid @enderror">
                
                                                    @error('lastname')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Email</label>
                                            <input type="email" placeholder="Enter email" name="email" value="{{ old('email') ? old('email') : $profile->email }}" class="form-control min-height @error('email') is-invalid @enderror">
                                            <small class="text-muted d-block">(This {{ $profile->profileable_type }} would have to go through another verification if you update their email address)</small>
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <hr>

                                        @if($profile->profileable_type == 'admin')

                                            <div class="form-group mb-3">
                                                <label class="mb-1">Level</label>
                                                <select name="level" id="" class="form-select min-height @error('level') is-invalid @enderror">
                                                    <option value="support" {{ $profile->profileable->level == 'support' ? 'selected' : '' }}>Support</option>
                                                    <option value="manager" {{ $profile->profileable->level == 'manager' ? 'selected' : '' }}>Manager</option>
                                                </select>
                                                @error('level')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        @elseif($profile->profileable_type == 'investor')

                                            <div class="row">

                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Gender</label>
                                                        <select name="gender" id="" class="form-select min-height @error('gender') is-invalid @enderror">
                                                            <option value="">Select Gender</option>
                                                            <option value="male" {{ $profile->profileable->gender == 'male' ? 'selected' : '' }}>male</option>
                                                            <option value="female" {{ $profile->profileable->gender == 'female' ? 'selected' : '' }}>female</option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>    


                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Phone</label>
                                                        <input type="text" placeholder="Enter phone" name="phone" value="{{ old('phone') ? old('phone') : $profile->profileable->phone }}" class="form-control min-height @error('phone') is-invalid @enderror">
                    
                                                        @error('phone')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>                                        
                                                </div>    


                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Date of Birth</label>
                                                        <input type="date" placeholder="Enter date of birth" name="date_of_birth" value="{{ old('date_of_birth') ? old('date_of_birth') : $profile->profileable->date_of_birth }}" class="form-control min-height @error('date_of_birth') is-invalid @enderror">
                    
                                                        @error('date_of_birth')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>    

                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Nationality</label>
                                                        <select name="nationality" id="" class="form-select min-height @error('nationality') is-invalid @enderror">
                                                            <option value="">Select country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country }}" {{ $profile->profileable->nationality == $country ? 'selected' : '' }}>{{ $country }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('country')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>    


                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Addess</label>
                                                        <textarea name="address" rows="5" class="form-control">{{ old('address') ? old('address') : $profile->profileable->address }}</textarea>
                    
                                                        @error('address')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>                                        
                                                </div>    

                                            </div>

                                        @elseif($profile->profileable_type == 'trader')
                                            <div class="row">

                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Gender</label>
                                                        <select name="gender" id="" class="form-select min-height @error('gender') is-invalid @enderror">
                                                            <option value="">Select Gender</option> 
                                                            <option value="male" {{ $profile->profileable->gender == 'male' ? 'selected' : '' }}>male</option>
                                                            <option value="female" {{ $profile->profileable->gender == 'female' ? 'selected' : '' }}>female</option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>    


                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Phone</label>
                                                        <input type="text" placeholder="Enter phone" name="phone" value="{{ old('phone') ? old('phone') : $profile->profileable->phone }}" class="form-control min-height @error('phone') is-invalid @enderror">
                    
                                                        @error('phone')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>                                        
                                                </div>    


                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Date of Birth</label>
                                                        <input type="date" placeholder="Enter date of birth" name="date_of_birth" value="{{ old('date_of_birth') ? old('date_of_birth') : $profile->profileable->date_of_birth }}" class="form-control min-height @error('date_of_birth') is-invalid @enderror">
                    
                                                        @error('date_of_birth')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>    

                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Nationality</label>
                                                        <select name="nationality" id="" class="form-select min-height @error('nationality') is-invalid @enderror">
                                                            <option value="">Select country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country }}" {{ $profile->profileable->nationality == $country ? 'selected' : '' }}>{{ $country }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('nationality')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>    


                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Expertise</label>
                                                        <textarea name="expertise" rows="5" class="form-control">{{ $profile->profileable->expertise }}</textarea>
                    
                                                        @error('expertise')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>                                        
                                                </div>  


                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Percentage</label>
                                                        <input type="text" placeholder="Enter percentage" name="percentage" value="{{ old('percentage') ? old('percentage') : $profile->profileable->percentage }}" class="form-control min-height @error('percentage') is-invalid @enderror">
                    
                                                        @error('percentage')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>   
                                                
                                                

                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Liquidity</label>
                                                        <select name="liquidity" id="" class="form-select min-height @error('liquidity') is-invalid @enderror">
                                                            <option value="">Select liquidity</option>
                                                            <option value="low" {{ $profile->profileable->liquidity == 'low' ? 'selected' : '' }}>low</option>
                                                            <option value="medium" {{ $profile->profileable->liquidity == 'medium' ? 'selected' : '' }}>medium</option>
                                                            <option value="high" {{ $profile->profileable->liquidity == 'high' ? 'selected' : '' }}>high</option>
                                                        </select>
                                                        @error('liquidity')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>    

                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Liquidity Amount</label>
                                                        <input type="text" placeholder="Enter liquidity amount" name="liquidity_amt" value="{{ old('liquidity_amt') ? old('liquidity_amt') : $profile->profileable->liquidity_amt }}" class="form-control min-height @error('liquidity_amt') is-invalid @enderror">
                    
                                                        @error('liquidity_amt')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>   


                                                <div class="col-md-6" >
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Rating</label>
                                                        <select name="admin_rating" id="" class="form-select min-height @error('admin_rating') is-invalid @enderror">
                                                            <option value="0" {{ $profile->profileable->admin_rating == '0' ? 'selected' : '' }}>0</option>
                                                            <option value="1" {{ $profile->profileable->admin_rating == '1' ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $profile->profileable->admin_rating == '2' ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $profile->profileable->admin_rating == '3' ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $profile->profileable->admin_rating == '4' ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $profile->profileable->admin_rating == '5' ? 'selected' : '' }}>5</option>
                                                        </select>
                    
                                                        @error('admin_rating')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>   


                                                <div class="col-md-6 align-self-end">
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Show Admin Rating</label>
                                                        <select name="show_admin_rating" id="" class="form-select min-height @error('show_admin_rating') is-invalid @enderror">
                                                            <option value="0" {{ $profile->profileable->show_admin_rating == '0' ? 'selected' : '' }}>No</option>
                                                            <option value="1" {{ $profile->profileable->show_admin_rating == '1' ? 'selected' : '' }}>Yes</option>
                                                        </select>
                                                                
                                                        @error('show_admin_rating')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>   

                                            </div>
                                        @endif
                
                                            
                                        <div class="text-end">
                                            <button class="btn btn-success px-4" type="submit">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        @if($profile->profileable_type == 'trader' || $profile->profileable_type == 'investor')
                            <div class="accordion-item border-0 rounded overflow-hidden mb-4">
                                <button class="accordion-button text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h5 class="fw-bold mb-0">KYC Verification</h5>
                                    
                                </button>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                                    <div class="accordion-body bg-white">
                                        <form action="{{ route('admin.user.approveKYC', $profile->id) }}" method="post">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="bg-light rounded p-2 mb-4">
                                                        <small class="text-muted">Type of ID</small>
                                                        <p class="mb-0">{{ $profile->kyc ? $profile->kyc->id_type : '' }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="bg-light rounded p-2 mb-4">
                                                        <small class="text-muted">ID number</small>
                                                        <p class="mb-0">{{ $profile->kyc ? $profile->kyc->id_number : '' }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="bg-light rounded p-2 mb-4">
                                                        <small class="text-muted">ID issue Date</small>
                                                        <p class="mb-0">{{ $profile->kyc ? $profile->kyc->id_issue_date : '' }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="bg-light rounded p-2 mb-4">
                                                        <small class="text-muted">ID Expiry Date</small>
                                                        <p class="mb-0">{{ $profile->kyc ? $profile->kyc->id_expiry_date : '' }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="bg-light rounded p-2 mb-4">
                                                        <small class="text-muted">Upload ID (front view)</small>
                                                        @if($profile->kyc)
                                                            <a target="_blank" href="{{ asset('kyc/front_view') . '/' . $profile->kyc->front_view }}" class="d-block text-center">
                                                                <img src="{{ asset('kyc/front_view') . '/' . $profile->kyc->front_view }}" width="150" alt="">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="bg-light rounded p-2 mb-4">
                                                        <small class="text-muted">Upload ID (rear view)</small>
                                                        @if($profile->kyc)
                                                            <a target="_blank" href="{{ asset('kyc/rear_view') . '/' . $profile->kyc->rear_view }}" class="d-block text-center">
                                                                <img src="{{ asset('kyc/rear_view') . '/' . $profile->kyc->rear_view }}" width="150" alt="">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="text-end">
                                                @if ($profile->kyc)
                                                    @if ($profile->kyc->status == 'pending') 
                                                        <form action="{{ route('admin.user.approveKYC', $profile->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success px-4">Approve</button>
                                                        </form>

                                                        <button class="btn btn-danger px-4" type="button" data-bs-toggle="modal" data-bs-target="#rejectKycModal">Reject</button>
                                                    @elseif($profile->kyc->status == 'approved')
                                                        <span class="fw-bold p-1 text-success"><i class="fas fa-check-circle"></i> &nbsp; {{ $profile->kyc->status }}</span>                                
                                                    @elseif($profile->kyc->status == 'rejected')
                                                        <span class="fw-bold p-1 text-danger"><i class="fas fa-exclamation-triangle"></i> &nbsp; {{ $profile->kyc->status }}</span>   
                                                        <p class="text-muted text-start"><strong>Reason:</strong>{{ $profile->kyc->reason }}</p>                             
                                                    @endif
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($profile->profileable_type == 'trader')
                            <div class="accordion-item border-0 rounded overflow-hidden mb-4">
                                <button class="accordion-button text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <h5 class="fw-bold mb-0">
                                        Schedule a meeting with {{ $profile->profileable->firstname }}
                                    </h5>
                                </button>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                                    <div class="accordion-body bg-white">
                                       
                                        <p class="text-muted">
                                            Part of a trader's verification process requires you to have a meeting with the him/herq before he/she would be eligible to trade on this platform <br> 
                                                Create a meeting link using <img src="{{ asset('images/logo/google_meet_icon.png') }}" alt="" class="" width="15"> google or <img src="{{ asset('images/logo/zoom-icon.png') }}" alt="" class="" width="25"> zoom, copy and paste the meeting link in the form below. <br>
                                            {{ $profile->profileable->firstname }} would recieve an automatic meeting invitation mail.
                                        </p>


                                        <form action="{{ route('admin.user.scheduleMeeting', $profile->profileable->id) }}" method="post">
                                            @csrf

                                            <input type="hidden" name="admin_id" value="{{ auth()->user()->profileable->id }}">
                                            <input type="hidden" name="trader_id" value="{{ $profile->profileable->id }}">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label class="mb-1">Meeting Date</label>
                                                        <input type="date" name="meeting_date" placeholder="Enter meeting date" value="{{ old('meeting_date') ? old('meeting_date') : ($profile->profileable->meetingVerification ? $profile->profileable->meetingVerification->meeting_date : '') }}" class="form-control min-height @error('meeting_date') is-invalid @enderror">

                                                        @error('meeting_date')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label class="mb-1">Meeting Time</label>
                                                        <input type="time" name="meeting_time" placeholder="Enter meeting time" value="{{ old('meeting_time') ? old('meeting_time') : ($profile->profileable->meetingVerification ? $profile->profileable->meetingVerification->meeting_time : '') }}" class="form-control min-height @error('meeting_time') is-invalid @enderror">
                                                        @error('meeting_time')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label class="mb-1">Meeting Link</label>
                                                        <input type="text" name="meeting_link" placeholder="Enter meeting link" value="{{ old('meeting_link') ? old('meeting_link') : ($profile->profileable->meetingVerification ? $profile->profileable->meetingVerification->meeting_link : '') }}" class="form-control min-height @error('meeting_link') is-invalid @enderror">

                                                        @error('meeting_link')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 align-self-end">
                                                    <div class="text-end mb-4">
                                                        @if ($profile->profileable->meetingVerification)
                                                            <span class="fw-bold text-success"><i class="fas fa-check-circle"></i> &nbsp; Meeting initation sent</span>
                                                        @else
                                                            <button type="submit" class="btn btn-success px-4">Send</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        @if ($profile->profileable->meetingVerification)
                                            <hr />

                                            <h5 class="fw-bold">Meeting actions</h5>
                                            <p class="text-muted">Was the meeting successful? You can click the <strong class="text-success"><q>Done</q></strong> button. 
                                                Or do you click <strong class="text-danger"><q>Cancel</q></strong> button to cancel the meeting? Remember you cannot cancel a meeting 12hours before meeting time.
                                            </p>
                                            <div class="text-end mb-4">
                                                @if ($profile->profileable->meetingVerification->status == 'pending') 
                                                    <form action="{{ route('admin.user.doneMeeting', ['trader' => $profile->profileable->id, 'meeting' => $profile->profileable->meetingVerification->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success px-4">Done</button>
                                                    </form>

                                                    <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#cancelMeetingModal">Cancel</button>
                                                @elseif ($profile->profileable->meetingVerification->status == 'successful')
                                                    <span class="fw-bold p-1 text-capitalize text-success"><i class="fas fa-check-circle"></i> &nbsp; {{ $profile->profileable->meetingVerification->status }}</span>                                
                                                @elseif ($profile->profileable->meetingVerification->status == 'cancelled') 
                                                    <span class="fw-bold p-1 text-capitalize text-danger"><i class="fas fa-exclamation-triangle"></i> &nbsp; {{ $profile->profileable->meetingVerification->status }}</span>                                
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 rounded overflow-hidden mb-4">
                                <button class="accordion-button text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <h5 class="fw-bold mb-0">
                                        Verify Trader
                                    </h5>
                                </button>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                                    <div class="accordion-body bg-white d-block">
                                        <p class="text-muted">Have you verified that this trader's information is true and this trader is not a robot?</p>
                                        @if ($profile->profileable->verify)
                                            <span class="fw-bold text-success"><i class="fas fa-check-circle"></i> &nbsp; Verified</span>
                                        @else
                                            <button class="btn btn-info px-4" type="button" data-bs-toggle="modal" data-bs-target="#verifyModal">Verify Account</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>









    

    <div class="modal fade" id="rejectKycModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Reject KYC Prompt</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">
                        Are you sure you want to reject {{ $profile->profileable->firstname . ' ' . $profile->profileable->lastname }}'s KYC? <br>
                        If <strong><q>yes</q></strong>, please state your reason below.
                    </p>
                    
                    <form action="{{ route('admin.user.rejectKYC', $profile->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="" class="mb-1">Reason</label>
                            <textarea name="reason" rows="4" placeholder="Reason" class="form-control @error('reason') is-invalid @enderror">{{ old('reason') ? old('reason') : ($profile->kyc ? $profile->kyc->reason : '') }}</textarea>
                            @error('reason')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button class="btn btn-danger px-4">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="verifyModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Verify Trader Prompt</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">Are you sure you want to verify {{ $profile->profileable->firstname . ' ' . $profile->profileable->lastname }}'s account?</p>
                    
                    <div class="text-end">
                        <button class="btn btn-light text-info px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-info px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('verify-form').submit();">
                            Confirm
                        </a>
                    
                        <form id="verify-form" action="{{ route('admin.trader.verify') }}" method="POST" class="d-none">
                            @csrf
                            <input type="text" name="user_id" id="userId" value="{{ $profile->profileable->id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Delete Account Prompt</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">Are you sure you want to delete {{ $profile->profileable->firstname . ' ' . $profile->profileable->lastname }}'s account?</p>
                    
                    <div class="text-end">
                        <button class="btn btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">
                            Confirm
                        </a>
                    
                        <form id="delete-form" action="{{ route('admin.user.delete') }}" method="POST" class="d-none">
                            @csrf
                            <input type="text" name="user_id" id="userId" value="{{ $profile->id }}">
                            <input type="text" name="type" id="" value="{{ $profile->profileable_type }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if ($profile->profileable_type == 'trader' && $profile->profileable->meetingVerification)
        <div class="modal fade" id="cancelMeetingModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold">Cancel Meeting Prompt</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        
                        <p class="text-muted">Are you sure you want to cancel your meeting with {{ $profile->profileable->firstname . ' ' . $profile->profileable->lastname }}</p>
                        
                        <div class="text-end">
                            <button class="btn btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger px-4" href="#"
                                onclick="event.preventDefault();
                                            document.getElementById('cancel-meeting-form').submit();">
                                Confirm
                            </a>
                        
                            <form id="cancel-meeting-form" action="{{ route('admin.user.cancelMeeting', ['trader' => $profile->profileable->id, 'meeting' => $profile->profileable->meetingVerification->id]) }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    
    <div class="modal fade" id="disableModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">{{ $profile->blocked ? 'Enable' : 'Disable' }} Prompt</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">Are you sure you want to {{ $profile->blocked ? 'enable' : 'disable' }} this account?</p>
                    
                    <div class="text-end">
                        <button class="btn btn-light {{ $profile->blocked ? 'text-success' : 'text-danger' }} px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn {{ $profile->blocked ? 'btn-success' : 'btn-danger' }} px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('disabled-form').submit();">
                            Confirm
                        </a>
                    
                        <form id="disabled-form" action="{{ route('admin.user.disable') }}" method="POST" class="d-none">
                            @csrf
                            <input type="text" name="user_id" id="userId" value="{{ $profile->id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="cryptoModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">{{ $profile->profileable->firstname }}'s Crypto Wallets</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    @if ($profile->account->where('account_type', 'crypto')->count() > 0)
                        @foreach ($profile->account as $item)
                            @if ($item->crypto)
                            <hr>
                                <div>
                                    <div class="row align-items-center">
                                        <div class="col-sm-3">
                                            <small class="text-muted fw-bold">Coin name</small>
                                            <h6>{{ $item->crypto->coin }}</h6>
                                        </div>
                                    
                                        <div class="col-sm-9">
                                            <small class="text-muted fw-bold">Wallet Address</small>
                                            <h6>{{ $item->crypto->wallet_address }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <hr>
                        <p class="text-muted text-center fw-bold">{{ $profile->profileable->firstname }} have not added any crypto wallet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="bankModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">{{ $profile->profileable->firstname }}'s Bank Account</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    @if ($profile->account->where('account_type', 'bank')->count() > 0)
                        @foreach ($profile->account as $item)
                            @if ($item->bank)
                                <hr>
                                <div>
                                    <div class="row align-items-center">
                                        <div class="col-sm-6">
                                            <small class="text-muted fw-bold">Account Name</small>
                                            <h6>{{ $item->bank->account_name }}</h6>
                                        </div>
                                    
                                        <div class="col-sm-3">
                                            <small class="text-muted fw-bold">Bank Name</small>
                                            <h6>{{ $item->bank->bank_name }}</h6>
                                        </div>
                                    
                                        <div class="col-sm-3">
                                            <small class="text-muted fw-bold">Account Number</small>
                                            <p>{{ $item->bank->account_number }}</p>
                                        </div>
                                    </div>
                                    @if ($item->bank->code)
                                        <span>Routing/Swift/Iban Code: {{ $item->bank->code }}</span>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @else
                        <hr>
                        <p class="text-muted text-center fw-bold">{{ $profile->profileable->firstname }} have not added any Bank account</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="paypalModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">{{ $profile->profileable->firstname }}'s Paypal Account</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    @if ($profile->account->where('account_type', 'paypal')->count() > 0)
                        @foreach ($profile->account as $item)
                            @if ($item->paypal)
                                <hr>
                                <div>
                                    <button class="btn float-end text-danger delete-btn" id="{{ $item->id }}">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    <div class="row align-items-center">
                                        <div class="col-sm-6">
                                            <small class="text-muted fw-bold">Account Name</small>
                                            <h6>{{ $item->paypal->account_name }}</h6>
                                        </div>
                                    
                                        <div class="col-sm-6">
                                            <small class="text-muted fw-bold">Account Email</small>
                                            <h6>{{ $item->paypal->account_email }}</h6>
                                        </div>
                                    
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <hr>
                        <p class="text-muted text-center fw-bold">{{ $profile->profileable->firstname }} have not added any paypal account</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection