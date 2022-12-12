<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tranzir</title>
        <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/x-icon">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <style>
            body {
                background-color: var(--dashboard-bg);
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                
                
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    {{-- profile link --}}
                    <li class="nav-item dropdown position-relative">
                        <a id="navbarDropdown" class="nav-link d-flex align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="navbar-img me-sm-2" style="background-image: url('{{ auth()->user()->profileable->profile_img ? asset('profile-image/' . auth()->user()->profileable_type . '/' . auth()->user()->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')">
                            </span>
                            <span class="d-none d-sm-inline-flex px-2">{{ Auth::user()->profileable->firstname . ' ' . Auth::user()->profileable->lastname }}</>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end position-absolute border-0 shadow" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#logoutModal" data-bs-toggle="modal">
                                {{ __('Logout') }}
                            </a>

                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10">
    
                    <div class="card card-body border-0 text-center py-5">
                        
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        
                        <h2 class="fw-bold">{{ __('Verify Your Email Address') }}</h2>

            
                        <img src="{{ asset('images/auth/mail.svg') }}" class="d-block mx-auto my-4" width="150" alt="">
                        
                        <p class="">
                            Before proceeding, please click the button to request for a verification link. Then check your email <strong><q>{{ Auth::user()->email }}</q></strong> for it.
                        </p>

                        <form class="my-3" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-height">{{ __('click here to request for link') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="logoutModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold">Logout Prompt</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        
                        <p class="text-muted">Are you sure you want to logout?</p>
                        
                        <div class="text-end">
                            <button class="btn btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger px-4" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Confirm
                            </a>
                        
                        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>