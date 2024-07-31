<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('img/LogoMAGSComplete.jpg') }}" alt="Logo" class="rounded-circle">
            <span class="ms-2">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button id="theme-toggle" class="btn btn-outline-secondary ms-2">
            <span id="theme-icon" class="bi bi-sun"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
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
                    @stack('navbar')

                    
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item text-expand">
                            <a class="nav-link"
                                href="{{ route('clinic.showIndex') }}">{{ __('appointment.Clinics') }}</a>
                        </li>

                        <li class="nav-item text-expand">
                            <a class="nav-link" href="{{ route('doctor.main') }}">{{ __('Doctor') }}</a>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img class="rounded-circle avatar" src="{{ Auth::user()->avatar }}" alt="User Avatar">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.showProfile') }}">
                                <i class="bi bi-gear"></i> Ajustes
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const themeToggleButton = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');

    // Aplicar el tema almacenado en localStorage
    const currentTheme = localStorage.getItem('theme') || 'light';
    document.body.classList.toggle('dark-mode', currentTheme === 'dark');
    themeIcon.classList.toggle('bi-moon', currentTheme === 'dark');
    themeIcon.classList.toggle('bi-sun', currentTheme === 'light');

    themeToggleButton.addEventListener('click', function() {
        const isDarkMode = document.body.classList.toggle('dark-mode');
        themeIcon.classList.toggle('bi-sun', !isDarkMode);
        themeIcon.classList.toggle('bi-moon', isDarkMode);

        // Almacenar la preferencia en localStorage
        localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
    });
});
</script>

<style>
/* Añadir estilos para el tema oscuro */
/* Estilos para el modo oscuro */
body.dark-mode {
    background-color: #121212;
    color: #e0e0e0;
}

.dark-mode .navbar {
    background-color: #1e1e1e;
}

.dark-mode .navbar-nav .nav-link {
    color: #e0e0e0; /* Color del texto de los enlaces en modo oscuro */
}

.dark-mode .navbar-nav .nav-link:hover {
    color: #f0f0f0; /* Color del texto de los enlaces al pasar el ratón en modo oscuro */
}

.dark-mode .dropdown-menu {
    background-color: #1e1e1e;
    color: #e0e0e0;
}

.dark-mode .dropdown-item {
    color: #e0e0e0;
}

.dark-mode .btn-outline-secondary {
    color: #e0e0e0;
    border-color: #333;
    background-color: #333;
}
.dark-mode .dropdown-item:hover {
    background-color: #333;
}


</style>