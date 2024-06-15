@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h2>Crear Cita</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="" method="POST">
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
                <label for="specialty">{{__("appointment.Speciality")}}</label>
                <input type="text" class="form-control" id="specialty" name="specialty" required>
            </div>
            <button type="submit" class="btn btn-primary">{{__("appointment.Appointment Register")}}</button>
        </form>
    </div>

@endsection
