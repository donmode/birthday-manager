<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Birthday Manager') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        a, a:link, {
            color: yellow;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md  shadow-sm" style="background-color:purple;">
            <div class="container" style="color: yellow;">
                <a  style="color: yellow;" class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', '2012 WAEC') }}
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
                                <a style="color: yellow;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a  style="color: yellow;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item" style="text-decoration: underline;">
                                    <a style="color: yellow;" class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                            </li>
                            
                            @can('viewAny', App\MediumUsers::class)
                                <li class="nav-item" style="text-decoration: underline;">
                                        <a style="color: yellow;" class="nav-link" href="{{ route('mediausers') }}">{{ __('View Social Media Accounts') }}</a>
                                </li>
                            @endcan
                            

                            @can('viewAny', App\Media::class)
                                <li class="nav-item" style="text-decoration: underline;">
                                        <a style="color: yellow;" class="nav-link" href="{{ route('media') }}">{{ __('Social Media') }}</a>
                                </li>
                            @endcan
                            
                            
                            <li class="nav-item dropdown" style="color:yellow;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" style="color:yellow;" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user d-inline ml-2 " style="color:yellow;"></i>
                                    {{ Auth::user()->name }} <span class="caret" style="color:yellow;"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
    </div>
</body>
</html>
