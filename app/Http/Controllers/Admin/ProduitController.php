<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProduitRequest;

class ProduitController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.produit.index',['produits'=>Produit::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produit.form',['produit'=>new Produit(),'categories'=>Categorie::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProduitRequest $request)
    {
        Produit::create($request->validated());
        return redirect()->route('admin.produit.index')->with('success','produit ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return view('admin.produit.form',['produit'=>$produit,'categories'=>Categorie::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProduitRequest $request, Produit $produit)
    {
        $produit->update($request->validated());
        return redirect()->route('admin.produit.index')->with('success','produit mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('admin.produit.index')->with('success','produit supprimé avec succès');
    }
}
