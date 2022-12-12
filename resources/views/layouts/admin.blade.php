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
        @stack('css')

    </head>
    <body class="admin-page">

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
                            <a href="{{ route('admin.home') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.home' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fas fa-th-large" aria-hidden="true"></i>
                                </span>
                                <span class="sidebar-text">Dashboard</span>
                            </a>
                        </li>

                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('admin.sendmail') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.sendmail' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <span class="sidebar-text">Send Email</span>
                            </a>
                        </li>


                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('admin.contact') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.contact' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fas fa-question-circle"></i>                                    
                                </span>
                                <span class="sidebar-text">Contact Messages</span>
                            </a>
                        </li>


                        

                        @if (auth()->user()->profileable->level == 'admin')
                            {{-- sidebar item --}}
                            <li class="sidebar-item">
                                {{-- sidebar link --}}
                                <a href="{{ route('admin.transfer') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.transfer' ? 'active' : '' }}">
                                    <span class="sidebar-icon">
                                        <i class="fas fa-money-bill-wave-alt"></i>
                                    </span>
                                    <span class="sidebar-text">Transfer Funds</span>
                                </a>
                            </li>
                        @endif 

                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('admin.profile') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.profile' ? 'active' : '' }}">
                                <span class="sidebar-icon">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                </span>
                                <span class="sidebar-text">My Profile</span>
                            </a>
                        </li>

                        @if (auth()->user()->profileable->level == 'admin' || auth()->user()->profileable->level == 'manager')
                            <li class="sidebar-item">
                                <a class="sidebar-link collapsed {{ Route::currentRouteName() == 'admin.investors' || Route::currentRouteName() == 'admin.traders' || Route::currentRouteName() == 'admin.admins' ? 'show' : '' }}" data-bs-toggle="collapse" href="#usersCollapse" aria-expanded="{{ Route::currentRouteName() == 'admin.investors' || Route::currentRouteName() == 'admin.traders' || Route::currentRouteName() == 'admin.admins' ? 'true' : 'false' }}">
                                    <span class="sidebar-icon">
                                        <i class="fas fa-users"></i> 
                                    </span>
                                    <span class="sidebar-text">
                                        All Users
                                        <span class="sidebar-arrow"><i class="fas fa-chevron-down"></i></span>
                                    </span>
                                </a>
                                
                                <!-- sidebar collapse -->
                                <div class="collapse {{ Route::currentRouteName() == 'admin.investors' || Route::currentRouteName() == 'admin.traders' || Route::currentRouteName() == 'admin.admins' ? 'show' : '' }}" id="usersCollapse">
                                    <div class="card card-body rounded sidebar-dropdown p-2">
                                        <ul class="list-unstyled">
                                            <!-- sidebar item -->
                                            <li class="sidebar-item">
                                                <a href="{{ route('admin.investors') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.investors' ? 'active' : '' }}">
                                                    <span class="sidebar-text">
                                                        Investors
                                                        <span>({{ \App\Models\Investor::count() }})</span>
                                                    </span>
                                                </a>
                                            </li> 

                                            <!-- sidebar item -->
                                            <li class="sidebar-item">
                                                <a href="{{ route('admin.traders') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.traders' ? 'active' : '' }}">
                                                    <span class="sidebar-text">
                                                        Traders 
                                                        <span>({{ \App\Models\Trader::count() }})</span>
                                                    </span>
                                                </a>
                                            </li> 

                                            <!-- sidebar item -->
                                            <li class="sidebar-item">
                                                <a href="{{ route('admin.admins') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.admins' ? 'active' : '' }}">
                                                    <span class="sidebar-text">
                                                        Admins                                                    
                                                        <span>({{ \App\Models\Admin::count() - 1 }})</span>
                                                    </span>
                                                </a>
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endif 


                        @if (auth()->user()->profileable->level == 'admin' || auth()->user()->profileable->level == 'manager')
                            {{-- sidebar item --}}
                            <li class="sidebar-item">
                                {{-- sidebar link --}}
                                <a href="{{ route('admin.deposit') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.deposit' ? 'active' : '' }}">
                                    <span class="sidebar-icon">
                                        <i class="fas fa-wallet"></i>
                                    </span>
                                    <span class="sidebar-text">
                                        Deposits

                                        <span>({{ \App\Models\Deposit::where('status', 'pending')->count() }})</span>
                                    </span>
                                </a>
                            </li>
                        @endif 
                        

                        @if (auth()->user()->profileable->level == 'admin' || auth()->user()->profileable->level == 'manager')
                            {{-- sidebar item --}}
                            <li class="sidebar-item">
                                {{-- sidebar link --}}
                                <a href="{{ route('admin.chat.index') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.chat.index' ? 'active' : '' }}">
                                    <span class="sidebar-icon">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                    <span class="sidebar-text">Converations</span>
                                </a>
                            </li>
                        @endif 



                        @if (auth()->user()->profileable->level == 'admin' || auth()->user()->profileable->level == 'manager')
                            {{-- sidebar item --}}
                            <li class="sidebar-item">
                                {{-- sidebar link --}}
                                <a href="{{ route('admin.investment.index') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.investment.index' ? 'active' : '' }}">
                                    <span class="sidebar-icon">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </span>
                                    <span class="sidebar-text">Investments</span>
                                </a>
                            </li>
                        @endif 
                        


                        @if (auth()->user()->profileable->level == 'admin' || auth()->user()->profileable->level == 'manager')
                            {{-- sidebar item --}}
                            <li class="sidebar-item">
                                {{-- sidebar link --}}
                                <a href="{{ route('admin.withdrawal') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.withdrawal' ? 'active' : '' }}">
                                    <span class="sidebar-icon">
                                        <i class="fas fa-download"></i>
                                    </span>
                                    <span class="sidebar-text">
                                        Withdrawals
                                        <span>({{ \App\Models\Withdrawal::where('status', 'pending')->count() }})</span>
                                    </span>
                                </a>
                            </li>
                        @endif 

                      
                        {{-- sidebar item --}}
                        <li class="sidebar-item">
                            {{-- sidebar link --}}
                            <a href="{{ route('admin.settings') }}" class="sidebar-link {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}">
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
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                    <div class="container-fluid">
                        <button class="sidebar-toggle-btn btn border-0" type="button">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand" href="{{ route('admin.home') }}">
                            @yield('title')
                        </a>
        
                        
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto d-flex flex-row">
                            {{-- profile link --}}
                            <li class="nav-item dropdown position-relative">
                                <a id="navbarDropdown" class="nav-link d-flex align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="d-inline-flex flex-column px-2"><span class="mb-0">{{ Auth::user()->profileable->firstname . ' ' . Auth::user()->profileable->lastname }}</span></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end position-absolute border-0 shadow" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                        My Profile
                                    </a>
                                    <a class="dropdown-item" href="#logoutModal" data-bs-toggle="modal">
                                        {{ __('Logout') }}
                                    </a>

                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
        
        
                <main class="py-4">
                    <div class="">
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



        
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/font-awesome.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
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
                    title: "Error!",
                    text: "{!! Session::get('error') !!}",
                    icon: "error",
                });
            </script>
        @endif

        @stack('js')

    </body>
</html>
