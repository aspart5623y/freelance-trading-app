<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tranzir</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/x-icon">
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    </head>
    <body>
        <!-- 
            *     P R E L O A D E R      *
        -->
        @include('includes.preloader')




        {{-- N A V B A R --}}
        <nav class="navbar navbar-light border-bottom navbar-expand-lg bg-white fixed-top">
            <div class="container">
                <a href="{{ route('index') }}" class="navbar-brand">
                    <img src="{{ asset('images/logo/logo.png') }}" width="170" alt="">
                </a>

                <button class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar-menu">
                    {{-- Navbar Menu --}}
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">Home</a>
                        </li>

                        @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Sign in</a>
                            </li>

                            <li class="nav-item d-lg-none">
                                <a href="{{ route('createAccount', ['account_type' => 'trader']) }}" class="nav-link">Create Account</a>
                            </li>
        
                            <li class="nav-item d-none d-lg-block">
                                <a href="{{ route('createAccount', ['account_type' => 'trader']) }}" class="btn btn-height btn-success">Create Account</a>
                            </li>
                        @else 
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Hello {{ Auth::user()->profileable->firstname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end border-0 shadow" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        Dashboard
                                    </a>

                                    <a class="dropdown-item" href="#logoutModal" data-bs-toggle="modal">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- M A S T H E A D --}}
        <section class="trader-masthead" id="masthead">
            <div class="container">
                <video class="w-100" autoplay muted loop id="myVideo">
                    <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
                    {{-- https://player.vimeo.com/external/483092798.sd.mp4?s=faf35de053e7dfdd51fd675c8006fa440f5a3687&profile_id=164&oauth2_token_id=57447761 --}}
                </video>
                <div class="masthead-content text-center text-white">
                    <h1 class="masthead-title">Work and earn as a freelance trader</h1>
                    <p class="">
                        Looking for the perfect jobs as a freelance trader?
                        Looking for the right investors, the best opportunities and clients? <br>
                        We got you covered
                        Register on our site to get connected to the global market, a good clientéle and investors base.
                    </p>
                    
                    <div>
                        <a href="{{ route('createAccount', ['account_type' => 'trader']) }}" class="btn btn-height btn-success px-4">Get Started</a>
                    </div>
                </div>
                <div class="masthead-overlay"></div>
            </div>
        </section>



        {{-- H O W    I T    W O R K S --}}
        <section class="section bg-white">
            <div class="container">
                <div class="text-center mb-4">
                    <h2 class="landing-title">How it works</h2>
                </div>

                <div class="row justify-content-between">
                    <div class="col-sm-4">
                        <div class="text-center my-3">
                            <i class="fas fa-briefcase text-muted display-5"></i>
                            <h2 class="fw-bold my-3">1. Create a service package</h2>
                            <p class="text-muted">
                                Join our freelance platform for free, create your Package, and promote your service to our extensive audience.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="text-center my-3">
                            <i class="fas fa-hand-holding-usd text-muted display-5"></i>
                            <h2 class="fw-bold my-3">2. Sell at amazing rates and ROI</h2>
                            <p class="text-muted">
                                Receive an alert when an investment is received, and use our system to communicate with clients about the trade.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="text-center my-3">
                            <i class="fas fa-check-circle text-muted display-5"></i>
                            <h2 class="fw-bold my-3">3. Earn</h2>
                            <p class="text-muted">
                                Receive payments consistently and on time. Once a payment has cleared, it can be withheld.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- S E T   U P     Y O U R     P R O F I L E --}}
        <section class="section bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="text-center mb-4">
                        <h2 class="landing-title">Set up your professional profile</h2>
                    </div>

                    <div class="col-lg-5 mb-3">
                        <img src="{{ asset('images/profile.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-7 mb-3">
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <div class="card position-relative h-100 py-4 border-0 card-body">
                                    <h4 class="fw-bold">Create account</h4>
                                    <p class="text-muted">
                                        Create a trader's account and complete your profile details.
                                    </p>

                                    <div class="position-absolute px-3 py-2 end-0 bottom-0">
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-4">
                                <div class="card position-relative h-100 py-4 border-0 card-body">
                                    <h4 class="fw-bold">KYC</h4>
                                    <p class="text-muted">
                                        Upload a valid identity card for verification 
                                    </p>

                                    <div class="position-absolute px-3 py-2 end-0 bottom-0">
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-4">
                                <div class="card position-relative h-100 py-4 border-0 card-body">
                                    <h4 class="fw-bold">Interview</h4>
                                    <p class="text-muted">
                                        Attend an online interview with our admin
                                    </p>

                                    <div class="position-absolute px-3 py-2 end-0 bottom-0">
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-4">
                                <div class="card position-relative h-100 py-4 border-0 card-body">
                                    <h4 class="fw-bold">Get Verified</h4>
                                    <p class="text-muted">
                                        You would be verified as soon as you are considered eligible. Then you proceed to creating your service packages.
                                    </p>

                                    <div class="position-absolute px-3 py-2 end-0 bottom-0">
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                        <i class="fa fa-circle text-success" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('createAccount', ['account_type' => 'trader']) }}" class="btn btn-height btn-success">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section bg-white">
            <div class="container">
                <div class="text-center">
                    <h2 class="text-muted">Sign up and start trading today</h2>
                    <a href="{{ route('createAccount', ['account_type' => 'trader']) }}" class="btn btn-success btn-height px-4">Get started</a>
                </div>
            </div>
        </section>
        



        {{-- F O O T E R --}}
        <footer class="bg-white py-5">
            <div class="container">

                <hr>
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="text-muted">
                        Copyright &copy; Tranzir {{ date("Y") }}. All rights Reserved. 
                    </div>


                    <ul class="list-unstyled d-flex flex-wrap">
                        <li class="m-3">
                            <a href="#" class="text-muted">How it works</a>
                        </li>

                        <li class="m-3">
                            <a href="{{ route('index') }}#contact" class="text-muted">Support</a>
                        </li>

                        <li class="m-3">
                            <a href="#" class="text-muted">Privacy Policy</a>
                        </li>
                    </ul>
                </div>

            </div>
        </footer>
        



        {{-- L O G O U T      M O D  A L --}}
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
                            <button class="btn btn-height btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                            
                            <a class="btn btn-height btn-danger px-4" href="{{ route('logout') }}"
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


         <!--Start of Tawk.to Script-->
         <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/638099d1b0d6371309d10d92/1gin5hnfo';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->


        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="{{ asset('js/font-awesome.min.js') }}"></script>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        
    </body>
</html>
