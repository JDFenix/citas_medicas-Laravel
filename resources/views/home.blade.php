@extends('layouts.app')

@section('title')
    Listado de Citas {{ Auth::user()->name }}
@endsection

@push('styles')
    <link href="{{ asset('css/shadowCustom.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container mt-1">
        @auth
            <h1 class="text-center mb-4">Bienvenido {{ Auth::user()->name }}</h1>
        @endauth

        @if (Auth::user()->role != 'admin')

            @push('navbar')
                <li class="nav-item text-expand">
                    <a href="{{ route('appointment.formRegister') }}" class="nav-link">Agendar Cita Nueva</a>
                </li>
            @endpush
            @if ($appointments->isEmpty())
                @if (Auth::user()->maternal_surname != null &&
                        Auth::user()->paternal_surname != null &&
                        Auth::user()->mobile_phone != null &&
                        Auth::user()->status_code == 'enabled')
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-info text-center" role="alert">
                                No hay citas para usted. desea agendar una cita? <a
                                    href="{{ route('appointment.formRegister') }}" class="alert-link">Click aquí</a>
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->maternal_surname == null &&
                        Auth::user()->paternal_surname == null &&
                        Auth::user()->mobile_phone == null)
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-info text-center" role="alert">
                                No puedes agendar citas debido a que ha iniciado sesión por
                                {{ Auth::user()->external_auth }} y sus datos personales están incompletos, completalos! <a
                                    href="{{ route('user.showProfile') }}" class="alert-link">Click aquí</a>
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->status_code == 'disabled' &&
                        Auth::user()->maternal_surname != null &&
                        Auth::user()->paternal_surname != null &&
                        Auth::user()->mobile_phone == null)
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-info text-center" role="alert">
                                No puedes agendar citas debido a que tu número de teléfono está incompleto,
                                complétalo!
                                <a href="{{ route('user.showProfile') }}" class="alert-link">Click aquí</a>
                            </div>
                        </div>
                    </div>
                @endif


                @if (Auth::user()->status_code == 'disabled' &&
                        Auth::user()->maternal_surname != null &&
                        Auth::user()->paternal_surname != null &&
                        Auth::user()->mobile_phone != null)
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-info text-center" role="alert">
                                No puedes agendar citas debido a que tu número de teléfono no esta validado,
                                Veríficalo!
                                <a href="{{ route('user.showProfile') }}" class="alert-link">Click aquí</a>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-8 d-flex align-items-center">
                        <h3 class="me-3">Listado de citas activas para {{ Auth::user()->name }}</h3>
                        <a href="{{ route('appointment.formRegister') }}"
                            class="btn btn-primary">Agendar Cita Nueva</a>
                    </div>

                    <div class="col-md-12">
                        <hr class="border border-secondary border-2 opacity-10 custom-hr">
                    </div>
                </div>

                <div class="row justify-content-center">
                    @foreach ($appointments as $appointment)
                        <div class="col-md-3 me-5 mt-5">
                            <div class="card custom-shadow-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-flex justify-content-end">
                                            <h5>{{ $appointment->date }}</h5>
                                        </div>
                                        <hr class="border border-secondary border-2 opacity-10 custom-hr">
                                        <div class="d-flex justify-content-center">
                                            <h4>Cita para {{ $appointment->clinics->speciality }}</h4>
                                        </div>
                                        <div class="d-flex justify-content-start mt-3">
                                            <p>Consultorio: {{ $appointment->clinics->speciality }}</p>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <p>Doctor: {{ $appointment->doctors->name }}</p>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <p>Hora: {{ $appointment->hour }}</p>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <p>Paciente: {{ $appointment->users->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="btn-group ">
                                            <p>Por favor, le solicitamos encarecidamente que se presente puntualmente a la
                                                hora y fecha acordadas. Lamentamos informar que no se permitirán
                                                cancelaciones ni reprogramaciones.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection
