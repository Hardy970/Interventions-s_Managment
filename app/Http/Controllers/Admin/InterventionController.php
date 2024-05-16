<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Produit;
use App\Models\Demandeur;
use App\Models\TypeDemande;
use App\Models\Intervention;
use Illuminate\Http\Request;
use App\Models\FaitGenerateur;
use App\Models\TypeIntervention;
use App\Http\Controllers\Controller;
use App\Http\Requests\InterventionRequest;
use App\Models\Vehicule;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Intervention::first()->getDateDemande();
        return view('admin.intervention.index',['interventions'=> Intervention::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.intervention.form',['intervention'=>new Intervention(),'vehicules'=>Vehicule::all(),'chauffeurs'=>Vehicule::all(),'consultants'=>User::all(),'faitsgenerateurs'=>FaitGenerateur::all(),'demandeurs'=>Demandeur::all(),'typesdemandes'=>TypeDemande::all(),'typesinterventions'=>TypeIntervention::all(),'produits'=>Produit::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */             
    public function store(InterventionRequest $request)
    {
        $intervention= Intervention::create($request->validated());
        $intervention->typesdemandes()->sync($request->validated('typesdemandes'));
        $intervention->produits()->sync($request->validated('produits'));
        $intervention->consultants()->sync($request->validated('consultants'));
        $intervention->typesinterventions()->sync($request->validated('typesinterventions'));
        return redirect()->route('admin.interventions.index')->with('success','Intervention créee avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intervention $intervention)
    {
        return view('admin.intervention.form',['intervention'=>$intervention,'vehicules'=>Vehicule::all(),'chauffeurs'=>Vehicule::all(),'consultants'=>User::all(),'faitsgenerateurs'=>FaitGenerateur::all(),'demandeurs'=>Demandeur::all(),'typesdemandes'=>TypeDemande::all(),'typesinterventions'=>TypeIntervention::all(),'produits'=>Produit::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InterventionRequest $request, Intervention $intervention)
    {
        $intervention->update($request->validated());
        $intervention->typesdemandes()->sync($request->validated('typesdemandes'));
        $intervention->produits()->sync($request->validated('produits'));
        $intervention->consultants()->sync($request->validated('consultants'));
        $intervention->typesinterventions()->sync($request->validated('typesinterventions'));
        return to_route('admin.interventions.index')->with('success','Intervention mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intervention $intervention)
    {
        $intervention->delete();
        return to_route('admin.interventions.index')->with('success','Intervention supprimée avec succès');
    }
}
