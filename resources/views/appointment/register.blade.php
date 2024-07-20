@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Create Appointment</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('appointment.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="date" class="form-label">{{ __("Date") }}</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="mb-3">
                <label for="hour" class="form-label">{{ __("Hour") }}</label>
                <input type="time" class="form-control" id="hour" name="hour" required>
            </div>
            <div class="mb-3">
                <label for="doctors_id" class="form-label">{{ __("Doctor") }}</label>
                <select class="form-select" id="doctors_id" name="doctors_id" required>
                    @foreach($clinicsSpeciality as $speciality)
                        <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="clinics_id" class="form-label">{{ __("Speciality") }}</label>
                <select class="form-select" id="clinics_id" name="clinics_id" required>
                    @foreach($clinicsSpeciality as $speciality)
                        <option value="{{ $speciality->id }}">{{ $speciality->speciality }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="users_id" class="form-label">{{ __("Patient") }}</label>
                <input type="text" class="form-control" id="users_id" name="users_id" value="{{ Auth::user()->name }}" disabled>
                <input type="hidden" id="users_id" name="users_id" value="{{ Auth::user()->id }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ __("Register Appointment") }}</button>
        </form>
    </div>
@endsection
