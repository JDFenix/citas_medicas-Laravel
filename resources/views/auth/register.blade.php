@extends('layouts.app')

@section('title', 'Registro')

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <style>
        .align-icon {
            display: inline-flex;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <img width="700" height="500" src="{{ asset('img/login_img.png') }}" alt="">
            </div>


            <div class="col-md-6">
                <div style="margin-left: 13%" class="text-center me-auto mb-4">
                    <h2 >Registro</h2>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('auth.Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" placeholder="nombre" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="paternal_surname"
                            class="col-md-4 col-form-label text-md-end">{{ __('auth.Paternal Surname') }}</label>
                        <div class="col-md-6">
                            <input id="paternal_surname" placeholder="apellido paterno" type="text"
                                class="form-control @error('paternal_surname') is-invalid @enderror" name="paternal_surname"
                                value="{{ old('paternal_surname') }}" required autocomplete="paternal_surname" autofocus>
                            @error('paternal_surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="maternal_surname"
                            class="col-md-4 col-form-label text-md-end">{{ __('auth.Maternal Surname') }}</label>
                        <div class="col-md-6">
                            <input id="maternal_surname" placeholder="apellido materno" type="text"
                                class="form-control @error('maternal_surname') is-invalid @enderror" name="maternal_surname"
                                value="{{ old('maternal_surname') }}" required autocomplete="maternal_surname" autofocus>
                            @error('maternal_surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-3">
                        <label for="date_birth"
                            class="col-md-4 col-form-label text-md-end">Fecha de Nacimiento</label>
                        <div class="col-md-6">
                            <input id="date_birth" type="date"
                                class="form-control @error('date_birth') is-invalid @enderror" name="date_birth"
                                value="{{ old('date_birth') }}" required autocomplete="date_birth" autofocus>
                            @error('date_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-3">
                        <label for="mobile_phone" class="col-md-4 col-form-label text-md-end">Número de Teléfono</label>
                        <div class="col-md-6">
                            <input id="mobile_phone" placeholder="número de teléfono" type="number"
                                class="form-control @error('mobile_phone') is-invalid @enderror"
                                name="mobile_phone" value="{{ old('mobile_phone') }}" required
                                autocomplete="mobile_phone" minlength="10" maxlength="10" autofocus pattern="\d*"
                                inputmode="numeric">
                            @error('mobile_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="form-group row mb-3">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-end">{{ __('auth.Email Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" placeholder="correo electronico" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('auth.Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" placeholder="contraseña" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-end">{{ __('auth.Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" placeholder="confirmar contraseña" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>
                    <div style="margin-left: 8%" class="container mt-4 text-center">
                        <div class="col-auto align-icon">
                            <a href="login-google" class="text-decoration-none me-4">
                                <img width="35" height="35" src="{{ asset('img/logo_google.png') }}" alt="">
                            </a>

                            <a href="auth/twitter" class="text-decoration-none">
                                <i class="bi bi-twitter-x fs-2 text-dark"></i>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div style="margin-left: 16%" class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4 d-flex justify-content-center align-items-center">
                            <button style="width: 80%;margin-left:-35%" type="submit" class="btn btn-primary btn-lg">
                              Registrar
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
