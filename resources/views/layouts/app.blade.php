<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <style>
        .button-expand:hover {
            transform: scale(1.03)
        }

        .button-expand {
            transition: transform ease-in-out 0.3s
        }

        .text-expand:hover {
            transform: scale(1.06)
        }

        .text-expand {
            transition: transform ease-in-out 0.3s
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
        }

        .navbar {
            background-color: #f8f9fa;
        }

        .navbar-nav .nav-link {
            color: #495057;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .nav-item.active .nav-link {
            color: #007bff;
            font-weight: bold;
        }

        .nav-item.dropdown .dropdown-menu {
            min-width: 200px;
        }

        .nav-item.dropdown .dropdown-item {
            display: flex;
            align-items: center;
        }

        .nav-item.dropdown .dropdown-item .bi {
            margin-right: 10px;
        }

        .avatar {
            width: 30px;
            height: 30px;
            object-fit: cover;
            margin-right: 8px;
        }
    </style>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('img/LogoMAGSComplete.jpg') }}" alt="Logo" class="rounded-circle">
                    <span class="ms-2">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if (Auth::check())
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item text-expand">
                                <a class="nav-link" href="#">{{ __('auth.Home') }}</a>
                            </li>
                            <li class="nav-item text-expand">
                                <a class="nav-link" href="#">{{ __('auth.About') }}</a>
                            </li>
                            <li class="nav-item text-expand">
                                <a class="nav-link" href="#">{{ __('auth.Contact') }}</a>
                            </li>
                            @if (Auth::user()->role == 'pacient')
                                <li class="nav-item text-expand">
                                    <a class="nav-link"
                                        href="{{ route('appointment.main') }}">{{ __('appointment.appointments') }}</a>
                                </li>
                            @endif
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item text-expand">
                                    <a class="nav-link"
                                        href="{{ route('clinic.showIndex') }}">{{ __('appointment.Clinics') }}</a>
                                </li>
                            @endif
                        </ul>
                    @endif
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item text-expand">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('auth.Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item text-expand">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('auth.Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    <img class="rounded-circle avatar" src="{{ Auth::user()->avatar }}" alt="User Avatar">
                                    <span class="user-name">{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.showProfile') }}">
                                        <i class="bi bi-person-circle"></i> {{ __('user.Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.showSetting') }}">
                                        <i class="bi bi-gear"></i> {{ __('user.Settings') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('auth.Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
