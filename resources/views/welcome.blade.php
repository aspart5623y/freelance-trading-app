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
        <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/owl.theme.default.min.css') }}">

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
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="#masthead" class="nav-link">Home</a>
                        </li>
    
                        <li class="nav-item">
                            <a href="#about" class="nav-link">About Us</a>
                        </li>
    
                        <li class="nav-item">
                            <a href="#services" class="nav-link">Services</a>
                        </li>
    
                        <li class="nav-item">
                            <a href="#team" class="nav-link">Our Team</a>
                        </li>
    
                        <li class="nav-item">
                            <a href="{{ route('contact.index') }}" class="nav-link">Contact Us</a>
                        </li>

                        
                        @guest
                            <li class="nav-item d-block d-lg-none">
                                <a href="{{ route('welcome.trader') }}" class="nav-link">Become a Trader</a>
                            </li>

                            <li class="nav-item d-block d-lg-none">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>

                            <li class="nav-item d-block d-lg-none">
                                <a href="{{ route('register') }}" class="nav-link">Create Account</a>
                            </li>
                        @else 
                            <li class="nav-item dropdown d-block d-lg-none">
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

                    {{-- Navbar Menu --}}
                    <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('welcome.trader') }}" class="nav-link">Become a Trader</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Sign in</a>
                            </li>
        
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-height btn-success">Create Account</a>
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
        <section class="masthead" id="masthead">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background: url('{{ asset('images/smile-2.jpg') }}')">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4">
                                    <div class="masthead-content text-white">
                                        <div>
                                            <h1 class="masthead-title">Hire the perfect freelance trader</h1>
                                            <p class="">
                                                No experience in the capital and foreign exchange market does not equal investment failures with the perfect professional traders <br>
                                                Register on our site and get connected with the perfect freelance trader with quality experience, that is the right investment decision to make, at tranzir.com, we help you make that right investment decision
                                            </p>
                                            
                                            <a href="{{ route('register') }}" class="btn btn-height btn-success px-4">Get Started</a>
                                        </div>
                                    </div>
                                    <div class="masthead-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="background: url('{{ asset('images/smile-1.jpg') }}')">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4">
                                    <div class="masthead-content text-white">
                                        <div>
                                            <h1 class="masthead-title">Great Return on Investments</h1>
                                            <p class="">
                                                Yes! A lot of capital loss, wrong investment moves with little or no profit can be averted 
                                                Yes! You can make the right investment with huge profits
                                                Register on our site and have that gap between you and the right investments bridged
                                            </p>
                                            <a href="{{ route('register') }}" class="btn btn-height btn-success px-4">Get Started</a>
                                        </div>
                                    </div>
                                    <div class="masthead-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </section>


        {{-- A B O U T --}}
        <section class="section bg-light" id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center">
                            <h2 class="landing-title">About Us</h2>
                            <p class="text-muted">
                                As a global bridge to the right investment, quality traders and clientéle, tranzir.com also offers opportunities to interact with potential investors and build a wealth chain. We have built an eco friendly space where experience meets opportunities
                                Get started today and connect to Wealth and the right human Resource(s).
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- S E R V I C E S --}}
        <section class="section bg-white" id="services">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6 order-lg-1 my-3">
                        <img src="{{ asset('images/trader.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-5 order-lg-0 my-3">
                        <div class="text-center">
                            <h2 class="landing-title">What we do</h2>
                        </div>

                        <ul class="list-unstyled">
                            <li class="text-muted d-block mb-4">
                                <h5 class="fw-bold text-dark text-capitalize mb-1">
                                    <i class="fas fa-check-circle text-success"></i>
                                    &nbsp;
                                    Funds security
                                </h5> 
                                <span class="text-muted">
                                    Security of investors funds is our top priority as traders provide quality KYC, video verification, liquidity and valid and up to date credentials before approval on our platform
                                </span>
                            </li>

                            <li class="text-muted d-block mb-4">
                                <h5 class="fw-bold text-dark text-capitalize mb-1">
                                    <i class="fas fa-check-circle text-success"></i>
                                    &nbsp;
                                    24/7 Help &amp; Support
                                </h5> 
                                <span class="text-muted">
                                    Questions? Our 24/7 support staff is ready to assist you at any time, anywhere.
                                </span>
                            </li>

                            <li class="text-muted d-block mb-4">
                                <h5 class="fw-bold text-dark text-capitalize mb-1">
                                    <i class="fas fa-check-circle text-success"></i>
                                    &nbsp;
                                    Secure payments each and every time
                                </h5> 
                                <span class="text-muted">
                                    We release your funds at your approval to our trusted traders.
                                </span>
                            </li>

                            <li class="text-muted d-block mb-4">
                                <h5 class="fw-bold text-dark text-capitalize mb-1">
                                    <i class="fas fa-check-circle text-success"></i>
                                    &nbsp;
                                    Quick, high-quality work
                                </h5> 
                                <span class="text-muted">
                                    Within minutes, locate the ideal freelancer to trade with.
                                </span>
                            </li>

                            <li class="text-muted d-block mb-4">
                                <h5 class="fw-bold text-dark text-capitalize mb-1">
                                    <i class="fas fa-check-circle text-success"></i>
                                    &nbsp;
                                    the ideal price range
                                </h5> 
                                <span class="text-muted">
                                    Find top-notch service plan at all pricing ranges. Nothing except project-based pricing; no hourly charges.
                                </span>
                            </li>

                           
                        </ul>
                    </div>
                </div>
            </div>
        </section>
                    
        
        {{-- T E A M --}}
        <section class="section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="landing-title">Our Team</h2>
                    <p class="text-muted">Meet our team of experienced traders</p>
                </div>

                @if ($traders)
                    <div class="owl-carousel mb-5 owl-carousel-1 owl-theme">
                        {{-- Team member --}}
                        @foreach ($traders as $item)
                            <div class="item h-100">
                                <div class="card card-body h-100 border-0 my-3">
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
                                                
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
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
            </div>
        </section>

        <section class="bg-white section">
            <div class="container">
                <div class="card py-4 card-body border-0 bg-light text-dark">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-4 col-md-5 order-md-1">
                            <img src="{{ asset('images/laptop.png') }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-6 col-md-7 order-md-0">
                            <h5 class="fw-bold text-muted">Become a Trader</h5>
                            <h1 class="">Open a trader account and <br> earn as a freelance trader</h1>
                            <a href="{{ route('createAccount', ['account_type' => 'trader']) }}" class="btn btn-success btn-height px-4">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- F O O T E R --}}
        <footer class="bg-white py-5">
            <div class="container">
                <hr>

                <div class="row pt-5">
                    <div class="col-lg-6 mb-4">
                        <h4 class="fw-bold text-dark">Quick Links</h4>
                        
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled ps-1">
                                    <li class="my-3">
                                        <a href="#masthead" class="text-muted">Home</a>
                                    </li>
                
                                    <li class="my-3">
                                        <a href="#about" class="text-muted">About Us</a>
                                    </li>
                
                                    <li class="my-3">
                                        <a href="#services" class="text-muted">Services</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-6">
                                <ul class="list-unstyled ps-1">
                                    <li class="my-3">
                                        <a href="#team" class="text-muted">Our Team</a>
                                    </li>
                
                                    <li class="my-3">
                                        <a href="{{ route('contact.index') }}" class="text-muted">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <h4 class="fw-bold text-dark">Help &amp; Support</h4>
                        
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled ps-1">
                                    <li class="my-3">
                                        <a href="#" class="text-muted">How it works</a>
                                    </li>

                                    <li class="my-3">
                                        <a href="{{ route('contact.index') }}" class="text-muted">Support</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-6">
                                <ul class="list-unstyled ps-1">
                                    <li class="my-3">
                                        <a href="#" class="text-muted">Privacy Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="text-center text-muted">
                    Copyright &copy; Tranzir {{ date("Y") }}. All rights Reserved. 
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
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script>
            var owl = $('.owl-carousel-1');
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
    </body>
</html>
