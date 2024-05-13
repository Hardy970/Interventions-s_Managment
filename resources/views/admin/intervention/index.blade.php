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
                    <div class="form-group text-end mb-5">
                      <a class="btn btn-primary btn-block " type="button" href="{{ route('admin.interventions.create') }}" >Ajouter une intervention</a>
                    </div>
                    
                    

                  </div>
                  @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  <div class="card-body">
                    
                    <div class="table-responsive product-table">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>Date de demande</th>
                            <th>Types de demande</th>
                            <th>Société</th>
                            <th>Fait générateur</th>
                            <th>Feedback du client</th>
                            <th>Consultants</th>
                            <th>Produits concernés</th>
                            <th>Type d'intervention</th>
                            <th>Véhicule utilisé</th>
                            <th>Nom du chauffeur</th>
                            <th>Travaux réalisés</th>
                            <th>Statut facturation</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $interventions as $intervention )
                          <tr>
                            <td>
                              {{ $intervention->date_demande }}
                            </td>
                            <td >
                              @foreach ($intervention->typesdemandes as $typedemande )
                                {{ $typedemande->libelle }}
                              @endforeach
                            </td>
                            <td>
                              {{ $intervention->demandeur->societe->nom }}
                            </td>
                            <td>
                              {{ $intervention->faitgenerateur->libelle }}
                            </td>
                            <td>
                              {{ $intervention->feedback }}
                            </td>
                            <td>
                              @foreach ($intervention->consultants as $consultant )
                              {{ $consultant->last_name }} {{ $consultant->first_name }} 
                              @endforeach
                            </td>
                            <td>
                              @foreach ($intervention->produits as $produit )
                              {{ $produit->libelle }}
                              @endforeach
                            </td>
                            <td>
                              @foreach ($intervention->typesinterventions as $typesintervention )
                              {{ $typesintervention->libelle }} 
                              @endforeach
                            </td>
                            <td>
                              {{ $intervention->vehicule->matricule }}
                            </td>
                            <td>
                              {{ $intervention->chauffeur->nom }}
                            </td>
                            <td>
                              {{ $intervention->travaux }}
                            </td>
                            <td>
                              {{ $intervention->statut_fact?'Payé':'Non payé' }}
                            </td>
                            <td class=" d-flex gap-1">
                              {{-- <a class="btn btn-danger btn-xs" type="button" href="{{ route('admin.intervention.destroy',['intervention'=>$intervention->id]) }}" data-original-title="btn btn-danger btn-xs" title="">Delete</a> --}}
                              <form action="{{ route('admin.interventions.destroy',['intervention'=>$intervention->id]) }}" method="POST"> 
                                @csrf
                                @method('delete')
                                <button type="submit" style="font-size: 0.71rem" class="btn btn-danger btn-xs text-xs" onclick='return confirm("Etes vous sûr de vouloir supprimer ce intervention ?")' title="">Supprimer</button>
                            </form>
                              <a class="btn btn-primary btn-xs" href="{{ route('admin.interventions.edit',['intervention'=>$intervention]) }}"  data-original-title="btn btn-danger btn-xs" title="">Modifier</a>
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
