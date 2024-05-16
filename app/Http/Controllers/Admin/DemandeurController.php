<?php

namespace App\Http\Controllers\Admin;

use App\Models\Demandeur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DemandeurRequest;
use App\Models\Societe;

class DemandeurController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.demandeur.index',['demandeurs'=>Demandeur::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.demandeur.form',['demandeur'=>new Demandeur(),'societes'=>Societe::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DemandeurRequest $request)
    {
        Demandeur::create($request->validated());
        return redirect()->route('admin.demandeur.index')->with('success','Demandeur ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demandeur $demandeur)
    {
        return view('admin.demandeur.form',['demandeur'=>$demandeur,'societes'=>Societe::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DemandeurRequest $request, Demandeur $demandeur)
    {
        $demandeur->update($request->validated());
        return redirect()->route('admin.demandeur.index')->with('success','Demandeur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demandeur $demandeur)
    {
        $demandeur->delete();
        return redirect()->route('admin.demandeur.index')->with('success','Demandeur supprimé avec succès');
    }
}
