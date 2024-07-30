@extends('layouts.app')

@section('tittle')
    Listado de Citas {{ Auth::user()->name }}
@endsection

@push('styles')
    <link href="{{ asset('css/shadowCustom.css') }}" rel="stylesheet">
@endpush


@section('content')
    <div class="container mt-5">

        @auth
            <h4 class="text-center mb-4">Benvenido {{ Auth::user()->name }}</h4>
        @endauth

        <div class="row justify-content-between align-items-center">

            <div class="col-md-8 d-flex align-items-center">
                <h3 class="me-3">Listado de citas activas para {{ Auth::user()->name }}</h3>
                <a href="{{ route('appointment.formRegister') }}"
                    class="btn btn-primary">{{ __('Create New Appointment') }}</a>
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
                                    <h4>Cita para ...</h4>
                                </div>

                                <div class="d-flex justify-content-start mt-3">
                                    <p>Consultorio: ...</p>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <p>Doctor:{{ $appointment->doctors->name }}</p>

                                </div>
                                <div class="d-flex justify-content-start">
                                    <p>Hora: {{ $appointment->hour }}</p>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <p>Paciente: {{ $appointment->users->name }}</p>
                                </div>

                            </div>
                            <div class="row justify-content-center">
                                <div class="btn-group col-md-6">
                                    <button type="button"
                                        class="btn btn-primary btn-lg btn-custom btn-sm custom-shadow-button">Reagendar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
