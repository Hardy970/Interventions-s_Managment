@php
  use App\Models\Intervention;

@endphp
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
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$intervention->exists?route('admin.interventions.store'):route('admin.interventions.update',['intervention'=>$intervention ])}}" >
            @csrf
            @method($intervention->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <div class=" form-group">
                    <label>Date de demande</label>
                    <div class="input-group">
                      <input name="date_demande"  autocomplete="off" value="{{ old('date_demande',$intervention->date_demande) }}"   class="datepicker-here form-control digits" type="text" data-language="en">
                    </div>
                    @error('date_demande')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">   
                    <div class=" form-group">
                      <label class="">Fait générateur</label>
                      <div class="input-group">
                        <select name="fait_generateur_id" id="" class="js-example-basic-single " data-placeholder="Choisir un fait générateur" >
                          <option value="">Choisir un fait générateur</option>
                          @foreach ($faitsgenerateurs as $faitgenerateur)
                              <option value="{{ $faitgenerateur->id }}" @selected($faitgenerateur->id == old('fait_generateur_id', $intervention->fait_generateur_id))>{{ $faitgenerateur->libelle }}</option>
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
                    <div class="">
                      <label>Type de demande :</label>
                      <div class="">
                        <select name="typesdemandes[]" multiple id="" class="js-example-placeholder-multiple " data-placeholder="Choisir le ou les types de demande" >
                          @foreach ($typesdemandes as $typedemande)
                              <option value="{{ $typedemande->id }}" @selected(in_array($typedemande->id, old('typesdemandes', $intervention->typesdemandes->pluck('id')->toArray()))) >{{ $typedemande->libelle }}</option>
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
                        <select name="demandeur_id" id="" class="js-example-basic-single " >
                          <option value="">Choisir un demandeur</option>
                          @foreach ($demandeurs as $demandeur)
                              <option value="{{ $demandeur->id }}" @selected($demandeur->id== old('demandeur_id', $intervention->demandeur_id))>{{ $demandeur->nom }}</option>
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
              {{-- <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col">
                    <label class=" form-label ">Feedback Client : </label>
                    <textarea name="feedback" id="" class="form-control"     rows="3">{{ old('feedback',$intervention->feedback) }}</textarea>
                    @error('feedback')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                  </div>
                </div>
              </div> --}}
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <div class=" form-group">
                      <label>Consultants :</label>
                      <div class="input-group">
                        <select name="consultants[]" multiple id=""  class="js-example-placeholder-multiple " data-placeholder="Choisir le ou les consultants" >
                          @foreach ($consultants as $consultant)
                              <option value="{{ $consultant->id }}" @selected(in_array($consultant->id, old('consultants', $intervention->consultants->pluck('id')->toArray())))>{{ $consultant->last_name }} {{ $consultant->first_name }}</option>
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
                        <select name="typesinterventions[]" id="" multiple class="js-example-placeholder-multiple " data-placeholder="Choisir le ou les types d'intervention">
                          @foreach ($typesinterventions as $typeintervention)
                              <option value="{{ $typeintervention->id }}" @selected(in_array($typeintervention->id, old('typesinterventions', $intervention->typesinterventions->pluck('id')->toArray())))>{{ $typeintervention->libelle }}</option>
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
                    <div class="">
                      <label>Produits concernés :</label>
                      <div class="input-group">
                        <select name="produits[]" multiple id="" class="js-example-placeholder-multiple " data-placeholder="Séléctionner les produits " >
                          @foreach ($produits as $produit)
                              <option value="{{ $produit->id }}" @selected(in_array($produit->id, old('produits', $intervention->produits->pluck('id')->toArray())))>{{ $produit->libelle }}</option>
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
                      <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                        <div class="radio radio-primary">
                          <input id="radioinline1" type="radio" name="est_vehicule_service" value="1" {{ @old('est_vehicule_service',$intervention->est_vehicule_service)=='1'? 'checked':'' }}>
                          <label class="mb-0" for="radioinline1">Véhicule de service</label>
                        </div>
                        <div class="radio radio-primary">
                          <input id="radioinline2" type="radio" name="est_vehicule_service" value="0" {{ @old('est_vehicule_service',$intervention->est_vehicule_service)=='0'? 'checked':'' }}>
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
              <div class="mb-3 col-md-12 mt-0" id="blockToToggle" style="display: none" >
                <div class="row">
                  <div class="col-sm-6">
                    <div class=" form-group">
                      <label>Véhicule :</label>
                      <div class="input-group">
                        <select name="vehicule_id" id="" class=" js-example-basic-single" >
                          <option value="">Choisir un véhicule</option>
                          @foreach ($vehicules as $vehicule)
                              <option value="{{ $vehicule->id }}" @selected($intervention->vehicule_id==$vehicule->id)>{{ $vehicule->matricule }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('vehicule_id')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class=" form-group">
                      <label>Chauffeur :</label>
                      <div class="input-group">
                        <select name="chauffeur_id" id="" class="js-example-basic-single" >
                          <option value="">Choisir un chauffeur</option>
                          @foreach ($chauffeurs as $chauffeur)
                              <option value="{{ $chauffeur->id }}" @selected($chauffeur->id == old('chauffeur_id', $intervention->chauffeur_id))>{{ $chauffeur->nom }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('chauffeur_id')
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
                  <div class="col-sm-3">
                    <div class=" form-group">
                      <label>Heure de départ du bureau :</label>
                      <div class="input-group clockpicker pull-center"  data-autoclose="true">
                        <input class="form-control" name="h_depart_b" autocomplete="off" type="text" value="{{ old('h_depart_b', Intervention::getHour($intervention->h_depart_b) ) }}" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                      </div>
                      @error('h_depart_b')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class=" form-group">
                      <label>Heure d'arrivée chez le client :</label>
                      <div class="input-group clockpicker pull-center"  data-autoclose="true">
                        <input class="form-control" name="h_arrivee_c" autocomplete="off" value="{{ old('h_arrivee_c',Intervention::getHour($intervention->h_arrivee_c)) }}" type="text"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                      </div>
                      @error('h_arrivee_c')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class=" form-group">
                      <label>Heure de départ chez le client :</label>
                      <div class="input-group clockpicker pull-center"  data-autoclose="true">
                        <input class="form-control" name="h_depart_c" autocomplete="off" value="{{ old('h_depart_c',Intervention::getHour($intervention->h_depart_c)) }}" type="text"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                      </div>
                      @error('h_depart_c')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class=" form-group">
                      <label>Heure de rentrée au bureau :</label>
                      <div class="input-group clockpicker pull-center" data-autoclose="true">
                        <input class="form-control" name="h_arrivee_b" autocomplete="off" value="{{ old('h_arrivee_b',Intervention::getHour($intervention->h_arrivee_b)) }}" type="text" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                      </div>
                      @error('h_arrivee_b')
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
                  <div class="col-sm-3">
                    <div class=" form-group">
                      <label>Date de début :</label>
                      <div class="input-group">
                        <input name="date_debut" value="{{ old('date_debut',$intervention->date_debut) }}" autocomplete="off" class="datepicker-here form-control digits" type="text" data-language="en">
                      </div>
                      @error('date_debut')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class=" form-group">
                      <label>Date de fin :</label>
                      <div class="input-group">
                        <input name="date_fin" autocomplete="off" value="{{ old('date_fin',$intervention->date_fin) }}" class="datepicker-here form-control digits" type="text" data-language="en">
                      </div>
                      @error('date_fin')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-sm-6">   
                    <div class=" form-group">
                      <div class="col-sm-12">
                        <label>Statut de facturation :</label>
                      </div>
                      <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                        <div class="radio radio-primary">
                          <input id="radioinline3" type="radio" name="statut_fact" value="0" {{ @old('statut_fact',$intervention->statut_fact)=='0'? 'checked':'' }}>
                          <label class="mb-0" for="radioinline3">Non Facturée</label>
                        </div>
                        <div class="radio radio-primary">
                          <input id="radioinline4" type="radio" name="statut_fact" value="1" {{ @old('statut_fact',$intervention->statut_fact)=='1'? 'checked':'' }}>
                          <label class="mb-0" for="radioinline4">Facturée</label>
                        </div>
                      </div>
                      @error('statut_fact')
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
                  <div class="col">
                    <label class=" form-label ">Travaux effectués et observations: </label>
                    <textarea name="travaux" id="" class="form-control"  rows="3">{{ old('travaux',$intervention->travaux) }}</textarea>
                    @error('travaux')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
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

