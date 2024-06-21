@extends('layouts.app')

@section('content')
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8fafc;
        }
        .card {
            border-radius: 20px;
            box-shadow: 10px 4px 10px 10px #ccc;
        }
        .card img {
            width: 100px;
            height: 100px;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">{{ __('Iniciar Sesión') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="text-center mb-4">
                                <img src="{{ asset('img/medico-color.png') }}" alt="login-user">
                            </div>

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
                                <div class="container mt-4">
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <a href="https://www.facebook.com" class="text-decoration-none">
                                                <i class="bi bi-facebook fs-2"></i>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="login-google" class="text-decoration-none">
                                                <i class="bi bi-google fs-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
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
