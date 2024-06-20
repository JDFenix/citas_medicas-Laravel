@extends('layouts.app')

@section('content')
<a href="{{route('clinic.showCreate')}}"> Registrar Clinica</a>


@foreach($clinics as $clinic)
    <p>{{$clinic['speciality']}}</p>
    <p>{{$clinic['consultory']}}</p>

    <form action="{{ route('clinic.getClinic', ['cipherid' => encrypt($clinic['id'])]) }}" method="post">
        @csrf
        <input type="text" name="{{$clinic['id'] }}" id="id" hidden>
        <button type="submit" style="width: 100px" class="btn btn-primary">Modificar</button>
    </form><br>


    <form action="{{ route('clinic.deleteClinic', ['cipherid' => encrypt($clinic['id'])]) }}" method="post">
        @csrf
        @method('delete')
        <input type="text" name="id" value="{{ $clinic['id'] }}" hidden>
        <button type="submit" style="width: 100px" class="btn btn-danger">Borrar</button>
    </form>
@endforeach
</body>
</html>
    @endsection
