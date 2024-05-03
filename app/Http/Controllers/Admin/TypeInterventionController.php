<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TypeIntervention;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeInterventionRequest;

class TypeInterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.typeintervention.index',['typeinterventions'=>TypeIntervention::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.typeintervention.form',['typeintervention'=>new TypeIntervention()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeInterventionRequest $request)
    {
        TypeIntervention::create($request->validated());
        return redirect()->route('admin.typeintervention.index')->with('success','type d\'intervention ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeIntervention $typeintervention)
    {
        return view('admin.typeintervention.form',['typeintervention'=>$typeintervention]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeInterventionRequest $request, TypeIntervention $typeintervention)
    {
        $typeintervention->update($request->validated());
        return redirect()->route('admin.typeintervention.index')->with('success','type d\'intervention mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeIntervention $typeintervention)
    {
        $typeintervention->delete();
        return redirect()->route('admin.typeintervention.index')->with('success','type d\'intervention supprimé avec succès');
    }
}
