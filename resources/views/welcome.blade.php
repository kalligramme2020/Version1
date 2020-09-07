<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Immo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

    </head>
    <body>
    <div class='box'>
        <div class='wave -one'></div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
    </div>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
            <div class="links">

            </div>
        </div>
    </div>


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
