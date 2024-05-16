<?php

namespace App\Http\Controllers\Admin;

use App\Models\TypeDemande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeDemandeRequest;

class TypeDemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.typedemande.index',['typedemandes'=>TypeDemande::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.typedemande.form',['typedemande'=>new typedemande()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(typedemandeRequest $request)
    {
        typedemande::create($request->validated());
        return redirect()->route('admin.typedemande.index')->with('success','Type de demande ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeDemande $typedemande)
    {
        return view('admin.typedemande.form',['typedemande'=>$typedemande]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeDemandeRequest $request, TypeDemande $typedemande)
    {
        $typedemande->update($request->validated());
        return redirect()->route('admin.typedemande.index')->with('success','Type de demande mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeDemande $typedemande)
    {
        $typedemande->delete();
        return redirect()->route('admin.typedemande.index')->with('success','Type de demande supprimé avec succès');
    }
}
