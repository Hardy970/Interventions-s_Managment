@extends('authLayout')

@section('title','demandeur')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $demandeur->exists?'Modifier un demandeur':'Ajouter un demandeur' }}</h5>
          <button class="btn-close" onclick="history.back()"  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-bookmark needs-validation" id="bookmark-form" method="POST" action=" {{ !$demandeur->exists?route('admin.demandeur.store'):route('admin.demandeur.update',['demandeur'=>$demandeur ])}}" >
            @csrf
            @method($demandeur->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Nom du demandeur</label>
                    <input class="form-control" id="con-name" type="text" required placeholder="Prénoms"  value="{{ old('nom',$demandeur->nom) }}"  name="nom" >
                    @error('nom')
                        {{ $message }}
                    @enderror
                  </div>
                  <div class="col-sm-6">   
                    <label>Poste</label>
                    <input class="form-control" id="con-last" type="text" required=""   value="{{ old('poste',$demandeur->poste) }}"  name="poste">
                    @error('poste')
                    {{ $message }}
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
                                <input class="form-control" type="text" required  name="departement" value="{{ old('departement',$demandeur->departement) }}">
                            </div>
                         @error('departement')
                          {{ $message }}
                         @enderror
                        </div>
                  </div>
                  <div class="col-sm-6">
                    <div class=" form-group">
                      <label>Société</label>
                      <div class="input-group">
                        <select name="societe_id" id="" class="form-controsl form-select " >
                          <option value="">Choisir une société</option>
                          @foreach ($societes as $societe)
                              <option value="{{ $societe->id }}" @selected($societe->id==$demandeur->societe_id)>{{ $societe->nom }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('societe_id')
                        {{ $message }}
                      @enderror
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                      <label for="con-mail">Email </label>
                      <input class="form-control" id="con-mail" type="email" required="" value="{{ old('email',$demandeur->email) }}"  name="email" >
                      @error('email')
                        {{ $message }}
                      @enderror
                  </div>
                  <div class="col-sm-6">
                    <label for="con-mail">Téléphone </label>
                    <input class="form-control" id="con-mail" type="number" required="" value="{{ old('telephone',$demandeur->telephone) }}"  name="telephone" >
                    @error('telephone')
                      {{ $message }}
                    @enderror
                  </div>
                </div>
              </div>
              
            </div>
            <button class="btn btn-secondary" type="submit">{{ $demandeur->exists?'Modifier':'Ajouter' }}</button>
            <button class="btn btn-primary" type="button"  onclick="history.back()" >Quitter</button>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection

