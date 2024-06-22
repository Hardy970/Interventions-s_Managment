@extends('layout')

@section('title','Equipe')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $equipe->exists?'Modifier une équipe':'Ajouter une équipe' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$equipe->exists?route('admin.equipe.store'):route('admin.equipe.update',['equipe'=>$equipe ])}}" >
            @csrf
            @method($equipe->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-7">
                    <label>Libellé de l'équipe</label>
                    <input class="form-control" id="con-name" type="text" autofocus   value="{{ old('nom',$equipe->nom) }}"  name="nom" >
                    @error('nom')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>       
                    @enderror
                  </div>
              </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $equipe->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.equipe.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection