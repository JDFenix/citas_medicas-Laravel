<?php

// app/Http/Controllers/AppointmentController.php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Clinic;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointment.main', compact('appointments'));
    }

    public function create()
    {
        $clinicsSpeciality = Clinic::all();
        return view("appointment.register")
            ->with(['clinicsSpeciality' => $clinicsSpeciality]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'users_id' => 'required|exists:users,id',
            'clinics_id' => 'required|exists:clinics,id',
            'doctors_id' => 'required|exists:doctors,id',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointment.index')->with('success', 'Appointment created successfully.');
    }

    public function show($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('appointment.index')->with('error', 'Appointment not found.');
        }

        return view('appointment.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('appointment.index')->with('error', 'Appointment not found.');
        }

        return view('appointment.edit', compact('appointment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'users_id' => 'required|exists:users,id',
            'clinics_id' => 'required|exists:clinics,id',
            'doctors_id' => 'required|exists:doctors,id',
        ]);

        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('appointment.index')->with('error', 'Appointment not found.');
        }

        $appointment->update($request->all());

        return redirect()->route('appointment.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('appointment.index')->with('error', 'Appointment not found.');
        }

        $appointment->delete();

        return redirect()->route('appointment.index')->with('success', 'Appointment deleted successfully.');
    }
}