<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Societe;
use Illuminate\Http\Request;

class SocieteController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.societe.index',['societes'=>Societe::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.societe.form',['societe'=>new Societe()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'integer'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Societe::class],
            'localite' => ['nullable', 'string', 'max:255'],

        ]);

        Societe::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'localite'=>$request->localite,
        ]);
        return redirect()->route('admin.societe.index')->with('success','Societe ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Societe $societe)
    {
        return view('admin.societe.form',['societe'=>$societe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Societe $societe)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'integer'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Societe::class],
            'localite' => ['nullable', 'string', 'max:255'],
        ]);
        $societe->update($request->all());
        return redirect()->route('admin.societe.index')->with('success','societe mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Societe $societe)
    {
        $societe->delete();
        return redirect()->route('admin.societe.index')->with('success','societe supprimé avec succès');
    }
}
