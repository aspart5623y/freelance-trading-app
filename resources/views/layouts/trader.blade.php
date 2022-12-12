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
        <link href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/owl.theme.default.min.css') }}">
        @stack('css')
        
    </head>
    <body class="trader-page">

        <!-- 
            *     P R E L O A D E R      *
        -->
        @include('includes.preloader')



        {{-- W R A P P E R --}}
        <div id="wrapper">
            {{-- S I D E B A R --}}
            <section class="sidebar">
                {{-- sidebar header --}}
                <div class="sidebar-header">
                    <a href="{{ route('index') }}" class="sidebar-brand">
                        <img src="{{ asset('images/logo/logo.png') }}" width="170" alt="">
                    </a>
                </div>
                {{-- sidebar body --}}
                <div class="sidebar-body">
                    {{-- sidebar nav --}}
                    <ul class="sidebar-nav list-unstyled">

                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('trader.home') }}" class="sidebar-link {{ Route::currentRouteName() == 'trader.home' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fas fa-th-large" aria-hidden="true"></i>
                                </span>
                                <span class="sidebar-text">Dashboard</span>
                            </a>
                        </li>

                       
                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('trader.profile') }}" class="sidebar-link {{ Route::currentRouteName() == 'trader.profile' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                </span>
                                <span class="sidebar-text">My Profile</span>
                            </a>
                        </li>


                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('trader.fund.wallet') }}" class="sidebar-link {{ Route::currentRouteName() == 'trader.fund.wallet' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fa fa-wallet" aria-hidden="true"></i>
                                    
                                </span>
                                <span class="sidebar-text">Fund Wallet</span>
                            </a>
                        </li>


                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('trader.transfer') }}" class="sidebar-link {{ Route::currentRouteName() == 'trader.transfer' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fas fa-money-bill-wave-alt"></i>
                                </span>
                                <span class="sidebar-text">Transfer Funds</span>
                            </a>
                        </li>


                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('trader.investment.index') }}" class="sidebar-link {{ Route::currentRouteName() == 'trader.investment.index' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </span>
                                <span class="sidebar-text">Investments</span>
                            </a>
                        </li>

                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('trader.packages') }}" class="sidebar-link {{ Route::currentRouteName() == 'trader.packages' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fas fa-briefcase"></i>
                                </span>
                                <span class="sidebar-text">My Packages</span>
                            </a>
                        </li>


                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('trader.withdrawal') }}" class="sidebar-link {{ Route::currentRouteName() == 'trader.withdrawal' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fas fa-download"></i>
                                </span>
                                <span class="sidebar-text">Withdrawals</span>
                            </a>
                        </li>

                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('trader.settings') }}" class="sidebar-link {{ Route::currentRouteName() == 'trader.settings' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fas fa-cogs"></i>
                                </span>
                                <span class="sidebar-text">Settings</span>
                            </a>
                        </li>

                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a data-bs-toggle="modal" href="#logoutModal" class="sidebar-link">
                                <span class="sidebar-icon">
                                    <i class="fas fa-sign-out-alt"></i>
                                </span>
                                <span class="sidebar-text">Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </section>

            <section class="mainbody">
                <nav class="navbar navbar-expand-lg navbar-light bg-transpart">
                    <div class="container-fluid">
                        <button class="sidebar-toggle-btn btn border-0" type="button">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand" href="{{ route('investor.home') }}">
                            @yield('title')
                        </a>
        
                        
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto d-flex flex-row">
                            
                            @php
                                $unread_count = 0;
                                $conversations = \App\Models\Conversation::where('reciever_id', auth()->user()->id)->orWhere('sender_id', auth()->user()->id)->get();
                                foreach ($conversations as $convo) {
                                    $unread_count += $convo->chats()->where('profile_id', '!=', auth()->user()->id)->where('read_status', false)->count();
                                }
                            @endphp
        
                            <li class="nav-item">
                                <a href="{{ route('trader.chat.index') }}" class="nav-link position-relative px-2 d-flex h-100 align-items-center justify-content-center">
                                    <i class="far fa-envelope" style="font-size: 18px"></i>
                                    <span class="position-absolute chat-notice badge rounded-pill bg-danger">{{ $unread_count > 0 ? $unread_count : '' }}</span>
                                </a>
                            </li>
                            
        
                            @php
                                $investments_count = auth()->user()->profileable->investments()->where('status', 'pending')->count()
                            @endphp

                            <li class="nav-item">
                                <a href="{{ route('trader.investment.index') }}" class="nav-link position-relative px-2 d-flex h-100 align-items-center justify-content-center">
                                    <i class="fas fa-briefcase" style="font-size: 18px"></i>
                                    <span class="position-absolute chat-notice badge rounded-pill bg-danger">{{ $investments_count > 0 ?? $investments_count }}</span>
                                </a>
                            </li>
        
                            {{-- profile link --}}
                            <li class="nav-item dropdown position-relative">
                                <a id="navbarDropdown" class="nav-link d-flex align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="navbar-img me-sm-2" style="background-image: url('{{ auth()->user()->profileable->profile_img ? asset('profile-image/' . auth()->user()->profileable_type . '/' . auth()->user()->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')">
                                    </span>
                                </a>
                        
                                <div class="dropdown-menu dropdown-menu-end position-absolute border-0 shadow" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('trader.profile') }}" class="dropdown-item {{ Route::currentRouteName() == 'trader.profile' ? 'active' : '' }}">
                                        <span class="sidebar-text">My Profile</span>
                                    </a>
                                
                                    
                                    <a data-bs-toggle="modal" href="#logoutModal" class="dropdown-item">
                                        <span class="sidebar-text text-danger">Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
        
        
                <main class="py-4">
                    <div class="container-fluid">
                        <nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent rounded-0">
                              <li class="breadcrumb-item"><a href="{{ route('trader.home') }}" class="text-success">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                        </nav>

                
                        @yield('content')
                    </div>
                </main>

                <a href="javascript:void(0)" class="sidebar-overlay"></a>
            </section>    
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
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/font-awesome.min.js') }}"></script>
        <script src="{{ asset('js/pusher.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

        <script>
            $(document).ready(function () {
                $('.data-table').DataTable();
            });
        </script>
    
        @if (Session::has('success'))
            <script>
                swal({
                    title: "Success!",
                    text: "{!! Session::get('success') !!}",
                    icon: "success",
                });
            </script>
        @elseif (Session::has('error'))
            <script>
                swal({
                    title: "Error!!",
                    text: "{!! Session::get('error') !!}",
                    icon: "error",
                });
            </script>
        @endif
        @stack('js')

    </body>
</html>
