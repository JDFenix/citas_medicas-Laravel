@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-5">
        <div class="card" style="width: 80%; min-height: 400px;">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex flex-column align-items-center p-3 position-relative">
                    <div id="avatar-container" class="avatar mb-4 position-absolute" style="top: 10px; left: 10px; display: none;">
                        <label for="avatarInput" class="avatar-label">
                            <img src="{{Auth::user()->avatar}}" alt="Avatar" class="rounded-circle" width="150" height="150">
                        </label>
                        <input type="file" id="avatarInput" class="d-none" accept="image/*">
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center w-100" style="flex-grow: 1;">
                        <div class="btn-group-vertical w-100" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-secondary mb-2" onclick="changeSection('personal-data')">Datos Personales</button>
                            <button type="button" class="btn btn-outline-secondary mb-2" onclick="changeSection('email')">Email</button>
                            <button type="button" class="btn btn-outline-secondary mb-2" onclick="changeSection('password-auth')">Contraseña y Autenticación</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <!-- Sección de Datos Personales -->
                        <div id="personal-data" class="content-section">
                            <h5 class="card-title">Datos Personales</h5>
                            <form>
                                <div class="form-group">
                                    <label for="login-method">Modo de inicio de sesión</label>
                                    <input type="text" class="form-control" id="login-method" value="Google" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="curp">Curp</label>
                                    <input type="text" class="form-control" id="curp" placeholder="Nombre(s) del doctor">
                                </div>
                                <div class="form-group">
                                    <label for="first-name">Nombre(s) del paciente</label>
                                    <input type="text" class="form-control" id="first-name" placeholder="Nombre(s) del paciente">
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Apellido paterno</label>
                                    <input type="text" class="form-control" id="last-name" placeholder="Apellido paterno">
                                </div>
                                <div class="form-group">
                                    <label for="middle-name">Apellido materno</label>
                                    <input type="text" class="form-control" id="middle-name" placeholder="Apellido materno">
                                </div>
                                <div class="form-group">
                                    <label for="birth-date">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="birth-date">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Confirmar</button>
                                    <button type="button" class="btn btn-danger">Eliminar cuenta</button>
                                </div>
                            </form>
                        </div>

                        <!-- Sección de Email -->
                        <div id="email" class="content-section" style="display:none;">
                            <h5 class="card-title">Email</h5>
                            <p>Email: {{ Auth::user()->email }}</p>
                            <!-- Más detalles de email aquí -->
                        </div>

                        <!-- Sección de Contraseña y Autenticación -->
                        <div id="password-auth" class="content-section" style="display:none;">
                            <h5 class="card-title">Contraseña y Autenticación</h5>
                            <p>Configuraciones de seguridad y contraseña.</p>
                            <!-- Más detalles de seguridad aquí -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function changeSection(sectionId) {
            // Ocultar todas las secciones
            document.querySelectorAll('.content-section').forEach(function(section) {
                section.style.display = 'none';
            });

            // Mostrar la sección seleccionada
            document.getElementById(sectionId).style.display = 'block';

            // Mostrar/Ocultar el contenedor del avatar según la sección
            if (sectionId === 'personal-data') {
                document.getElementById('avatar-container').style.display = 'block';
            } else {
                document.getElementById('avatar-container').style.display = 'none';
            }
        }

        // Función para manejar el cambio de imagen del avatar
        document.getElementById('avatarInput').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.avatar-label img').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        // Mostrar la sección de Datos Personales y el avatar por defecto
        document.addEventListener('DOMContentLoaded', function() {
            changeSection('personal-data');
        });
    </script>
@endpush

<style>
    .avatar {
        position: relative;
    }
    .avatar-label {
        cursor: pointer;
    }
    .avatar-label img {
        border: 2px solid #ddd;
        padding: 5px;
    }
</style>
