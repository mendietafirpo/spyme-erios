<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Styles-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="sidebar">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}" style="position:relative; padding-right:5px; padding-bottom:5px; padding-top:5px; padding-left:5px;">
                <img src="{{ asset('/logo.png') }}" style="width: 40px; height: 40px; border-radius: 50%;"></img>
                </a>
            </div>

            <div class="collapse navbar-collapse bg-blue-100" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                @if(Auth::user())
                    @if(session('idRole'))
                        @if (session('idRole')==1)
                            <li><a class="font-semibold text-dark" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                            <li><a class="font-semibold text-dark" href="{{ route('firmas.index') }}">Pymes</a></li>
                            <li><a class="font-semibold text-dark" href="{{ route('personas.index') }}">Personas</a></li>
                            <li><a class="font-semibold text-dark" href="{{ route('pymes.mysmes') }}">Solicitudes</a></li>
                            <li><a class="font-semibold text-dark" href="{{ route('pymes.metricas') }}">Estadisticas</a></li>
                        @elseif (session('idRole')==2)
                        @elseif (session('idRole')==3)
                        <li><a class="font-semibold text-dark" href="{{ route('pymes.mysmes') }}">Solicitudes</a></li>
                            <li><a class="font-semibold text-dark" href="{{ route('pymes.metricas') }}">Estadisticas</a></li>
                        @endif
                    @endif
                @else
                        <!--<li><a href="{{ url('/dashboard') }}">Dashboard</a></li>-->
                        <li><a class="font-semibold text-dark" href="{{ url('/') }}">Inicio</a></li>
                        <li><a class="font-semibold text-dark" href="{{ url('/') }}">Nosotros</a></li>
                        <li><a class="font-semibold text-dark" href="{{ url('/') }}">Contacto</a></li>
                        <li><a class="font-semibold text-dark" href="{{ url('/') }}">Asesor??as</a></li>
                @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right pr-2">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Acceder</a></li>
                        <li><a href="{{ url('/register') }}">Registrar</a></li>
                    @else
                        <li class="dropdown">
                            <a title="{{ Auth::user()->name }}: {{ Auth::user()->email }}"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-right:15px;; padding-bottom:5px; padding-top:5px; padding-left:5px;">
                            @if (Auth::user()->profile_image)
                                <img src="{{ asset(Auth::user()->profile_image) }}" style="width: 35px; height: 35px; border-radius: 50%;"></img>

                            @else
                                {{ Auth::user()->username }}
                            @endif
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i> Profile</a></li>
                                <li><a>
                                        <form id="logout-form" action="{{ url('logout') }}" method="POST">{{ csrf_field() }}<button type="submit">Salir</button></form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- JavaScripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</header>
</html>
