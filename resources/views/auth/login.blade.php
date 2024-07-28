@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header text-center bg-primary text-white">
                        <h3>{{ __('Iniciar Sesión') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img class="img-fluid" width="150" height="150" src="{{ asset('img/LogoMAGS.jpg') }}" alt="login-user">
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Recuérdame') }}</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                                <div class="container mt-4 text-center">
                                        <div class="col-auto">
                                            <a href="login-google" class="text-decoration-none me-3">
                                                <i class="bi bi-google fs-2"></i>
                                            </a>
                                            <a href="auth/twitter" class="text-decoration-none">
                                                <i class="bi bi-twitter-x fs-2 text-dark"></i>
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link justify-conten" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
