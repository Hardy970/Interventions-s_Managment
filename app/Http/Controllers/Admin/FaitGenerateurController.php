<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\FaitGenerateur;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaitGenerateurRequest;

class FaitGenerateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.faitgenerateur.index',['faitgenerateurs'=>FaitGenerateur::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faitgenerateur.form',['faitgenerateur'=>new FaitGenerateur()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaitGenerateurRequest $request)
    {
        FaitGenerateur::create($request->validated());
        return redirect()->route('admin.faitgenerateur.index')->with('success','Fait générateur ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaitGenerateur $faitgenerateur)
    {
        return view('admin.faitgenerateur.form',['faitgenerateur'=>$faitgenerateur]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaitGenerateurRequest $request, FaitGenerateur $faitgenerateur)
    {
        $faitgenerateur->update($request->validated());
        return redirect()->route('admin.faitgenerateur.index')->with('success','Fait générateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaitGenerateur $faitgenerateur)
    {
        $faitgenerateur->delete();
        return redirect()->route('admin.faitgenerateur.index')->with('success','Fait générateur supprimé avec succès');
    }
}
