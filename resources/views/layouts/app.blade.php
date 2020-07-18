<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href=" {{Configura::readThemes('selected') ? asset(Configura::readThemes('selected')) :  asset('css/app.css') }}" rel="stylesheet">



</head>
<body>
    <v-app id="app">
    <nav class="navbar navbar-expand-md navbar-light  shadow-sm fixed-top bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">{{ __('About') }} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('settings') }}">{{ __('Settings') }} </a>
                            </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <form class="form-inline my-2 input-group mb-2 mr-lg-3">
                  <input class="form-control" type="text" placeholder="Search" />
                  <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search fa-flip-horizontal" ></i></button>
                  </div>
                </form>


   

                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" href="#" class="py-0 nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <b-avatar size="50" src="/img/foto.jpg"></b-avatar>
                            </a>
                             
                            

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="#">Configuration</a>
                                     
                                 
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
    </v-app>
</body>
</html>
