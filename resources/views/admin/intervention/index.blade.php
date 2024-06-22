@extends('layout')

@section('title','intervention')

@section('content')
          <!-- Container-fluid starts-->
          <div class="container-fluid list-products">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Liste des interventions</h5>
                    <div class="form-group text-end my-5">
                      <a class="btn btn-primary " type="button" href="{{ route('admin.interventions.create') }}" >Ajouter une intervention</a>
                    </div>
                    
                    

                  </div>
                  <div class="card-body">
                    
                    <div class="table-responsive product-table">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>Date de demande</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Types de demande</th>
                            <th>Société</th>
                            <th>Fait générateur</th>
                            <th>Consultants</th>
                            <th>Produits concernés</th>
                            <th>Type d'intervention</th>
                            <th>Statut facturation</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $interventions as $intervention )
                          <tr>
                            <td>
                              {{ $intervention->getDateDemande() }}
                            </td>
                            <td>
                              {{ $intervention->getDateDebut() }}
                            </td>
                            <td>
                              {{ $intervention->getDateFin() }}
                            </td>
                            <td >
                              @foreach ($intervention->typesdemandes as $typedemande )
                              <span id="span" class="badge badge-info text-center ">{{ $typedemande->libelle }}</span>
                              @endforeach
                            </td>
                            <td>
                              {{ $intervention->demandeur->societe->nom }}
                            </td>
                            <td>
                              {{ $intervention->fait_generateur->libelle }}
                            </td>
                            {{-- <td>
                              {{ $intervention->feedback }}
                            </td> --}}
                            <td>
                              @foreach ($intervention->consultants as $consultant )
                              {{ $consultant->last_name }} {{ $consultant->first_name }} 
                              @endforeach
                            </td>
                            <td>
                              @foreach ($intervention->produits as $produit )
                              <span id="span" class="badge badge-secondary">{{ $produit->libelle }}</span>
                              @endforeach
                            </td>
                            <td>
                              @foreach ($intervention->typesinterventions as $typesintervention )
                              <span id="span" class="badge badge-info mt-1 mx-2">{{ $typesintervention->libelle }} </span>
                              @endforeach
                            </td>
                            {{-- <td>
                              @if( !empty($intervention->vehicule) )
                              {{ $intervention->vehicule->matricule }}
                              @endif
                              
                            </td>
                            <td>
                              @if( !empty($intervention->chauffeur) )
                              {{ $intervention->chauffeur->nom  }}
                              @endif
                            </td>
                            <td>
                              {{ $intervention->travaux }}
                            </td> --}}
                            <td>
                              @if ($intervention->statut_fact)
                                <span id="span" class="badge badge-success">Facturée</span>
                              @else
                              <span id="span" class="badge badge-danger">Non Facturée</span>
                              @endif
                            </td>
                            <td class=" d-flex gap-1">
                              {{-- <a class="btn btn-danger btn-xs" type="button" href="{{ route('admin.intervention.destroy',['intervention'=>$intervention->id]) }}" data-original-title="btn btn-danger btn-xs" title="">Delete</a> --}}
                              <a class="btn btn-warning btn-xs" href="{{ route('admin.interventions.show',['intervention'=>$intervention]) }}"  data-original-title="btn btn-secondary btn-xs" title="">Afficher</a>
                              <a class="btn btn-primary btn-xs" href="{{ route('admin.interventions.edit',['intervention'=>$intervention]) }}"  data-original-title="btn btn-danger btn-xs" title="">Modifier</a>
                              <form action="{{ route('admin.interventions.destroy',['intervention'=>$intervention->id]) }}" method="POST"> 
                                @csrf
                                @method('delete')
                                <button type="submit" style="font-size: 0.71rem" class="btn btn-danger btn-xs text-xs" onclick='return confirm("Etes vous sûr de vouloir supprimer ce intervention ?")' title="">Supprimer</button>
                              </form>

                            </td>
                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Individual column searching (text inputs) Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
      </div>
    </div>
    @endsection
