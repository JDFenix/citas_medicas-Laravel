<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $allAppointmentsByUser = Appointment::with('users')->get();
        return view('appointment.main', compact('allAppointmentsByUser'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clinicsSpeciality = Clinic::all();
        return view("appointment.register")
            ->with(['clinicsSpeciality' => $clinicsSpeciality]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataAppointment = $request->validate([
            'date' => 'nullable',
            'users_id' => 'nullable',
            'clinics_id' => 'nullable',
            'doctors_id' => 'nullable'
        ]);

        $newAppointment = Appointment::create($dataAppointment);

        return redirect()->route('appointment.main')->with('success', 'Clínica creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(appointment $appointment)
    {
        //
    }
}
