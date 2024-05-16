<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocieteRequest;
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
    public function store(SocieteRequest $request)
    {
        Societe::create($request->validated());
        return redirect()->route('admin.societe.index')->with('success','Société ajoutée avec succès');
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
    public function update(SocieteRequest $request, Societe $societe)
    {
        $societe->update($request->validated());
        return redirect()->route('admin.societe.index')->with('success','Société mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Societe $societe)
    {
        $societe->delete();
        return redirect()->route('admin.societe.index')->with('success','Société supprimée avec succès');
    }
}
