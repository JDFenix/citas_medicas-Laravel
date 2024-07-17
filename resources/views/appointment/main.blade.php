@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Citas de {{ Auth::user()->name }}</h2>

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
            <a href="{{ route('appointment.formRegister') }}" class="btn btn-primary">Solicitar Nueva Cita</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Especialidad</th>
                        <th>Doctor</th>
                        <th>Acciones</th>
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

                                <button type="button" class="btn btn-info btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Ver
                                </button>
                                <a href="{{ route('appointment.edit', $appointment->id) }}"
                                    class="btn btn-warning btn-sm me-2">Editar</a>
                                <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de que desea eliminar esta cita?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Cita para {{ $appointment->clinics->speciality }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Cita agendada para {{ $appointment->date }} a la hora {{ $appointment->hour }}
                                        </h5>
                                        <p>Favor de estar puntual en la clinica de especialidad en
                                            {{ $appointment->clinics->speciality }} en el consultorio
                                            {{ $appointment->clinics->consultory }} a la hora previamente agendada
                                            {{ $appointment->hour }} le
                                            atendera {{ $appointment->doctors->name }}
                                            {{ $appointment->doctors->paternal_surname }}
                                            {{ $appointment->doctors->maternal_surname }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
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
