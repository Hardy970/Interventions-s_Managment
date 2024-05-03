<?php

namespace App\Http\Controllers\Admin;

use App\Models\Equipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.equipe.index',['equipes'=>Equipe::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.equipe.form',['equipe'=>new Equipe()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>['string','unique:equipes,nom']
        ]);
        Equipe::create($request->all());

        return redirect()->route('admin.equipe.index')->with('success','Equipe créée avec succès');
    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipe $equipe)
    {
        return view('admin.equipe.form',['equipe'=>$equipe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipe $equipe)
    {
        $request->validate([
            'nom'=>['string','unique:equipes,nom']
        ]);
        $equipe->update(($request->all()));

        return redirect()->route('admin.equipe.index')->with('success','Equipe Modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        $equipe->delete() ;
        return redirect()->route('admin.equipe.index')->with('success','Equipe Supprimée avec succès');
    }
}
