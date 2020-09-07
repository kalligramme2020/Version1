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
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/sidebare.js') }}" defer></script>



    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>

<div class='box'>
    <div class='wave -one'></div>
    <div class='wave -two'></div>
    <div class='wave -three'></div>
</div>


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
                    <router-link class="list-group-item list-group-item-action bg-light" to="/bien"><i class="fas fa-home fa-lg"></i> Bien</router-link>
                    <router-link class="list-group-item list-group-item-action bg-light" to="/rent"><i class="fas fa-key fa-lg"></i> Location</router-link>
                    <router-link class="list-group-item list-group-item-action bg-light" to="/state"><i class="far fa-eye fa-lg"></i> Etat des lieux</router-link>
                    <router-link class="list-group-item list-group-item-action bg-light" to="/payment"><i class="fas fa-coins fa-lg"></i> finances</router-link>
                    <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
                    <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>

                    <a class="list-group-item list-group-item-action bg-light dropdown-btn">dorpdown
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-container">
                        <a href="#" class="list-group-item list-group-item-action bg-light">Link 1</a>
                        <a href="#" class="list-group-item list-group-item-action bg-light">Link 2</a>
                    </div>
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
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

<style>
    body{
        margin: 0;
        padding: 0;
        background-color: #0e6cc4;
        overflow-x:hidden;
        overflow-y:hidden;
    }

    /*waves****************************/


    .box {
        position: fixed;
        top: 0;
        transform: rotate(80deg);
        left: 0;
    }

    .wave {
        position: fixed;
        top: 0;
        left: 0;
        opacity: .4;
        position: absolute;
        top: 3%;
        left: 10%;
        background: #0af;
        width: 1500px;
        height: 1300px;
        margin-left: -150px;
        margin-top: -250px;
        transform-origin: 50% 48%;
        border-radius: 43%;
        animation: drift 7000ms infinite linear;
    }

    .wave.-three {
        animation: drift 7500ms infinite linear;
        position: fixed;
        background-color: #77daff;
    }

    .wave.-two {
        animation: drift 3000ms infinite linear;
        opacity: .1;
        background: black;
        position: fixed;
    }

    .box:after {
        content: '';
        display: block;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 11;
        transform: translate3d(0, 0, 0);
    }

    @keyframes drift {
        from { transform: rotate(0deg); }
        from { transform: rotate(360deg); }
    }

    /*LOADING SPACE*/

    .contain {
        animation-delay: 4s;
        z-index: 1000;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;

        background: #25a7d7;
        background: -webkit-linear-gradient(#25a7d7, #2962FF);
        background: linear-gradient(#25a7d7, #25a7d7);
    }

    .icon {
        width: 100px;
        height: 100px;
        margin: 0 5px;
    }

    /*Animation*/
    .icon:nth-child(2) img {-webkit-animation-delay: 0.2s;animation-delay: 0.2s}
    .icon:nth-child(3) img {-webkit-animation-delay: 0.3s;animation-delay: 0.3s}
    .icon:nth-child(4) img {-webkit-animation-delay: 0.4s;animation-delay: 0.4s}

    .icon img {
        -webkit-animation: anim 2s ease infinite;
        animation: anim 2s ease infinite;
        -webkit-transform: scale(0,0) rotateZ(180deg);
        transform: scale(0,0) rotateZ(180deg);
    }

    @-webkit-keyframes anim{
        0% {
            -webkit-transform: scale(0,0) rotateZ(-90deg);
            transform: scale(0,0) rotateZ(-90deg);opacity:0
        }
        30% {
            -webkit-transform: scale(1,1) rotateZ(0deg);
            transform: scale(1,1) rotateZ(0deg);opacity:1
        }
        50% {
            -webkit-transform: scale(1,1) rotateZ(0deg);
            transform: scale(1,1) rotateZ(0deg);opacity:1
        }
        80% {
            -webkit-transform: scale(0,0) rotateZ(90deg);
            transform: scale(0,0) rotateZ(90deg);opacity:0
        }
    }

    @keyframes anim{
        0% {
            -webkit-transform: scale(0,0) rotateZ(-90deg);
            transform: scale(0,0) rotateZ(-90deg);opacity:0
        }
        30% {
            -webkit-transform: scale(1,1) rotateZ(0deg);transform: scale(1,1) rotateZ(0deg);opacity:1
        }
        50% {
            -webkit-transform: scale(1,1) rotateZ(0deg);
            transform: scale(1,1) rotateZ(0deg);opacity:1
        }
        80% {
            -webkit-transform: scale(0,0) rotateZ(90deg);
            transform: scale(0,0) rotateZ(90deg);opacity:0
        }
    }
</style>
</html>

