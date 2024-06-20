@extends('layouts.app')

@section('content')
<h3>Registrar Clinica</h3>
<form method="POST" action="{{ route('clinic.post') }}" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('appointment.Speciality Name') }}</label>
        <div class="col-md-6">
            <input id="speciality" type="text" class="form-control @error('speciality') is-invalid @enderror" name="speciality"
                   value="{{ old('speciality') }}" required autocomplete="speciality" autofocus>
            @error('speciality')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <label for="consultory" class="col-md-4 col-form-label text-md-end">{{ __('appointment.Consultory Number') }}</label>
            <input id="consultory" type="number" class="form-control @error('consultory') is-invalid @enderror" name="consultory"
                   value="{{ old('consultory') }}" required autocomplete="consultory" autofocus>
            @error('consultory')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <button type="submit">Registrar</button>
        </div>
    </div>

</form>
@endsection
