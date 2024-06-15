<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinics = Clinic::all();
        return view('clinics.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clinics.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'speciality' => 'nullable|string|unique:clinics|max:255',
            'consultory' => 'nullable|integer|unique:clinics',
        ]);

        Clinic::create($validated);

        return redirect()->route('clinics.index')->with('success', 'Clínica creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinic $clinic)
    {
        return view('clinics.show', compact('clinic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clinic $clinic)
    {
        return view('clinics.edit', compact('clinic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinic $clinic)
    {
        $validated = $request->validate([
            'speciality' => 'nullable|string|unique:clinics,speciality,' . $clinic->id . '|max:255',
            'consultory' => 'nullable|integer|unique:clinics,consultory,' . $clinic->id,
        ]);

        $clinic->update($validated);

        return redirect()->route('clinics.index')->with('success', 'Clínica actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        return redirect()->route('clinics.index')->with('success', 'Clínica eliminada exitosamente.');
    }
}
