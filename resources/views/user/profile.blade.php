@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-6">
            <img class="rounded-circle img-thumbnail " style="max-height: 250px; max-width: 250px"
                 src="{{ Auth::user()->avatar }}">
        </div>
        <div class="col-md-12">
            <p id="name" >Nombre de Pila</p>
            <input value="{{Auth::user()->name}}" name="name">

            <p id="name" >Nombre de Pila</p>
            <input value="{{Auth::user()->name}}" name="last name">

        </div>
    </div>

@endsection
