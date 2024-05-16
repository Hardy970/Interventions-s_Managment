@extends('layout')

@section('title','Equipe')

@section('content')
          <!-- Container-fluid starts-->
          <div class="container-fluid list-products">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Liste des equipes</h5>
                    <div class="form-group text-end mb-5">
                      <a href="{{ route('admin.equipe.create') }}" class="btn btn-primary ">Ajouter une équipe</a>
                    </div>
                    
                  </div>
                  <div class="card-body">
                    
                    <div class="table-responsive product-table">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nom de l'équipe</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $equipes as $equipe )
                          <tr>
                            <td>
                              {{ $equipe->id }}
                            </td>
                            <td >
                              {{ $equipe->nom }}
                            </td>
                            <td class=" d-flex gap-1">
                              <form action="{{ route('admin.equipe.destroy',['equipe'=>$equipe->id]) }}" method="POST"> 
                                @csrf
                                @method('delete')
                                <button type="submit" style="font-size: 0.71rem" class="btn btn-danger btn-xs text-xs" onclick='return confirm("Etes vous sûr de vouloir supprimer cette équipe ?")' title="">Supprimer</button>
                              </form>
                              <a class="btn btn-primary btn-xs" href="{{ route('admin.equipe.edit',['equipe'=>$equipe->id]) }}" type="button" data-original-title="btn btn-danger btn-xs" title="">Edit</a>
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
