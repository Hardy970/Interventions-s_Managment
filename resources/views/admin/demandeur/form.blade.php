@extends('layout')

@section('title','demandeur')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $demandeur->exists?'Modifier un demandeur':'Ajouter un demandeur' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$demandeur->exists?route('admin.demandeur.store'):route('admin.demandeur.update',['demandeur'=>$demandeur ])}}" >
            @csrf
            @method($demandeur->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Nom complet du demandeur</label>
                    <input class="form-control" id="con-name" type="text"   value="{{ old('nom',$demandeur->nom) }}"  name="nom" >
                    @error('nom')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                  <div class="col-sm-6">   
                    <label>Poste</label>
                    <input class="form-control" id="con-last" type="text"    value="{{ old('poste',$demandeur->poste) }}"  name="poste">
                    @error('poste')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                  @enderror
                  </div>
                </div>
              </div>
              <div class="mb-3 col-md-12 my-0">
                <div class="row">
                  <div class="col-sm-6">
                        <div class="form-group">
                            <label>Département</label>
                            <div class="input-group">
                                <input class="form-control" type="text"   name="departement" value="{{ old('departement',$demandeur->departement) }}">
                            </div>
                         @error('departement')
                         <div>
                          <span class="text-danger fw-bold "> {{ $message }} </span>
                        </div>
                         @enderror
                        </div>
                  </div>
                  <div class="col-sm-6">
                    <div class=" form-group">
                      <label>Société</label>
                      <div class="input-group">
                        <select name="societe_id" id="" class="js-example-basic-single " >
                          <option value="">Choisir une société</option>
                          @foreach ($societes as $societe)
                              <option value="{{ $societe->id }}" @selected($societe->id==$demandeur->societe_id)>{{ $societe->nom }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('societe_id')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                      <label for="con-mail">Email </label>
                      <input class="form-control" id="con-mail" type="email"  value="{{ old('email',$demandeur->email) }}"  name="email" >
                      @error('email')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                  </div>
                  <div class="col-sm-6">
                    <label for="con-mail">Téléphone </label>
                    <input class="form-control" id="con-mail" type="number"  value="{{ old('telephone',$demandeur->telephone) }}"  name="telephone" >
                    @error('telephone')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
              
            </div>
            <button class="btn btn-success" type="submit">{{ $demandeur->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.demandeur.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection

