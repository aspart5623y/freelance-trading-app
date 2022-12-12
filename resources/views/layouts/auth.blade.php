<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tranzir</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/x-icon">

        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/owl.theme.default.min.css') }}">
        @stack('css')
    </head>
    <body class="">

        @include('includes.preloader')


         {{-- N A V B A R --}}
         <nav class="navbar navbar-light navbar-expand-lg bg-white fixed-top shadow-sm">
            <div class="container">
                <a href="{{ route('index') }}" class="navbar-brand">
                    <img src="{{ asset('images/logo/logo.png') }}" width="170" alt="">
                </a>

                <button class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar-menu">
                    {{-- Navbar Menu --}}
                    <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                        </li>
    
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-outline-success">Create Account</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
        
        <main>
            <div class="auth-page">
                <div class="container-fluid">
                    <div class="d-none d-lg-block auth-img">
                        @yield('image')
                    </div>
                    <div class="card auth-card card-body border-0 py-5">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="text-center">
                                    <h2 class="fw-bold">
                                        @yield('title')
                                    </h2>
                                    <p class="text-muted">Enter your details to gain access</p>
                                </div>
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
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
        @stack('js')
    </body>
</html>
