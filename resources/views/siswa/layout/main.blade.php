<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ isset($title) ? $title.' | '.config('app.name') : config('app.name') }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="{{url('adminlte/plugins/fontawesome-free/css/all.min.css')}}" />
        <link rel="stylesheet" href="{{ url('pace/minimal.css') }}">
        <link rel="stylesheet" href="{{url('bs4/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{url('css/sticky-footer-navbar.css')}}" />
        @stack('css')
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{ url('images/logo_smk.png')}}" width="30" height="30" class="d-inline-block align-top rounded" alt="">
                    {{config('app.name')}}
                </a>
                <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse"><span class="navbar-toggler-icon"></span></button>
                <div id="my-nav" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item"><a href="{{route('login')}}" class="nav-link"> <i class="fas fa-lock"></i> Login</a></li>
                        @else
                        @auth('admin')
                        <li class="nav-item"><a href="{{route('login')}}" class="nav-link"><i class="fas fa-lock"></i> Login</a></li>
                        @else
                        <li class="nav-item mr-2"><a href="{{route('siswa.dashboard')}}" class="nav-link"> <i class="fas fa-home"></i> Home</a></li>
                        <li class="nav-item mr-2"><a href="{{route('siswa.biodata')}}" class="nav-link"> <i class="fas fa-address-book"></i> Biodata</a></li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown"> <i class="fas fa-user-graduate"></i> {{ Auth::user()->nama_lengkap}} <small> <i class="fas fa-caret-down"></i></small></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('siswa.password.ganti') }}" class="dropdown-item"> <i class="fas fa-key mr-2"></i> Ubah Password</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                            <i class="fas fa-door-open mr-2"></i> Logout</a>
                            <form action="{{route('logout')}}" id="logout-form" method="post">@csrf</form>
                            </div>
                        </li>
                        @endauth
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid" id="app">@yield('content')</div>
        <footer class="footer">
            <div class="container">
                <span class="text-muted">
                    <div class="float-right d-none d-sm-block"><b>Version</b>{{config('app.version')}}</div>
                    <strong> Copyright © 2021-{{date('Y')}}<a href="https://rpl.smkn1padaherang.sch.id/"> RPL SMKN 1 Padaherang</a>.</strong> All rights reserved.
                </span>
            </div>
        </footer>
        @yield('config')
        <script data-pace-options='{ "restartOnRequestAfter": true }' src="{{ url('pace/pace.min.js') }}"></script>
        <script src="{{url('adminlte/plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{url('bs4/js/popper.min.js')}}"></script>
        <script src="{{url('bs4/js/bootstrap.min.js')}}"></script>
        @stack('js')
    </body>
</html>
