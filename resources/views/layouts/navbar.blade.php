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
                    @if (Route::has('doctor.main'))
                        <li class="nav-item text-expand">
                            <a class="nav-link" href="{{ route('doctor.main') }}">{{ __('Doctor') }}</a>
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