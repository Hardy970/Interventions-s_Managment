<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chauffeur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChauffeurRequest;

class ChauffeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.chauffeur.index',['chauffeurs'=>chauffeur::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.chauffeur.form',['chauffeur'=>new Chauffeur()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChauffeurRequest $request)
    {
        Chauffeur::create($request->validated());
        return redirect()->route('admin.chauffeur.index')->with('success','Chauffeur ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chauffeur $chauffeur)
    {
        return view('admin.chauffeur.form',['chauffeur'=>$chauffeur]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChauffeurRequest $request, Chauffeur $chauffeur)
    {
        $chauffeur->update($request->validated());
        return redirect()->route('admin.chauffeur.index')->with('success','Chauffeur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chauffeur $chauffeur)
    {
        $chauffeur->delete();
        return redirect()->route('admin.chauffeur.index')->with('success','Chauffeur supprimé avec succès');
    }
}
