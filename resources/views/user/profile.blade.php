@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-5">
        <div class="row no-gutters w-100">
            <div class="col-md-4 d-flex flex-column align-items-center p-3 position-relative">
                <div class="d-flex flex-column justify-content-end align-items-end w-100" style="flex-grow: 1;">
                    <div class="btn-group-vertical w-100" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary mb-2 btn-lg"
                            onclick="changeSection('personal-data')">Datos Personales
                        </button>
                        <button type="button" class="btn btn-outline-secondary mb-2 btn-lg"
                            onclick="changeSection('email')">Email
                        </button>
                        <button type="button" class="btn btn-outline-secondary mb-2 btn-lg"
                            onclick="changeSection('password-auth')">Contraseña y Autenticación
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card fixed-height-card">
                    <div class="card-body d-flex align-items-start">

                        <div class="w-100">

                            <div id="personal-data" class="content-section">

                                <div class="col-md-12 d-flex justify-content-center ">
                                    <h3 class="card-title">Datos Personales</h3>
                                    <hr>
                                </div>

                                <form action="{{ route('user.updateProfile') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                         <div class="col-md-3 d-flex flex-column align-items-center">
                                        <div id="avatar-container" class="mb-4 justify-content-start align-items-start">
                                            <label for="avatarInput" class="avatar-label">
                                                <h6 class="d-flex justify-content-center">Avatar:</h6>
                                                <img data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-toggle="tooltip" title="Cambiar Avatar"
                                                    src="{{ Auth::user()->avatar }}" alt="Avatar" style="background: #5c5c5cbe" class="rounded-circle avatar-form"
                                                    width="180" height="180">
                                            </label>
                                        </div>
                                    </div>


                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="login-method">Modo de inicio de sesión</label>
                                                        <input type="text" class="form-control" id="login-method"
                                                               value="Google" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="birth-date">Fecha de nacimiento</label>
                                                        <input type="date" class="form-control" name="birth_date" value="{{ Auth::user()->birth_date }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="first-name">Nombre(s) del paciente</label>
                                                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Nombre(s) del paciente">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="last-name">Apellido paterno</label>
                                                        <input type="text" class="form-control" name="paternal_surname" value="{{ Auth::user()->paternal_surname }}" placeholder="Apellido paterno">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="middle-name">Apellido materno</label>
                                                        <input type="text" class="form-control" name="maternal_surname" value="{{ Auth::user()->maternal_surname }}" placeholder="Apellido materno">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-center mt-3">
                                                    <button type="submit" class="btn btn-success mr-2 me-3">Confirmar</button>
                                                        <button type="button" class="btn btn-danger">Eliminar
                                                            cuenta
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>

                            <div id="email" class="content-section" style="display:none;">
                                <div class="col-md-12 d-flex justify-content-center ">
                                    <h3 class="card-title">Email</h3>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <form action="{{ route('user.updateEmail') }}" method="POST">
                                            @csrf
                                            <label for="email">Correo electrónico:</label>
                                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" id="email" placeholder="Correo electrónico">
                                            <div class="form-text col-12 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success mt-3">Actualizar</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="password-auth" class="content-section" style="display:none;">

                                <div class="col-md-12 d-flex justify-content-center ">
                                    <h3 class="card-title">Contraseña y Autenticación</h3>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <form action="{{ route('user.updatePassword') }}" method="POST">
                                        @csrf
                                        <label for="current-password">Contraseña actual:</label>
                                        <input type="password" name="current_password" class="form-control" id="current-password" placeholder="Contraseña actual">

                                        <label class="mt-3" for="new-password">Nueva contraseña:</label>
                                        <input type="password" name="new_password" class="form-control" id="new-password" placeholder="Nueva contraseña">

                                        <label class="mt-3" for="new-password-confirmation">Confirmar nueva contraseña:</label>
                                        <input type="password" name="new_password_confirmation" class="form-control" id="new-password-confirmation" placeholder="Confirmar nueva contraseña">

                                        <div class="form-text col-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success mt-3">Actualizar</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="mobile_phone">Numero de telefono:</label>
                                        <input type="text" class="form-control" name="mobile_phone" id="mobile_phone"
                                            placeholder="Numero de telefono">
                                    </div>

                                    <div class="col-md-auto mt-3 p-1">
                                        <div class="p-2 bg-success text-white rounded">
                                            Numero de telefono verificado
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-3" id="exampleModalLabel">Cambio de avatar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-2">
                                <h5 class="fs-5">Selecciona un avatar</h5>
                                <form id="avatar-form" action="" method="post">
                                    <div id="carouselPixelArt" class="carousel carousel-dark slide"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($pixelArtUrls as $index => $avatar)
                                                <form action="" method="post" id="form-{{ $index }}">
                                                    @csrf
                                                    <input type="hidden" name="avatar" value="{{ $avatar }}">

                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                        <img src="{{ $avatar }}"
                                                            id="avatar-image-option-{{ $index }}"
                                                            class="d-block w-85 h-85 rounded-circle avatar-image"
                                                            alt="Pixel Art Avatar {{ $index + 1 }}">

                                                        <button type="submit" hidden="true"
                                                            id="button-form-{{ $index }}"></button>
                                                    </div>
                                                </form>
                                            @endforeach

                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselPixelArt" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselPixelArt" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-2">
                                <div id="carouselAvataaars" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($avataaarsUrls as $index => $avatar)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ $avatar }}"
                                                    class="d-block w-85 rounded-circle avatar-image rounded"
                                                    alt="avataaars Avatar {{ $index + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselAvataaars" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselAvataaars" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div id="carouselAdventurer" class="carousel carousel-dark slide"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($adventurerUrls as $index => $avatar)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ $avatar }}"
                                                    class="d-block w-85 rounded-circle avatar-image rounded"
                                                    alt="Pixel Art Avatar {{ $index + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselAdventurer" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselAdventurer" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.avatar-image').forEach((img, index) => {
                img.addEventListener('click', () => {
                    document.getElementById(`form-${index}`).submit();
                });
            });
        });


        function changeSection(sectionId) {


            // Ocultar todas las secciones
            document.querySelectorAll('.content-section').forEach(function(section) {
                section.style.display = 'none';
            });

            // Mostrar la sección seleccionada
            document.getElementById(sectionId).style.display = 'block';

            // Mostrar/Ocultar el contenedor del avatar según la sección
            if (sectionId === 'personal-data') {
                document.getElementById('avatar-container').style.display = 'flex';
            } else {
                document.getElementById('avatar-container').style.display = 'none';
            }
        }


        document.getElementById('avatarInput').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.avatar-label img').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });


        document.addEventListener('DOMContentLoaded', function() {
            changeSection('personal-data');
        });
    </script>
@endpush

<style>
    .fixed-height-card {
        width: 100%;
        min-height: 350px;
        height: 100%;
    }


    .avatar-image:hover {
        opacity: 90%;
        transform: scale(1.03);
    }

    .avatar-image {
        background: #5c5c5cbe;
        transition: transform 0.3s ease-in-out;
        cursor: pointer;
        max-height: 100%;
        max-width: 95%;

    }

    .avatar-form:hover {
        opacity: 80%;
        cursor: pointer;
    }

    .custom-margin-row {
        margin-left: 15px;
        margin-right: 15px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #16c462;
        border-radius: 50%;
    }
</style>
