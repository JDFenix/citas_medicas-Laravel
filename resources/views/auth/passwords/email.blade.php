@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recuperar Contraseña</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('whatsapp.getTemporalyPassword') }}">
                            @csrf

                            <div class="row mb-4">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Correo
                                    Electronico:</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" placeholder="correo electronico"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-4">
                                <label for="mobile_phone" class="col-md-4 col-form-label text-md-end">Numero de
                                    telefono</label>
                                <div class="col-md-6">
                                    <input id="mobile_phone" type="number" minlength="10" maxlength="10"
                                        placeholder="Numero telefonico asociado a su correo"
                                        class="form-control @error('mobile_phone') is-invalid @enderror" name="mobile_phone"
                                        value="{{ old('mobile_phone') }}" required autocomplete="mobile_phone" autofocus>

                                    @error('mobile_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Mandar Codigo de verificacion
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
