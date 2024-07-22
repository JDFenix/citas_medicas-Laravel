@extends('layouts.app')

@section('template_title')
    {{ __('Edit Doctor') }}
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">{{ __('Edit Doctor') }}</h2>

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

        <form action="{{ route('doctor.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $doctor->name) }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="paternal_surname" class="col-md-4 col-form-label text-md-end">{{ __('Paternal Surname') }}</label>
                <div class="col-md-6">
                    <input id="paternal_surname" type="text" class="form-control @error('paternal_surname') is-invalid @enderror" name="paternal_surname" value="{{ old('paternal_surname', $doctor->paternal_surname) }}" required autocomplete="paternal_surname" autofocus>
                    @error('paternal_surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="maternal_surname" class="col-md-4 col-form-label text-md-end">{{ __('Maternal Surname') }}</label>
                <div class="col-md-6">
                    <input id="maternal_surname" type="text" class="form-control @error('maternal_surname') is-invalid @enderror" name="maternal_surname" value="{{ old('maternal_surname', $doctor->maternal_surname) }}" required autocomplete="maternal_surname" autofocus>
                    @error('maternal_surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __("Update Doctor") }}</button>
        </form>
    </div>
@endsection