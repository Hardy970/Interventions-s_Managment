@extends('layout')

@section('title','societe')

@section('content')
          <!-- Container-fluid starts-->
          <div class="container-fluid list-products">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Liste des sociétés</h5>
                    <div class="form-group text-end mb-5">
                      <a class="btn btn-primary btn-block " type="button" href="{{ route('admin.societe.create') }}" >Ajouter une societe</a>
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
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Localité</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach( $societes as $societe )
                          <tr>
                            <td>
                              {{ $societe->nom }}
                            </td>
                            <td >
                              {{ $societe->email }}
                            </td>
                            <td>
                              {{ $societe->telephone }}
                            </td>
                            <td>
                              {{ $societe->localite }}
                            </td>
                            <td class=" d-flex gap-1">
                              {{-- <a class="btn btn-danger btn-xs" type="button" href="{{ route('admin.societe.destroy',['societe'=>$societe->id]) }}" data-original-title="btn btn-danger btn-xs" title="">Delete</a> --}}
                              <form action="{{ route('admin.societe.destroy',['societe'=>$societe->id]) }}" method="POST"> 
                                @csrf
                                @method('delete')
                                <button type="button" style="font-size: 0.71rem" class="btn btn-danger btn-xs text-xs" onclick='return confirm("Etes vous sûr de vouloir supprimer cette societe ?")' title="">Supprimer</button>
                            </form>
                              <a class="btn btn-primary btn-xs" href="{{ route('admin.societe.edit',['societe'=>$societe]) }}"  data-original-title="btn btn-danger btn-xs" title="">Modifier</a>
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
