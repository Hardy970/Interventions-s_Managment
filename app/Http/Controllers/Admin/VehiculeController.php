<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehiculeRequest;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.vehicule.index',['vehicules'=>Vehicule::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicule.form',['vehicule'=>new Vehicule()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehiculeRequest $request)
    {
        Vehicule::create($request->validated());
        return redirect()->route('admin.vehicule.index')->with('success','Véhicule ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicule $vehicule)
    {
        return view('admin.vehicule.form',['vehicule'=>$vehicule]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehiculeRequest $request, Vehicule $vehicule)
    {
        $vehicule->update($request->validated());
        return redirect()->route('admin.vehicule.index')->with('success','Véhicule mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return redirect()->route('admin.vehicule.index')->with('success','Véhicule supprimé avec succès');
    }
}
