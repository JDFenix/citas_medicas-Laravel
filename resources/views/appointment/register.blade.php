@extends('layouts.app')

@section('tittle', 'Agendar Cita')

@push('styles')
    <link href="{{ asset('css/shadowCustom.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="container mt-2">

        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card text-center custom-shadow">
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <h3>Agendar Cita Para {{ Auth::user()->name }}</h3>
                                    <hr class="border border-secondary border-2 opacity-10 custom-hr">
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('appointment.post') }}" method="POST">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    <div class="form-group mt-3">
                                        <label class="" for="">Especialidad</label>
                                        <select class="form-select form-control-lg shadow rounded"
                                            aria-label="Default select example" id="clinics_id" name="clinics_id" required>
                                            <option selected>Especialidad</option>
                                            @foreach ($clinicsSpeciality as $speciality)
                                                <option value="{{ $speciality->id }}">{{ $speciality->speciality }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-4 justify-content-center">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Fecha</label>
                                        <input type="date" id="date" name="date" required
                                            class="form-control form-control-lg shadow rounded">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Hora:</label>
                                        <input type="time" id="hour" name="hour" required
                                            class="form-control form-control-lg shadow rounded">
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-4 justify-content-center">
                                <div class="col-md-7">
                                    <div class="form-group mt-4">
                                        <label for="">Nombre del doctor:</label>
                                        <input type="text" disabled class="form-control form-control-lg shadow rounded"
                                            value="{{ $doctorSpecific->name }} {{ $doctorSpecific->paternal_surname }}  {{ $doctorSpecific->maternal_surname }}">

                                        <input type="hidden" value="{{ $doctorSpecific->id }}" id="doctors_id"
                                            name="doctors_id" required>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-4 justify-content-center">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="users_id">Nombre del paciente:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-lg shadow rounded"
                                                value="{{ Auth::user()->name }}" disabled>
                                            <span class="input-group-text bg-white">
                                                <i class="bi bi-person-fill"></i>
                                            </span>
                                        </div>
                                        <input type="hidden" id="users_id" name="users_id"
                                            value="{{ Auth::user()->id }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Apellidos:</label>
                                        <input type="text" class="form-control form-control-lg shadow rounded"
                                            value="{{ Auth::user()->paternal_surname }} {{ Auth::user()->maternal_surname }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-5">

                                <div class="btn-group col-md-4" role="group">
                                    <button type="button" class="btn btn-primary btn-lg btn-custom">Regresar
                                        <span class="mt-2 justify-content-end">
                                            <i class="bi bi-arrow-return-left"></i></span>
                                    </button>
                                </div>

                                <div class="btn-group col-md-4" role="group">
                                    <button type="submit" class="btn btn-success btn-lg btn-custom">Agendar <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                            <path d="M11 2H9v3h2z" />
                                            <path
                                                d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Mostrar mensajes de error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
