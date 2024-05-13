@extends('layout')

@section('title','chauffeur')

@section('content')
          <!-- Container-fluid starts-->
          <div class="container-fluid list-products">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Liste des chauffeurs</h5>
                    <div class="form-group text-end mb-5">
                      <a class="btn btn-primary btn-block " type="button" href="{{ route('admin.chauffeur.create') }}" >Ajouter un chauffeur</a>
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
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $chauffeurs as $chauffeur )
                          <tr>
                            <td>
                              {{ $chauffeur->nom }}
                            </td>
                            <td class=" d-flex gap-1">
                              {{-- <a class="btn btn-danger btn-xs" type="button" href="{{ route('admin.chauffeur.destroy',['chauffeur'=>$chauffeur->id]) }}" data-original-title="btn btn-danger btn-xs" title="">Delete</a> --}}
                              <form action="{{ route('admin.chauffeur.destroy',['chauffeur'=>$chauffeur->id]) }}" method="POST"> 
                                @csrf
                                @method('delete')
                                <button type="submit" style="font-size: 0.71rem" class="btn btn-danger btn-xs text-xs" onclick='return confirm("Etes vous sûr de vouloir supprimer ce chauffeur ?")' title="">Supprimer</button>
                            </form>
                              <a class="btn btn-primary btn-xs" href="{{ route('admin.chauffeur.edit',['chauffeur'=>$chauffeur]) }}"  data-original-title="btn btn-danger btn-xs" title="">Modifier</a>
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
