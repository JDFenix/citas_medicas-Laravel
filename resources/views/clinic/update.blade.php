@extends('layouts.app')

@section('content')
<h3>Actualizar datos de la Clinica con especialidad {{$clinic['speciality']}}</h3>
<form action="{{ route('clinic.update', $clinic->id) }}" method="POST">
    @csrf
    <input hidden name="id" value="{{$clinic['id']}}">

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('appointment.Speciality Name') }}</label>
        <div class="col-md-6">
            <input id="speciality" type="text" class="form-control @error('speciality') is-invalid @enderror" name="speciality"
                   value="{{ $clinic['speciality'] }}" required autocomplete="speciality" autofocus>
            @error('speciality')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <label for="consultory" class="col-md-4 col-form-label text-md-end">{{ __('appointment.Consultory Number') }}</label>
            <input id="consultory" type="number" class="form-control @error('consultory') is-invalid @enderror" name="consultory"
                   value="{{$clinic['consultory'] }}" required autocomplete="consultory" autofocus>
            @error('consultory')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <button type="submit">Actualizar</button>
        </div>
    </div>
</form>
@endsection
