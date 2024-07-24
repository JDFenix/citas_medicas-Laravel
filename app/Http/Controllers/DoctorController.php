<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Clinic;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::paginate(8); 
        $clinicsSpeciality = Clinic::all();
        return view('doctor.main', compact('doctors', 'clinicsSpeciality'));
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clinicsSpeciality = Clinic::all();
        return view("doctor.register")->with(['clinicsSpeciality' => $clinicsSpeciality]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'paternal_surname' => 'required|string|max:255',
            'maternal_surname' => 'required|string|max:255',
            'clinics_id' => 'required|exists:clinics,id',
        ]);
    
        Doctor::create($request->all());
    
        return redirect()->route('doctor.main')->with('success', 'Doctor created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return redirect()->route('doctor.main')->with('error', 'Doctor not found.');
        }

        return view('doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = Doctor::find($id);
    
        if (!$doctor) {
            return redirect()->route('doctor.main')->with('error', 'doctor not found.');
        }
    
        $clinicsSpeciality = Clinic::all();
        
        return view('doctor.edit', compact('doctor', 'clinicsSpeciality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'paternal_surname' => 'required|string|max:255',
            'maternal_surname' => 'required|string|max:255',
        ]);
    
        $doctor = Doctor::find($id);
        $doctor->name = $request->name;
        $doctor->paternal_surname = $request->paternal_surname;
        $doctor->maternal_surname = $request->maternal_surname;
        $doctor->save();
    
        return redirect()->route('doctor.main')->with('success', 'Doctor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return redirect()->route('doctor.main')->with('error', 'Doctor not found.');
        }

        $doctor->delete();

        return redirect()->route('doctor.main')->with('success', 'Doctor deleted successfully.');
    }
}