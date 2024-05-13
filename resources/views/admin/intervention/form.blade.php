@extends('layout')

@section('title','intervention')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $intervention->exists?'Modifier une intervention':'Ajouter une intervention' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$intervention->exists?route('admin.intervention.store'):route('admin.intervention.update',['intervention'=>$intervention ])}}" >
            @csrf
            @method($intervention->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Date de demande</label>
                    <input class="form-control" id="con-name" type="date"  value="{{ old('date_demande',$intervention->date_demande) }}"  name="date_demande" >
                    @error('date_demande')
                        {{ $message }}
                    @enderror
                  </div>
                  <div class="col-sm-6">   
                    <div class=" form-group">
                      <label>Fait générateur</label>
                      <div class="input-group">
                        <select name="fait_generateur_id" id="" class="form-control form-select " >
                          <option value="">Choisir un fait générateur</option>
                          @foreach ($faitsgenerateurs as $faitgenerateur)
                              <option value="{{ $faitgenerateur->id }}" @selected($faitgenerateur->id==$intervention->fait_generateur_id)>{{ $faitgenerateur->libelle }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('fait_generateur_id')
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
                    <div class=" form-group">
                      <label>Type de demande :</label>
                      <div class="input-group">
                        <select name="typesdemandes[]" multiple id="" class="form-control form-select " >
                          <option value="">Choisir le ou les types de demande</option>
                          @foreach ($typesdemandes as $typedemande)
                              <option value="{{ $typedemande->id }}" @selected($intervention->typesdemandes()->contains($typedemande))>{{ $typedemande->libelle }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('typesdemandes')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">   
                    <div class=" form-group">
                      <label>Demandeur:</label>
                      <div class="input-group">
                        <select name="demandeur_id" id="" class="form-control form-select " >
                          <option value="">Choisir un demandeur</option>
                          @foreach ($demandeurs as $demandeur)
                              <option value="{{ $demandeur->id }}" @selected($demandeur->id==$intervention->demandeur_id)>{{ $demandeur->nom }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('demandeur_id')
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
                    <div class=" form-group">
                      <label>Consultants :</label>
                      <div class="input-group">
                        <select name="consultants[]" multiple id="" class="form-control form-select " >
                          <option value="">Choisir le ou les consultants</option>
                          @foreach ($consultants as $consultant)
                              <option value="{{ $consultant->id }}" @selected($intervention->consultants()->contains($consultant))>{{ $consultant->last_name }} {{ $consultant->first_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('consultants')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">   
                    <div class=" form-group">
                      <label>Type d'intervention:</label>
                      <div class="input-group">
                        <select name="typesinterventions[]" id="" class="form-control form-select " >
                          <option value="">Choisir le ou les types d'intervention</option>
                          @foreach ($typesinterventions as $typeintervention)
                              <option value="{{ $typeintervention->id }}" @selected($intervention->typesinterventions->contains($typeintervention))>{{ $typeintervention->libelle }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('typesinterventions')
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
                    <div class=" form-group">
                      <label>Produits concernés :</label>
                      <div class="input-group">
                        <select name="produits[]" multiple id="" class="form-control form-select " >
                          <option value="">Choisir le ou les produits</option>
                          @foreach ($produits as $produit)
                              <option value="{{ $produit->id }}" @selected($intervention->produits()->contains($produit))>{{ $produit->libelle }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('produits')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">   
                    <div class=" form-group">
                      <div class="col-sm-12">
                        <label>Transport :</label>
                      </div>
                      <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                        <div class="radio radio-primary">
                          <input id="radioinline1" type="radio" name="est_vehicule_service" value="1">
                          <label class="mb-0" for="radioinline1">Véhicule de service</label>
                        </div>
                        <div class="radio radio-primary">
                          <input id="radioinline2" type="radio" name="est_vehicule_service" value="0">
                          <label class="mb-0" for="radioinline2">Véhicule personnel</label>
                        </div>
                      </div>
                      @error('est_vehicule_service')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <h5>Inline checkbox</h5>
              </div>
              <div class="col">
                <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                  <div class="radio radio-primary">
                    <input id="radioinline1" type="radio" name="radio1" value="option1">
                    <label class="mb-0" for="radioinline1">Option<span class="digits"> 1</span></label>
                  </div>
                  <div class="radio radio-primary">
                    <input id="radioinline2" type="radio" name="radio1" value="option1">
                    <label class="mb-0" for="radioinline2">Option<span class="digits"> 2</span></label>
                  </div>
                  <div class="radio radio-primary">
                    <input id="radioinline3" type="radio" name="radio1" value="option1">
                    <label class="mb-0" for="radioinline3">Option<span class="digits"> 3</span></label>
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $intervention->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.interventions.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

