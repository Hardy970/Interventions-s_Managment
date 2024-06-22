@extends('layout')

@section('title', 'Intervention N° {{ $intervention->id }}')

@section('content')
    <div class=" d-flex justify-content-between mx-5">
        <div>
        @if ($intervention->statut_fact)
                                <span id="span" class="badge badge-success">Facturée</span>
        @else
                              <span id="span" class="badge badge-danger">Non Facturée</span>
        @endif
        </div>
        <h3>
            Intervention N° {{ $intervention->id }}
        </h3>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header pb-0">
                  <h5>Informations de l'intervention</h5>
                </div>
                <div class="card-body ">  
                  <div class="row ">
                      <div class="col-xl-12 xl-50 box-col-6"> 
                        <div class="card-body ">
                          <ul class="list-group">
                              <li class="list-group-item"> <strong>Date de demande :</strong> {{ $intervention->getDateDemande() }}</li>
                              <li class="list-group-item"><strong>Date de début :</strong> {{ $intervention->getDateDebut() }}</li>
                              <li class="list-group-item"><strong>Date de fin :</strong> {{ $intervention->getDateFin() }}</li>
                              <li class="list-group-item"><strong>Heure de départ du bureau :</strong> {{ $intervention->h_depart_b }}</li>
                              <li class="list-group-item"><strong>Heure d'arrivée chez le client :</strong> {{ $intervention->h_arrivee_c }}</li>
                              <li class="list-group-item"><strong>Heure de départ chez le client :</strong> {{ $intervention->h_depart_c }}</li>
                              <li class="list-group-item"><strong>Heure d'arrivée au bureau :</strong> {{ $intervention->h_arrivee_b }}</li>
                              <li class="list-group-item"><strong>Fait générateur :</strong> {{ $intervention->fait_generateur->libelle }}</li>
                              @if ($intervention->est_vehicule_service)
                              <li class="list-group-item"> <strong>Véhicule utilisé :</strong> {{ $intervention->vehicule->matricule }}</li>
                              <li class="list-group-item"> <strong>Chauffeur :</strong> {{ $intervention->chauffeur->nom }}</li>
                                @else
                                <li class="list-group-item"> <strong>Véhicule utilisé :</strong> Véhicule personnel</li>
                              @endif
                              <li class="list-group-item"><strong>Travaux :</strong> {{ $intervention->travaux }}</li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-xl-12 xl-50 box-col-6">
                      <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc3">
                            <div class="card">
                              <div class="card-header">
                                <h5 class="p-0">
                                  <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon15" aria-expanded="true" aria-controls="collapseicon15">Consultants</button>
                                </h5>
                              </div>
                              <div class="collapse show" id="collapseicon15" data-parent="#accordion" aria-labelledby="collapseicon15">
                                <div class="card-body avatar-showcase filter-cards-view">
                                    @foreach ($intervention->consultants as $consultant)
                                    <div class="d-inline-block friend-pic"><h5 class="h2-25 pt-3 rounded-circle bg-grey " data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $consultant->first_name }} {{ $consultant->last_name }}">{{ substr($consultant->first_name, 0, 1) }} {{substr( $consultant->last_name,0,1 )}} </h5> </div>
                                    @endforeach
                                </div>
                              </div>
                            </div>
                      </div>
                      <div class=" mt-5">
                        <h6>Types de demande </h6>
                        <ul>
                          @foreach ($intervention->typesdemandes as $typedemande )
                              <span id="span" class="badge badge-info text-center ">{{ $typedemande->libelle }}</span>
                          @endforeach
                        </ul>
                      </div>
                      <div class=" mt-5">
                        <h6>Types d'interventions </h6>
                        <ul>
                          @foreach ($intervention->typesinterventions as $typeintervention)
                              <span id="span" class="badge badge-info text-center ">{{ $typeintervention->libelle }}</span>
                          @endforeach
                        </ul>
                      </div>
                      <div class=" mt-5">
                        <h6>Produits concernés </h6>
                        <ul>
                          @foreach ($intervention->produits as $produit)
                              <span id="span" class="badge badge-secondary text-center ">{{ $produit->libelle }}</span>
                          @endforeach
                        </ul>
                      </div>
                      
                      </div>
                  </div>
                  
                  
                </div>
                
            </div>
            
        </div>

        <div class="col-md-12 col-12">
          <div class="card">
              <div class="card-header pb-0">
                <h5>Informations du client</h5>
              </div>
              <div class="card-body ">
                <ul class="list-group">
                  <li class="list-group-item">Société : {{ $intervention->demandeur->societe->nom }}</li>
                  <li class="list-group-item">Demandeur : {{ $intervention->demandeur->nom }}</li>
                  <li class="list-group-item">Feedback client : {{ $intervention->feedback }}</li>
                </ul>
              </div>
          </div>
        </div>

                    


@endsection