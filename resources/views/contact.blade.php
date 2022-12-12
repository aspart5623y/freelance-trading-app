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
                            <a href="{{ route('index') }}#masthead" class="nav-link">Home</a>
                        </li>
    
                        <li class="nav-item">
                            <a href="{{ route('index') }}#about" class="nav-link">About Us</a>
                        </li>
    
                        <li class="nav-item">
                            <a href="{{ route('index') }}#services" class="nav-link">Services</a>
                        </li>
    
                        <li class="nav-item">
                            <a href="{{ route('index') }}#team" class="nav-link">Our Team</a>
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

        {{-- C O N T A C T    U S --}}
        <section class="section bg-white my-5" id="contact">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center">
                            <h2 class="landing-title">Contact Us</h2>
                            <p class="text-muted mb-5">Be sure to enter the correct email address as our support team would get back to you via the email you provided</p>
                        </div>
                    </div>
                </div>


                <div class="row align-items-start justify-content-between">
                    <div class="col-lg-6 col-md-7 mb-5">

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif 

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="" class="text-muted mb-1">Name <small class="text-muted">(optional)</small></label>
                                <input type="text" placeholder="Your name" name="name" class="form-control @error('name') is-invalid @enderror min-height">
                                @error('name') 
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="" class="text-muted mb-1">Email<span class="fw-bolder text-danger">*</span></label>
                                <input type="email" placeholder="Your email" name="email" class="form-control @error('email') is-invalid @enderror min-height">
                                @error('email') 
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="" class="text-muted mb-1">Message<span class="fw-bolder text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" rows="5" name="message" placeholder="Your message" ></textarea>
                                @error('message') 
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="btn btn-height btn-success" type="submit">Submit</button>
                        </form>
                    </div>

                    @php
                        $company = \App\Models\CompanyInfo::first();
                    @endphp

                    @if ($company)
                        <div class="col-xl-5 col-lg-6 col-md-5 mb-5">
                            <div class="text-end ms-auto">
                                
                                <div class="row">
                                    <div class="col-sm-6 col-md-12">
                                        @if ($company->map)
                                            <div class="card-map mb-4 ms-auto">
                                                <iframe 
                                                    src="{{ $company->map }}" 
                                                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                                ></iframe>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-6 col-md-12">
                                        <div class="ms-auto" style="max-width: 320px">

                                            
                                            @if($company->address)
                                                <h5 class="fw-bold">Our Address</h5>
                                                <p class="text-muted">
                                                    {{$$company->address}}
                                                </p>
                                            @endif

                                            @if($company->email)
                                                <h5 class="fw-bold">Support</h5>
                                                <ul class="list-unstyled d-flex flex-wrap justify-content-end">
                                                    <li class="mb-1 me-2">
                                                        {{$company->email}}
                                                    </li>
                                                </ul>
                                            @endif

                                            @if($company->phone)
                                                <h5 class="fw-bold">Hotlines</h5>
                                                <ul class="list-unstyled d-flex flex-wrap justify-content-end">
                                                    <li class="mb-1 me-2">
                                                        {{$company->phone}}
                                                    </li>
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @endif
                    
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
                                        <a href="{{ route('index') }}#masthead" class="text-muted">Home</a>
                                    </li>
                
                                    <li class="my-3">
                                        <a href="{{ route('index') }}#about" class="text-muted">About Us</a>
                                    </li>
                
                                    <li class="my-3">
                                        <a href="{{ route('index') }}#services" class="text-muted">Services</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-6">
                                <ul class="list-unstyled ps-1">
                                    <li class="my-3">
                                        <a href="{{ route('index') }}#team" class="text-muted">Our Team</a>
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
