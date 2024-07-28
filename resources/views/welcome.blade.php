
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('dashboard.Welcome') }}</div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                            <div class="container">
                                <div class="row justify-content-center my-5">
                                    <div class="col-md-8">
                                        <div class="card shadow-lg border-0">
                                            <div class="card-header bg-primary text-white text-center">
                                                <h3>{{ __('dashboard.Welcome') }} {{Auth::user()->name}}</h3>
                                            </div>
                                            <div class="card-body">
                                                @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif

                                                @auth
                                                <h4 class="text-center mb-4">{{ __('auth.You are logged in correctly') }} </h4>
                                                @endauth


                                                <div class="row text-center mb-4">
                                                    <div class="col-md-4">
                                                        <img src="{{ asset('img/medico-color.png') }}" class="img-fluid mb-2" alt="Doctor Image">
                                                        <h5>Our Doctors</h5>
                                                        <p>Meet our experienced and dedicated medical team.</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <img src="{{ asset('img/service doctor.jpg') }}" width="150" height="150" class="img-fluid mb-2 rounded-circle" alt="Services Image">
                                                        <h5>Our Services</h5>
                                                        <p>Explore the range of services we offer to our patients.</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <img src="{{ asset('img/contact doctor.jpg') }}" width="130" height="130" class="img-fluid mb-2 rounded-circle"  alt="Contact Image">
                                                        <h5>Contact Us</h5>
                                                        <p>Get in touch with us for appointments and inquiries.</p>
                                                    </div>
                                                </div>

                                                <div class="d-grid gap-2 d-md-block text-center">
                                                    <a href="{{ route('appointment.main') }}" class="btn btn-primary btn-lg me-md-2 mb-2 button-expand">Book an Appointment</a>
                                                    <a href="{{ route('clinic.showIndex') }}" class="btn btn-outline-primary btn-lg mb-2 button-expand">View Clinics</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                {{__("auth.Login")}}
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        {{__("auth.Register")}}
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
