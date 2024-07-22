@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">{{ __('Doctor') }}</h2>

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
            <a href="{{ route('doctor.formRegister') }}" class="btn btn-primary">{{ __('Create New Doctor') }}</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Paternal Surname') }}</th>
                        <th>{{ __('Maternal Surname') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->paternal_surname }}</td>
                            <td>{{ $doctor->maternal_surname }}</td>
                            <td>
                                
                                <a href="{{ route('doctor.edit', $doctor->id) }}" class="btn btn-warning btn-sm me-2">{{ __('Edit') }}</a>
                                <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" style="display:inline;">
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