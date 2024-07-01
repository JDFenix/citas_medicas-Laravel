@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h2>Crear Cita</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{route('appointment.post')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date">{{__("appointment.Date")}}</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">{{__("appointment.Hour")}}</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="doctors_id">{{__("appointment.Doctor Name")}}</label>
                <input type="text" value="1" class="form-control" id="doctors_id" name="doctors_id" required>
            </div>
            <div class="form-group">
                <label for="clinics_id">{{__("appointment.Speciality")}}</label>
                <select class="form-control" id="clinics_id" name="clinics_id" required>
                    @foreach($clinicsSpeciality as $speciality)
                        <option value="{{$speciality['id']}}">{{$speciality['speciality']}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="specialty">{{__("appointment.Name Patient")}}</label>
                <input type="text" class="form-control"
                       value="{{Auth::user()->name ." ". Auth::user()->paternal_surname ." ". Auth::user()->maternal_surname}}"
                       required disabled>
                <input type="text" id="users_id" name="users_id" value="{{Auth::user()->id}}" hidden>
            </div>
            <button type="submit" class="btn btn-primary">{{__("appointment.Appointment Register")}}</button>
        </form>
    </div>

@endsection
