@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">{{ __('Appointments') }}</h2>

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

        <div class="mb-4">
            <a href="{{ route('appointment.formRegister') }}" class="btn btn-primary">{{ __('Create New Appointment') }}</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Hour') }}</th>
                        <th>{{ __('Patient Name') }}</th>
                        <th>{{ __('Speciality') }}</th>
                        <th>{{ __('Doctor Name') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->hour }}</td>
                            <td>{{ $appointment->user->name }}</td>
                            <td>{{ $appointment->clinic->speciality }}</td>
                            <td>{{ $appointment->doctor->name }}</td>
                            <td>
                                <a href="{{ route('appointment.show', $appointment->id) }}" class="btn btn-info btn-sm me-2">{{ __('Show') }}</a>
                                <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-warning btn-sm me-2">{{ __('Edit') }}</a>
                                <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
