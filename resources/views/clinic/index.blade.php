@extends('layouts.app')

@section('title', 'Listado de Clínicas')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Formulario de Registro/Actualización -->
            <div class="col-4">
                <h1 id="form-title">Registrar Clínica</h1>
                <form method="POST" action="{{ route('clinic.post') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="clinic_id" id="clinic_id" value="">

                    <div class="form-group mb-3">
                        <label for="speciality"
                            class="col-md-4 col-form-label text-md-start">{{ __('appointment.Speciality Name') }}</label>
                        <div class="col-md-9">
                            <input id="speciality" type="text"
                                class="form-control form-control-lg shadow rounded @error('speciality') is-invalid @enderror"
                                name="speciality" value="{{ old('speciality') }}" required autocomplete="speciality"
                                autofocus>
                            @error('speciality')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="consultory"
                            class="col-md-4 col-form-label text-md-start">{{ __('appointment.Consultory Number') }}</label>
                        <div class="col-md-9">
                            <input id="consultory" type="number"
                                class="form-control form-control-lg shadow rounded @error('consultory') is-invalid @enderror"
                                name="consultory" value="{{ old('consultory') }}" required autocomplete="consultory"
                                autofocus>
                            @error('consultory')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-center col-md-8">
                        <div class="btn-group col-md-6" role="group">
                            <button type="submit" class="btn btn-success btn-lg btn-custom shadow">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Listado de Clínicas -->
            <div class="col-md-8">
                <h2 class="text-center mb-4">Listado de Clínicas</h2>
                <div class="table-responsive-md">
                    <table class="table table-striped table-hover table-borderless table-primary align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('appointment.speciality') }}</th>
                                <th>{{ __('appointment.consultory') }}</th>
                                <th>{{ __('appointment.date created') }}</th>
                                <th>{{ __('appointment.date updated') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            @foreach ($clinics as $clinic)
                                <tr class="table-primary" data-bs-toggle="modal"
                                    data-bs-target="#clinicModal{{ $clinic->id }}">
                                    <td scope="row">{{ $clinic->speciality }}</td>
                                    <td>{{ $clinic->consultory }}</td>
                                    <td>{{ $clinic->created_at }}</td>
                                    <td>{{ $clinic->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Enlaces de paginación -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item {{ $clinics->currentPage() == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $clinics->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $clinics->lastPage(); $i++)
                                <li class="page-item {{ $clinics->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $clinics->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $clinics->currentPage() == $clinics->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $clinics->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                @foreach ($clinics as $clinic)
                    <div class="modal fade" id="clinicModal{{ $clinic->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="doctorModalLabel{{ $clinic->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="doctorModalLabel{{ $clinic->id }}">Editar clinica</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('clinic.update', $clinic->id) }}" method="POST">
                                        @csrf
                                        <input hidden name="id" value="{{ $clinic['id'] }}">

                                        <div class="form-group row mb-4">
                                            <label for="name"
                                                class="col-md-4 col-form-label text-md-end">{{ __('appointment.speciality') }}</label>
                                            <div class="col-md-6">
                                                <input id="speciality" type="text"
                                                    class="form-control @error('speciality') is-invalid @enderror"
                                                    name="speciality" value="{{ $clinic['speciality'] }}" required
                                                    autocomplete="speciality" autofocus>
                                                @error('speciality')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="paternal_surname"
                                                class="col-md-4 col-form-label text-md-end">{{ __('appointment.consultory') }}</label>
                                            <div class="col-md-6">
                                                <input id="consultory" type="number"
                                                    class="form-control @error('consultory') is-invalid @enderror"
                                                    name="consultory" value="{{ $clinic['consultory'] }}" required
                                                    autocomplete="consultory" autofocus>
                                                @error('consultory')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-secondary btn-lg"
                                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary btn-lg"
                                                onclick="return confirm('{{ __('confirm.Do you want to update ?') }}')">{{ __('Update') }}</button>
                                        </div>

                                    </form>

                                    <div class="col-md-12">
                                        <form
                                            action="{{ route('clinic.deleteClinic', ['cipherid' => encrypt($clinic['id'])]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('{{ __('confirm.Are you sure?') }}')">Borrar</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function editClinic(clinic) {
            document.getElementById('form-title').innerText = 'Actualizar Clínica';
            document.getElementById('clinic-form').action = "{{ route('clinic.update', '') }}/" + clinic.id;
            document.getElementById('clinic_id').value = clinic.id;
            document.getElementById('speciality').value = clinic.speciality;
            document.getElementById('consultory').value = clinic.consultory;
        }
    </script>
@endpush
