@extends('layouts.app')

@section('title', 'Listado de Doctores')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                <h1>Registro de Doctor</h1>
                <form method="POST" action="{{ route('doctor.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-start">{{ __('auth.name') }}</label>
                        <div class="col-md-9">
                            <input id="name" type="text"
                                class="form-control form-control-lg shadow rounded @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="paternal_surname"
                            class="col-md-4 col-form-label text-md-start">{{ __('auth.Paternal Surname') }}</label>
                        <div class="col-md-9">
                            <input id="paternal_surname" type="text"
                                class="form-control form-control-lg shadow rounded @error('paternal_surname') is-invalid @enderror"
                                name="paternal_surname" value="{{ old('paternal_surname') }}" required
                                autocomplete="paternal_surname" autofocus>
                            @error('paternal_surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="maternal_surname"
                            class="col-md-4 col-form-label text-md-start">{{ __('auth.Maternal Surname') }}</label>
                        <div class="col-md-9">
                            <input id="maternal_surname" type="text"
                                class="form-control form-control-lg shadow rounded @error('maternal_surname') is-invalid @enderror"
                                name="maternal_surname" value="{{ old('maternal_surname') }}" required
                                autocomplete="maternal_surname" autofocus>
                            @error('maternal_surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="speciality"
                            class="col-md-4 col-form-label text-md-start">{{ __('appointment.speciality') }}</label>
                        <div class="col-md-9">
                            <select class="form-select form-control-lg shadow rounded" aria-label="Default select example"
                                id="clinics_id" name="clinics_id" required>
                                <option selected>Especialidad</option>
                                @foreach ($clinicsSpeciality as $speciality)
                                    <option value="{{ $speciality->id }}">{{ $speciality->speciality }}</option>
                                @endforeach
                            </select>
                            @error('speciality')
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

            <div class="col-md-8">
                <h2 class="text-center mb-4">Listado de Doctores</h2>
                <div class="table-responsive-md">
                    <table class="table table-striped table-hover table-borderless table-primary align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Apellido Paterno') }}</th>
                                <th>{{ __('Apellido Materno') }}</th>
                                <th>{{ __('Especialidad') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($doctors as $doctor)
                                <tr class="table-primary" data-bs-toggle="modal"
                                    data-bs-target="#doctorModal{{ $doctor->id }}">
                                    <td scope="row">{{ $doctor->name }}</td>
                                    <td>{{ $doctor->paternal_surname }}</td>
                                    <td>{{ $doctor->maternal_surname }}</td>
                                    <td>{{ $doctor->clinics->speciality }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Enlaces de paginación -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation example"></nav>
                    <ul class="pagination">
                        <li class="page-item {{ $doctors->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $doctors->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $doctors->lastPage(); $i++)
                            <li class="page-item {{ $doctors->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $doctors->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $doctors->currentPage() == $doctors->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $doctors->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                    </nav>
                </div>

                @foreach ($doctors as $doctor)
                    <div class="modal fade" id="doctorModal{{ $doctor->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="doctorModalLabel{{ $doctor->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="doctorModalLabel{{ $doctor->id }}">Editar Doctor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('doctor.update', $doctor->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group row mb-4">
                                            <label for="name"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                    class="form-control form-control-lg shadow rounded @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name', $doctor->name) }}" required
                                                    autocomplete="name" autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="paternal_surname"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Paternal Surname') }}</label>
                                            <div class="col-md-6">
                                                <input id="paternal_surname" type="text"
                                                    class="form-control form-control-lg shadow rounded @error('paternal_surname') is-invalid @enderror"
                                                    name="paternal_surname"
                                                    value="{{ old('paternal_surname', $doctor->paternal_surname) }}"
                                                    required autocomplete="paternal_surname" autofocus>
                                                @error('paternal_surname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="maternal_surname"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Maternal Surname') }}</label>
                                            <div class="col-md-6">
                                                <input id="maternal_surname" type="text"
                                                    class="form-control form-control-lg shadow rounded @error('maternal_surname') is-invalid @enderror"
                                                    name="maternal_surname"
                                                    value="{{ old('maternal_surname', $doctor->maternal_surname) }}"
                                                    required autocomplete="maternal_surname" autofocus>
                                                @error('maternal_surname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="clinics_id"
                                                class="col-md-4 col-form-label text-md-end">{{ __('appointment.speciality') }}</label>
                                            <div class="col-md-6">
                                                <select class="form-select form-control-lg shadow rounded"
                                                    aria-label="Default select example" id="clinics_id" name="clinics_id"
                                                    required>
                                                    <option selected>Especialidad</option>
                                                    @foreach ($clinicsSpeciality as $speciality)
                                                        <option value="{{ $speciality->id }}">
                                                            {{ $speciality->speciality }}</option>
                                                    @endforeach
                                                </select>
                                                @error('clinics_id')
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
                                            <button type="submit"
                                                class="btn btn-primary btn-lg">{{ __('Update') }}</button>
                                        </div>

                                    </form>

                                    <div class="col-md-12">
                                        <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-lg"
                                                onclick="return confirm('{{ __('confirm.Are you sure?') }}')">{{ __('Delete') }}</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
@endpush
