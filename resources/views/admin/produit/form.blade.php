@extends('layout')

@section('title','produit')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $produit->exists?'Modifier un produit':'Ajouter un produit' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$produit->exists?route('admin.produit.store'):route('admin.produit.update',['produit'=>$produit ])}}" >
            @csrf
            @method($produit->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-7">
                    <label>Libellé du produit</label>
                    <input class="form-control" id="con-name" type="text"    value="{{ old('libelle',$produit->libelle) }}"  name="libelle" >
                    @error('libelle')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="mb-3 col-md-12 my-0">
                <div class="row">
                  <div class="col-sm-8">
                    <div class=" form-group">
                      <label>Catégorie du produit</label>
                      <div class="input-group">
                        <select name="categorie_id" id="" class="form-controsl form-select " >
                          <option value="">Choisir une catégorie</option>
                          @foreach ($categories as $categorie)
                              <option value="{{ $categorie->id }}" @selected($categorie->id==$produit->categorie_id)>{{ $categorie->libelle }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('categorie_id')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $produit->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.produit.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

