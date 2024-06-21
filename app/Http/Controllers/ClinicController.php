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
        return view('clinic.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clinic.register');
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

        return redirect()->route('clinic.showIndex')->with('success', 'Clínica creada exitosamente.');
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
    public function edit(string $cipherid)
    {
        $id = decrypt($cipherid);
        $clinic = Clinic::findOrFail($id);
        return view('clinic.update')->with(['clinic' =>  $clinic]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $consultoryData = $request->validate([
            'id' => 'nullable',
            'speciality' => 'nullable|string|max:255',
            'consultory' => 'nullable|integer',
        ]);

        $clinic = Clinic::findOrFail($consultoryData['id']);
        $clinic->update($consultoryData);

        return redirect()->route('clinic.showIndex')->with('success', 'Clínica actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $cipherid)
    {
        $id = decrypt($cipherid);
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();
        return $this->index();
    }
}
