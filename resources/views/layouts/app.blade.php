<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/sidebare.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>
<div id="app">
<div class="d-flex" id="wrapper">

    @if(\Illuminate\Support\Facades\Auth::check())
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading ">
            <img src="{{ asset('logo/zzzz.png') }}" alt="">
        </div>
        <div class="list-group list-group-flush">
            <div class="dropdown-divider"></div>

            <router-link class="list-group-item list-group-item-action bg-light" to="/"> <i class="fas fa-desktop fa-lg"></i> Accceuil</router-link>
            <router-link class="list-group-item list-group-item-action bg-light" to="/tenants"><i class="fas fa-user-plus fa-lg"></i> Locataire</router-link>

            <a class="list-group-item list-group-item-action bg-light dropdown-btn"><i class="fas fa-home fa-sm"></i>Biens
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>
            <div class="dropdown-container">
                <router-link class="list-group-item list-group-item-action bg-light" to="/bien"><i class="fas fa-home fa-lg"></i> biens</router-link>
                <router-link class="list-group-item list-group-item-action bg-light" to="/immeubles"><i class="fas fa-building fa-lg"></i> immeubles</router-link>
            </div>

            <div class="dropdown-divider"></div>
            <router-link class="list-group-item list-group-item-action bg-light" to="/rent"><i class="fas fa-key fa-lg"></i> Location</router-link>
            <router-link class="list-group-item list-group-item-action bg-light" to="/state"><i class="far fa-eye fa-lg"></i> Etat des lieux</router-link>
            <router-link class="list-group-item list-group-item-action bg-light" to="/payment"><i class="fas fa-coins fa-lg"></i> finances</router-link>
            <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>

        </div>

    </div>
    <!-- /#sidebar-wrapper -->
    @endif

    <!-- Page Content -->

    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <button id="menu-toggle"><i class="fas fa-sliders-h" ></i></button>

            <div class="container ">

                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('logo/logo2.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('Creer un compte') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="#">A propos</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Mon compte
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <div class="dropdown-divider"></div>
                                    <router-link to="/profil" class="dropdown-item"><i class="fas fa-user"></i> Mon compte</router-link>
                                    <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm"></i>
                                              {{ __(' Deconnexion') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
</div>
<link href="css/simple-sidebar.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Menu Toggle Script -->
</body>
</html>
