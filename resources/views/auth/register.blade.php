@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-primary text-white text-center">
                    <h3>{{ __('Register') }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('auth.Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="paternal_surname" class="col-md-4 col-form-label text-md-end">{{ __('auth.Paternal Surname') }}</label>
                            <div class="col-md-6">
                                <input id="paternal_surname" type="text" class="form-control @error('paternal_surname') is-invalid @enderror" name="paternal_surname" value="{{ old('paternal_surname') }}" required autocomplete="paternal_surname" autofocus>
                                @error('paternal_surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="maternal_surname" class="col-md-4 col-form-label text-md-end">{{ __('auth.Maternal Surname') }}</label>
                            <div class="col-md-6">
                                <input id="maternal_surname" type="text" class="form-control @error('maternal_surname') is-invalid @enderror" name="maternal_surname" value="{{ old('maternal_surname') }}" required autocomplete="maternal_surname" autofocus>
                                @error('maternal_surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('auth.Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('auth.Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="container mt-4 text-center">
                            <div class="col-auto">
                                <a href="login-google" class="text-decoration-none">
                                    <i class="bi bi-google fs-2"></i>
                                </a>
                            </div>
                        </div>
<br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 d-flex justify-content-center align-items-center">
                                <button style="width: 80%;margin-left:-35%" type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>&copy; 2024 Centro Médico</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
