@extends('layout')

@section('title','societe')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $societe->exists?'Modifier une societe':'Ajouter une societe' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$societe->exists?route('admin.societe.store'):route('admin.societe.update',['societe'=>$societe ])}}" >
            @csrf
            @method($societe->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Nom de la société</label>
                    <input class="form-control" id="con-name" type="text"    value="{{ old('nom',$societe->nom) }}"  name="nom" >
                    @error('nom')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                  <div class="col-sm-6">   
                    <label>Adresse</label>
                    <input class="form-control" id="con-last" type="text"   value="{{ old('localite',$societe->localite) }}"  name="localite">
                    @error('localite')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                  @enderror
                  </div>
                </div>
              </div>
              <div class="mb-3 col-md-12 mt-0">
                <label for="con-mail">Email de la société</label>
                <input class="form-control" type="email" value="{{ old('email',$societe->email) }}"  name="email" >
                @error('email')
                <div>
                  <span class="text-danger fw-bold "> {{ $message }} </span>
                </div>
              @enderror
              </div>
              <div class="mb-3 col-md-12 my-0">
                <div class="row">
                  
                  <div class="col-sm-6">
                    <div class=" form-group">
                      <label>Téléphone</label>
                      <div class="input-group">
                        <input class="form-control" id="con-mail" type="number" value="{{ old('telephone',$societe->telephone) }}"  name="telephone" >
                      </div>
                      @error('telephone')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $societe->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.societe.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

