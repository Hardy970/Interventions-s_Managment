<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieRequest;

class CategorieController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categorie.index',['categories'=>Categorie::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorie.form',['categorie'=>new Categorie()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategorieRequest $request)
    {
        Categorie::create($request->validated());
        return redirect()->route('admin.categorie.index')->with('success','Catégorie ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        return view('admin.categorie.form',['categorie'=>$categorie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategorieRequest $request, Categorie $categorie)
    {
        $categorie->update($request->validated());
        return redirect()->route('admin.categorie.index')->with('success','Catégorie mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('admin.categorie.index')->with('success','Catégorie supprimée avec succès');
    }
}
