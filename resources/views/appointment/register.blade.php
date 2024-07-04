@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Crear Cita</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('appointment.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="date" class="form-label">{{ __("appointment.Date") }}</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">{{ __("appointment.Hour") }}</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="mb-3">
                <label for="doctors_id" class="form-label">{{ __("appointment.Name Doctor") }}</label>
                <input type="text" class="form-control" id="doctors_id" name="doctors_id" required>
            </div>
            <div class="mb-3">
                <label for="clinics_id" class="form-label">{{ __("appointment.Speciality") }}</label>
                <select class="form-select" id="clinics_id" name="clinics_id" required>
                    @foreach($clinicsSpeciality as $speciality)
                        <option value="{{ $speciality['id'] }}">{{ $speciality['speciality'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="patient_name" class="form-label">{{ __("appointment.Name Patient") }}</label>
                <input type="text" class="form-control" id="patient_name" value="{{ Auth::user()->name }} {{ Auth::user()->paternal_surname }} {{ Auth::user()->maternal_surname }}" disabled>
                <input type="hidden" id="users_id" name="users_id" value="{{ Auth::user()->id }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ __("appointment.Appointment Register") }}</button>
        </form>
    </div>
@endsection
