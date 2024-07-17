@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">{{ __('appointment.title', ['name' => Auth::user()->name]) }}</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ __('appointment.success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ __('appointment.error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="mb-4">
            <a href="{{ route('appointment.formRegister') }}" class="btn btn-primary">{{ __('appointment.request_new') }}</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('appointment.date') }}</th>
                        <th>{{ __('appointment.hour') }}</th>
                        <th>{{ __('appointment.patient_name') }}</th>
                        <th>{{ __('appointment.speciality') }}</th>
                        <th>{{ __('appointment.doctor_name') }}</th>
                        <th>{{ __('appointment.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->hour }}</td>
                            <td>{{ $appointment->users->name }}</td>
                            <td>{{ $appointment->clinics->speciality }}</td>
                            <td>{{ $appointment->doctors->name }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    {{ __('appointment.show') }}
                                </button>
                                <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-warning btn-sm me-2">{{ __('appointment.edit') }}</a>
                                <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('appointment.delete_confirmation') }}')">{{ __('appointment.delete') }}</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            {{ __('appointment.modal_title', ['speciality' => $appointment->clinics->speciality]) }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>{{ __('appointment.modal_body', [
                                            'date' => $appointment->date,
                                            'hour' => $appointment->hour,
                                            'speciality' => $appointment->clinics->speciality,
                                            'consultory' => $appointment->clinics->consultory,
                                            'doctor' => $appointment->doctors->name . ' ' . $appointment->doctors->paternal_surname . ' ' . $appointment->doctors->maternal_surname
                                        ]) }}</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('appointment.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
