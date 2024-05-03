@extends('authLayout')

@section('title','produit')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $produit->exists?'Modifier un produit':'Ajouter un produit' }}</h5>
          <button class="btn-close" onclick="history.back()"  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-bookmark needs-validation" id="bookmark-form" method="POST" action=" {{ !$produit->exists?route('admin.produit.store'):route('admin.produit.update',['produit'=>$produit ])}}" >
            @csrf
            @method($produit->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-7">
                    <label>Libellé du produit</label>
                    <input class="form-control" id="con-name" type="text" required   value="{{ old('libelle',$produit->libelle) }}"  name="libelle" >
                    @error('libelle')
                        {{ $message }}
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
                        {{ $message }}
                      @enderror
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-secondary" type="submit">{{ $produit->exists?'Modifier':'Ajouter' }}</button>
            <button class="btn btn-primary" type="button"  onclick="history.back()" >Quitter</button>
          </form>
        </div>
      </div>
    </div>
  </div>

{{-- <form class="theme-form login-form" method="POST" action=" {{ !$produit->exists?route('admin.produit.store'):route('admin.produit.update',['produit'=>$produit ])}}" >
  @csrf
  @method($produit->exists?'PUT':'POST')
  <h4>{{ $produit->exists?'Modifier un produit':'Ajouter un produit' }}</h4>
  <div class="form-group mt-3">
      <label>Nom du produit</label>
      <div class="input-group">
        <input class="form-control" type="text" required value="{{ old('last_name',$produit->nom) }}"  name="last_name" >
      </div>
      @error('last_name')
        {{ $message }}
      @enderror
    </div>
    <div class="form-group mt-3">
        <label>Prénoms du produit</label>
        <div class="input-group">
          <input class="form-control" type="text" required value="{{ old('libelle',$produit->nom) }}"  name="libelle" >
        </div>
        @error('libelle')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Equipe du produit</label>
        <div class="input-group">
          <select name="equipe_id" id="" class="form-control" >
            @foreach ($equipes as $equipe)
                <option value="{{ $equipe->id }}" @selected($equipe->id==$produit->equipe_id)>{{ $equipe->nom }}</option>
            @endforeach
          </select>
        </div>
        @error('equipe_id')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Email du produit</label>
        <div class="input-group">
          <input class="form-control" type="email" required value="{{ old('email',$produit->email) }}"  name="email" >
        </div>
        @error('email')
          {{ $message }}
        @enderror
    </div>
   @if (!$produit->exists)
   <div class="form-group mt-3">
    <label>Mot de passe </label>
    <div class="input-group">
      <input class="form-control" type="password" required  name="password" >
    </div>
    @error('password')
      {{ $message }}
    @enderror
</div>
   @endif
      
  <div class="form-group">
    <button class="btn btn-primary btn-block" type="submit">{{ $produit->exists?'Modifier':'Ajouter' }}</button>
  </div>
  
</form> --}}
@endsection

