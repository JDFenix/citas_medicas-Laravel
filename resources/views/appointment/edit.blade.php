@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Appointment
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Update Appointment</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="date" class="form-label">{{ __("Date") }}</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $appointment->date }}" required>
            </div>
            <div class="mb-3">
                <label for="hour" class="form-label">{{ __("Hour") }}</label>
                <input type="time" class="form-control" id="hour" name="hour" value="{{ $appointment->hour }}" required>
            </div>
            <div class="mb-3">
                <label for="doctors_id" class="form-label">{{ __("Doctor") }}</label>
                <select class="form-select" id="doctors_id" name="doctors_id" required>
                    @foreach($clinicsSpeciality as $speciality)
                        <option value="{{ $speciality->id }}" {{ $appointment->doctors_id == $speciality->id ? 'selected' : '' }}>
                            {{ $speciality->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="clinics_id" class="form-label">{{ __("Speciality") }}</label>
                <select class="form-select" id="clinics_id" name="clinics_id" required>
                    @foreach($clinicsSpeciality as $speciality)
                        <option value="{{ $speciality->id }}" {{ $appointment->clinics_id == $speciality->id ? 'selected' : '' }}>
                            {{ $speciality->speciality }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __("Update Appointment") }}</button>
        </form>
    </div>
@endsection
