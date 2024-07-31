@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <style>
         .align-icon {
            display: inline-flex;
            align-items: center;
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider::before {
            margin-right: .25em;
        }

        .divider::after {
            margin-left: .25em;
        }

        .divider-circle {
            border: 1px solid #ddd;
            border-radius: 50%;
            padding: 10px;
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('img/img_login.png') }}" alt="image_login" class="">
            </div>
            <div class="col-md-6 mt-5">
                <div class="text-center text-dark">
                    <h3>{{ __('Iniciar Sesión') }}</h3>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                        <input id="email" type="email" class="form-control shadow @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control shadow @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary shadow mt-5">
                            {{ __('Iniciar Sesión') }}
                        </button>

                        <div class="divider">
                            <div class="divider-circle">o</div>
                        </div>

                        <div class="container  text-center">
                            <div class="col-auto align-icon">
                                <a href="login-google" class="text-decoration-none me-5">
                                    <img width="35" height="35" src="{{ asset('img/logo_google.png') }}" alt="">
                                </a>

                                <a href="auth/twitter" class="text-decoration-none">
                                    <i class="bi bi-twitter-x fs-2 text-dark"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link d-flex justify-content-center mt-3" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
