@extends('layouts.trader')

@section('title', 'Profile')

@section('content')
    
    <div class="row justify-content-center">

        <div class="col-md-6 mb-4">
            <div class="card card-body py-4 border-0 text-white text-center h-100 bg-primary">
                <h6 class="fw-bold">Wallet Balance</h6>
                <h1 class="mb-0">${{ number_format(auth()->user()->profileable->wallet_balance, 2) }}</h1>
            </div>
        </div>

        
        <div class="col-md-6 mb-4">
            <div class="card card-body py-4 border-0 text-white text-center h-100 bg-warning">
                <h6 class="fw-bold">Total Withdrawals</h6>
                <h1 class="mb-0">${{ number_format(auth()->user()->withdrawal()->where(function($query)
                    {
                        $query->where('status', 'approved')
                        ->whereMonth('created_at', Carbon\Carbon::now()->month)
                        ->whereYear('created_at', Carbon\Carbon::now()->year);
                    })->sum('amount'), 2) }}</h1>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12 col-md-5">
            <div class="card card-body border-0 mb-4">
                <div class="d-flex flex-wrap justify-content-between align-items-end">
                    <div class="position-relative">
                        <div class="profile-img" style="background-image: url('{{ auth()->user()->profileable->profile_img ? asset('profile-image/' . auth()->user()->profileable_type . '/' . auth()->user()->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')">
                        </div>
                        <a href="{{ route('trader.change.image') }}" class="profile-img-link">
                            <i class="fas fa-camera"></i>
                        </a>
                    </div>
                    
                    <div class="text-end">
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle px-0" type="button" data-bs-toggle="dropdown">Manage Accounts ({{ auth()->user()->account->count() }}) </button>

                            <div class="dropdown-menu border-0 shadow">
                                <a href="{{ route('trader.bank') }}" class="dropdown-item">Bank Account ({{ auth()->user()->account->where('account_type', 'bank')->count() }})</a>
                                <a href="{{ route('trader.paypal') }}" class="dropdown-item">Paypal ({{ auth()->user()->account->where('account_type', 'paypal')->count() }})</a>
                                <a href="{{ route('trader.crypto') }}" class="dropdown-item">Crypto ({{ auth()->user()->account->where('account_type', 'crypto')->count() }})</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <h6 class="fw-bold">Account address</h6>
                <div class="input-group border rounded">
                    <input type="text" disabled id="copyInput" class="form-control border-0 bg-white" value="{{ auth()->user()->id }}">
                    <button type="button" class="btn bg-white border border-0" onclick="copy()">copy &nbsp; <i class="fa fa-copy" aria-hidden="true"></i></button>
                </div>

                <hr>
                <ul class="list-unstyled">
                    <li class="d-flex justify-content-between my-3">
                        <span class="fw-bold">Fullname</span>
                        <span class="text-muted">{{ auth()->user()->profileable->firstname . ' ' . auth()->user()->profileable->lastname }}</span>
                    </li>
                    <li class="d-flex justify-content-between my-3">
                        <span class="fw-bold">Email</span>
                        <span class="text-muted">{{ auth()->user()->email }}</span>
                    </li>
                    <li class="d-flex justify-content-between my-3">
                        <span class="fw-bold">Account type</span>
                        <span class="text-muted text-uppercase">{{ auth()->user()->profileable_type }}</span>
                    </li>
                    <li class="d-flex justify-content-between my-3">
                        <span class="fw-bold">Account Status</span>
                        <span class="fw-bold p-1 {{ auth()->user()->blocked ? 'text-bg-danger' : 'text-bg-success' }}">{{ auth()->user()->blocked ? 'Blocked' : 'Active' }}</span>
                    </li>
                </ul>
            </div>


            <div class="card card-body border-0 mb-4">
                <h5 class="fw-bold">Profile Level</h5>

                <ul class="list-unstyled profile-level">
                    <li class="level done">Create Account</li>
                    <li class="level {{ $complete_profile ? 'done' : ''}}">Complete Profile</li>
                    <li class="level {{ $complete_kyc ? 'done' : '' }}">KYC Verification</li>
                    <li class="level {{ $complete_meeting ? 'done' : '' }}">Google Meeting with admin</li>
                    <li class="level {{ auth()->user()->profileable->verify ? 'done' : '' }}">Admin Verification</li>
                </ul>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12 col-md-7">
            <div class="accordion" id="profileAccordion">
                <div class="accordion-item border-0 rounded overflow-hidden mb-4">
                    <button class="accordion-button text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h5 class="fw-bold mb-0" id="headingOne">
                            Profile Details
                        </h5>
                        
                        @if ($complete_profile)
                            &nbsp;
                            <i class="fas fa-check-circle text-success"></i>
                        @endif

                    </button>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#profileAccordion">
                        <div class="accordion-body bg-white">
                            <form action="{{ route('trader.update.profile') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Firstname</label>
                                            <input type="text" placeholder="Enter firstname" name="firstname" value="{{ old('firstname') ? old('firstname') : auth()->user()->profileable->firstname }}" class="form-control min-height @error('firstname') is-invalid @enderror">
                                
                                            @error('firstname')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Lastname</label>
                                            <input type="text" placeholder="Enter lastname" name="lastname" value="{{ old('lastname') ? old('lastname') : auth()->user()->profileable->lastname }}" class="form-control min-height @error('lastname') is-invalid @enderror">
                                
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
                                    <input type="email" placeholder="Enter email" name="email" value="{{ old('email') ? old('email') : auth()->user()->email }}" class="form-control min-height @error('email') is-invalid @enderror">
                                    <small class="text-muted d-block">(You would have to go through another verification process if you update their email address)</small>
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <hr>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Gender</label>
                                            <select name="gender" id="" class="form-select min-height @error('gender') is-invalid @enderror">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ auth()->user()->profileable->gender == 'male' ? 'selected' : '' }}>male</option>
                                                <option value="female" {{ auth()->user()->profileable->gender == 'female' ? 'selected' : '' }}>female</option>
                                            </select>
                                            @error('gender')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>    


                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Phone</label>
                                            <input type="text" placeholder="Enter phone" name="phone" value="{{ old('phone') ? old('phone') : auth()->user()->profileable->phone }}" class="form-control min-height @error('phone') is-invalid @enderror">

                                            @error('phone')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>                                        
                                    </div>    


                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Date of Birth</label>
                                            <input type="date" placeholder="Enter date of birth" name="date_of_birth" value="{{ old('date_of_birth') ? old('date_of_birth') : auth()->user()->profileable->date_of_birth }}" class="form-control min-height @error('date_of_birth') is-invalid @enderror">

                                            @error('date_of_birth')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>    

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Nationality</label>
                                            <select name="nationality" id="" class="form-select min-height @error('nationality') is-invalid @enderror">
                                                <option value="">Select country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country }}" {{ auth()->user()->profileable->nationality == $country ? 'selected' : '' }}>{{ $country }}</option>
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
                                            <textarea name="expertise" rows="5" class="form-control">{{ auth()->user()->profileable->expertise }}</textarea>

                                            @error('expertise')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>                                        
                                    </div>  


                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Percentage</label>
                                            <input type="text" placeholder="Enter percentage" name="percentage" value="{{ old('percentage') ? old('percentage') : auth()->user()->profileable->percentage }}" class="form-control min-height @error('percentage') is-invalid @enderror">

                                            @error('percentage')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>   
                                    
                                    

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Liquidity</label>
                                            <select name="liquidity" id="" class="form-select min-height @error('liquidity') is-invalid @enderror">
                                                <option value="">Select liquidity</option>
                                                <option value="low" {{ auth()->user()->profileable->liquidity == 'low' ? 'selected' : '' }}>low</option>
                                                <option value="medium" {{ auth()->user()->profileable->liquidity == 'medium' ? 'selected' : '' }}>medium</option>
                                                <option value="high" {{ auth()->user()->profileable->liquidity == 'high' ? 'selected' : '' }}>high</option>
                                            </select>
                                            @error('liquidity')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>    

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-1">Liquidity Amount</label>
                                            <input type="text" placeholder="Enter liquidity amount" name="liquidity_amt" value="{{ old('liquidity_amt') ? old('liquidity_amt') : auth()->user()->profileable->liquidity_amt }}" class="form-control min-height @error('liquidity_amt') is-invalid @enderror">

                                            @error('liquidity_amt')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>   
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-success px-4" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                {{-- K Y C    V E R I F I C A T I O N --}}
                <div class="accordion-item border-0 rounded overflow-hidden mb-4">
                    <button class="accordion-button text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h5 class="fw-bold mb-0">KYC Verification</h5>
                        @if ($complete_kyc)
                            &nbsp;
                            <i class="fas fa-check-circle text-success"></i>
                        @endif
                    </button>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                        <div class="accordion-body bg-white">
                            <form method="POST" action="{{ route('trader.update.kyc') }}" enctype="multipart/form-data">
                                @csrf
                                
                                @if ($complete_profile) 
                                    @if (auth()->user()->kyc)
                                        @if (auth()->user()->kyc->status == 'pending') 
                                            <p class="text-muted mb-">Upload a valid ID card for verification</p>

                                            <div class="alert alert-warning">
                                                Your KYC upload would be verified by our admin soon. 
                                            </div>
                                        
                                        @elseif(auth()->user()->kyc->status == 'rejected')
                                            <p class="text-danger text-start">
                                                <i class="fas fa-times-circle"></i> &nbsp; Your KYC upload was rejected. Upload a new ID for verification <br>
                                                <strong>Reason:</strong> {{ auth()->user()->kyc->reason }}
                                            </p>                             
                                        @elseif(auth()->user()->kyc->status == 'approved')
                                            <div class="text-center text-muted py-4">
                                                <i class="fas fa-check-circle text-success" style="font-size: 25px"></i>
                                                <p class="my-3">Your KYC Upload has been approved by our admin.</p>
                                            </div>                                                        
                                        @endif  
                                    @endif
                                
                                <div class="{{ auth()->user()->kyc && auth()->user()->kyc->status == 'approved' ? 'd-none' : '' }}">
                                    
                                    <div class="row">
                                        <!-- Type of ID -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Type of ID <span class="text-red">*</span></label>
                                                <select name="id_type" id="" class="form-select min-height @error('id_type') is-invalid @enderror">
                                                    <option value="">Select ID type</option>
                                                    <option value="national ID" {{ auth()->user()->kyc && auth()->user()->kyc->id_type == 'national ID' ? 'selected' : '' }}>National ID</option>
                                                    <option value="drivers licence" {{ auth()->user()->kyc && auth()->user()->kyc->id_type == 'drivers licence' ? 'selected' : '' }}>Drivers Licence</option>
                                                    <option value="international passport" {{ auth()->user()->kyc && auth()->user()->kyc->id_type == 'international passport' ? 'selected' : '' }}>International Passport</option>
                                                </select>
                                    
                                                @error('id_type')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <!-- ID number -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">ID number</label>
                                                @if(auth()->user()->kyc)
                                                    <input type="text" placeholder="Enter ID number" value="{{ old('id_number') ? old('id_number') : auth()->user()->kyc->id_number }}" name="id_number" class="form-control min-height @error('id_number') is-invalid @enderror" value="{{ old('firstname') }}">
                                                @else 
                                                    <input type="text" placeholder="Enter ID number" value="{{ old('id_number') }}" name="id_number" class="form-control min-height @error('id_number') is-invalid @enderror" value="{{ old('firstname') }}">
                                                @endif
                                                
                                                @error('id_number')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <!-- ID issue Date -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">ID issue Date <span class="text-red">*</span></label>
                                                @if(auth()->user()->kyc)
                                                    <input type="date" name="id_issue_date" value="{{ old('id_issue_date') ? old('id_issue_date') : auth()->user()->kyc->id_issue_date }}" class="form-control min-height @error('id_issue_date') is-invalid @enderror">
                                                @else 
                                                    <input type="date" name="id_issue_date" value="{{ old('id_issue_date') }}" class="form-control min-height @error('id_issue_date') is-invalid @enderror">
                                                @endif
                                                
                                                @error('id_issue_date')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <!-- ID Expiry Date -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">ID Expiry Date <span class="text-red">*</span></label>
                                                @if(auth()->user()->kyc)
                                                    <input type="date" name="id_expiry_date" value="{{ old('id_expiry_date') ? old('id_expiry_date') : auth()->user()->kyc->id_expiry_date }}" class="form-control min-height @error('id_expiry_date') is-invalid @enderror">
                                                @else 
                                                    <input type="date" name="id_expiry_date" value="{{ old('id_expiry_date') }}" class="form-control min-height @error('id_expiry_date') is-invalid @enderror">
                                                @endif
                                                
                                                @error('id_expiry_date')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <!-- Upload ID -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="" class="mb-1">Upload ID (front view) <span class="text-red">*</span></label>
                                                <input class="form-control @error('front_view') is-invalid @enderror" name="front_view" type="file" id="">
                                                <small class="text-muted">(The image should not be more than 2mb)</small>
                                    
                                                @error('front_view')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    
                                                <br>
                                                @if (auth()->user()->kyc) 
                                                    <img src="{{ asset('kyc/front_view') . '/' . auth()->user()->kyc->front_view }}" width="150" alt="">
                                                @endif
                                    
                                            </div>
                                        </div>
                                    
                                        <!-- Upload ID -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="" class="mb-1">Upload ID (rear view) <span class="text-red">*</span></label>
                                                <input class="form-control @error('rear_view') is-invalid @enderror" name="rear_view" type="file" id="">
                                                <small class="text-muted">(The image should not be more than 2mb)</small>
                                    
                                                @error('rear_view')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <br>
                                    
                                                @if (auth()->user()->kyc) 
                                                    <img src="{{ asset('kyc/rear_view') . '/' . auth()->user()->kyc->rear_view }}" width="150" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success px-4" {{ $complete_profile ? '' : 'disabled' }}>Upload</button>
                                    </div>
                                        
                                </div>

                                    
                                @else 
                                    <div class="text-center text-muted py-4">
                                        <i class="fas fa-lock" style="font-size: 25px"></i>
                                        <p class="my-3">Complete your profile to unlock KYC Verification</p>
                                    </div>
                                @endif

                            </form>


                        </div>
                    </div>
                </div>


                {{-- G O O G L E      M E E T I N G --}}
                <div class="accordion-item border-0 rounded overflow-hidden mb-4">
                    <button class="accordion-button text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h5 class="fw-bold mb-0">
                            Meeting with admin
                        </h5>
                        @if ($complete_meeting)
                            &nbsp;
                            <i class="fas fa-check-circle text-success"></i>
                        @endif
                    </button>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                        <div class="accordion-body bg-white d-block">
                            <div class="text-end">
                                <img src="{{ asset('images/logo/google_meet_icon.png') }}" alt="" class="" width="25">
                                <img src="{{ asset('images/logo/zoom-icon.png') }}" alt="" class="" width="50">
                            </div>
                            <p class="text-muted">
                                Part of your verification process requires you to have a meeting with the admin before you would be eligible to trade on this platform <br> 
                                You will recieve an email notification and the meeting information would be available below. <br>
                                Complete your KYC verification to unlock this level.
                            </p>
                            
                            @if (auth()->user()->profileable->meetingVerification)
                                @if (auth()->user()->profileable->meetingVerification->status == 'pending')
                                <div class="alert alert-warning">
                                    You have a meeting scheduled for {{ Carbon\Carbon::create(auth()->user()->profileable->meetingVerification->meeting_date)->format('l jS \of F Y') }} 
                                    on {{ Carbon\Carbon::create(auth()->user()->profileable->meetingVerification->meeting_time)->format('h:ia') }} with our admin.
                                    If you won't be available for the meeting, do well to send a mail to the admin <strong>support@tranzir.com</strong> stating your reason. <br>
                                    The button below would be made active when the time is due.
                                </div>
                                    <a href="{{ auth()->user()->profileable->meetingVerification->meeting_link }}" target="_blank" class="btn btn-success px-4 {{ auth()->user()->profileable->meetingVerification->meeting_date > date("Y-m-d") ? 'disabled' : '' }}">Join Meeting</a>
                                @elseif (auth()->user()->profileable->meetingVerification->status == 'successful')
                                    <span class="fw-bold p-1 text-capitalize text-success"><i class="fas fa-check-circle"></i> &nbsp; {{ auth()->user()->profileable->meetingVerification->status }}</span>                                
                                @elseif (auth()->user()->profileable->meetingVerification->status == 'cancelled')
                                    <span class="fw-bold p-1 text-capitalize text-danger"><i class="fas fa-exclamation-triangle"></i> &nbsp; {{ auth()->user()->profileable->meetingVerification->status }}</span>                                
                                @endif
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    @push('js')
        <script src="{{ asset('js/copy.js') }}"></script>
    @endpush

@endsection
