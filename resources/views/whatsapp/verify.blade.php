@extends('layouts.app')

@section('title', 'Verificación')

@push('styles')
    <style>
        .progress-bar-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: #e9ecef;
        }

        .progress-bar {
            width: 100%;
            height: 100%;
            background-color: #28a745;
        }
    </style>
@endpush

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container d-flex justify-content-center min-vh-100 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center position-relative">
                        <h4 class="my-2">Verificación</h4>
                        <div class="progress-bar-container">
                            <div id="progressBar" class="progress-bar"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('whatsapp.verifyCode') }}">
                            @csrf
                            <input type="hidden" name="id_user" value="{{ $user->id }}">
                            <input type="hidden" name="code" id="verificationCode">
                            <div class="mb-4">
                                <label for="verificationCode" class="form-label">
                                    Ingrese el código de verificación enviado por Whatsapp al número +52 ****
                                    **{{ substr($user->mobile_phone, -2) }}
                                </label>
                                <div class="d-flex justify-content-center">
                                    <input type="text" class="form-control text-center mx-2 verification-code"
                                        id="code1" maxlength="1" required>
                                    <input type="text" class="form-control text-center mx-2 verification-code"
                                        id="code2" maxlength="1" required>
                                    <input type="text" class="form-control text-center mx-2 verification-code"
                                        id="code3" maxlength="1" required>
                                    <input type="text" class="form-control text-center mx-2 verification-code"
                                        id="code4" maxlength="1" required>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" id="verifyButton" disabled>Verificar</button>
                            </div>
                        </form>
                        <div class="mt-4 text-center">
                            <p>El código expira en <span id="countdown">10:00</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const countdownElement = document.getElementById('countdown');
            const progressBar = document.getElementById('progressBar');
            const verificationCodeInput = document.getElementById('verificationCode');
            let timeLeft = 10 * 60;

            const countdownTimer = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                countdownElement.innerHTML = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                const progressPercent = (timeLeft / (10 * 60)) * 100;
                progressBar.style.width = `${progressPercent}%`;

                if (timeLeft <= 0) {
                    clearInterval(countdownTimer);
                    countdownElement.innerHTML = 'El tiempo ha expirado';
                    progressBar.style.width = '0%';
                }
                timeLeft--;
            }, 1000);

            const inputs = document.querySelectorAll('.verification-code');
            const verifyButton = document.getElementById('verifyButton');

            inputs.forEach((input, index) => {
                input.addEventListener('input', (event) => {
                    if (input.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    toggleVerifyButton();
                    updateVerificationCode();
                });
            });

            const toggleVerifyButton = () => {
                const allFilled = Array.from(inputs).every(input => input.value.length === 1);
                verifyButton.disabled = !allFilled;
            };

            const updateVerificationCode = () => {
                const code = Array.from(inputs).map(input => input.value).join('');
                verificationCodeInput.value = code;
            };
        });
    </script>
@endpush
