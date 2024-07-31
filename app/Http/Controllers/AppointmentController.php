<?php

// app/Http/Controllers/AppointmentController.php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        
        $appointments = Appointment::where('users_id', Auth::user()->id)
            ->whereDate('date', '>=', $today) 
            ->get();
        
        return view('home', compact('appointments'));
    }
    
    

    public function create()
    {
        $clinicsSpeciality = Clinic::all();
        //$clinics_id = $clinicsSpeciality->id;
        $doctorSpecific = Doctor::all()->first();
        return view("appointment.register")
            ->with([
                'clinicsSpeciality' => $clinicsSpeciality,
                'doctorSpecific' => $doctorSpecific
            ]);
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'hour' => 'required|date_format:H:i|after:07:59|before:18:00',
            'users_id' => 'required|exists:users,id',
            'clinics_id' => 'required|exists:clinics,id',
            'doctors_id' => 'required|exists:doctors,id',
        ]);
    
        $appointmentDateTime = new \DateTime($request->date . ' ' . $request->hour);
    
        $existingAppointments = Appointment::where('date', $request->date)
            ->where('hour', $request->hour)
            ->where('clinics_id', $request->clinics_id)
            ->exists();
    
        if ($existingAppointments) {
            return redirect()->back()->with('error', 'Ya existe una cita agendada para esa especialidad en la misma fecha y hora.');
        }
    
        $appointments = Appointment::where('date', $request->date)
            ->where('doctors_id', $request->doctors_id)
            ->get();
    
        foreach ($appointments as $appointment) {
            $appointmentTime = new \DateTime($appointment->date . ' ' . $appointment->hour);
            $interval = $appointmentTime->diff($appointmentDateTime);
    
            if ($interval->h == 0 && $interval->i < 25) {
                $recommendedTime = (clone $appointmentDateTime)->modify('+25 minutes');
    
                return redirect()->back()->with('error', 'No se puede agendar la cita. Intente con la siguiente hora disponible: ' . $recommendedTime->format('H:i') . ' en la misma fecha.');
            }
        }
        
        Appointment::create($request->all());
    
        return redirect()->route('appointment.main')->with('success', 'Cita creada correctamente');
    }
    
    
    

    public function show($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('appointment.main')->with('error', 'Appointment not found.');
        }

        return view('appointment.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('appointment.main')->with('error', 'Appointment not found.');
        }

        $clinicsSpeciality = Clinic::all();

        return view('appointment.edit', compact('appointment', 'clinicsSpeciality'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
            'doctors_id' => 'required|exists:doctors,id',
            'clinics_id' => 'required|exists:clinics,id',
        ]);

        $appointment = Appointment::find($id);
        $appointment->date = $request->date;
        $appointment->hour = $request->hour;
        $appointment->doctors_id = $request->doctors_id;
        $appointment->clinics_id = $request->clinics_id;
        $appointment->save();

        return redirect()->route('appointment.main')->with('success', 'Appointment updated successfully');
    }





    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('appointment.main')->with('error', 'Appointment not found.');
        }

        $appointment->delete();

        return redirect()->route('appointment.main')->with('success', 'Appointment deleted successfully.');
    }
}