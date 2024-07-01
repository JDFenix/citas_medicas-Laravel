@extends('layouts.app')

@section('content')

    Citas de {{Auth::user()->name}}

    <a href="{{route("appointment.formRegister")}}">Registro</a>


    @foreach($allAppointmentsByUser as $appointment)
        <p>{{$appointment->date}}</p>
        <p>{{$appointment->hour}}</p>
        <p>{{$appointment->clinics->speciality}}</p>
        <p>{{$appointment->clinics->consultory}}</p>
        <p>{{$appointment->users->name}}</p>

    @endforeach


@endsection
