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
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>ID Usuario</th>
                        <th>ID Clínica</th>
                        <th>ID Doctor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->users_id }}</td>
                            <td>{{ $appointment->clinics_id }}</td>
                            <td>{{ $appointment->doctors_id }}</td>
                            <td>
                                <a href="{{ route('appointment.show', $appointment->id) }}"
                                    class="btn btn-info btn-sm me-2">Ver</a>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
