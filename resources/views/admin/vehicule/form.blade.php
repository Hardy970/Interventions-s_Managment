@extends('layout')

@section('title','vehicule')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $vehicule->exists?'Modifier un véhicule':'Ajouter un véhicule' }}</h5>
        </div>
        <div class="modal-body">
          <form class="needs-validation" id="bookmark-form" method="POST" action=" {{ !$vehicule->exists?route('admin.vehicule.store'):route('admin.vehicule.update',['vehicule'=>$vehicule ])}}" >
            @csrf
            @method($vehicule->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Matricule</label>
                    <input class="form-control" id="con-name" autofocus type="text"    value="{{ old('matricule',$vehicule->matricule) }}"  name="matricule" >
                    @error('matricule')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                  <div class="col-sm-6">   
                    <label>Marque</label>
                    <input class="form-control" id="con-last" type="text"    value="{{ old('marque',$vehicule->marque) }}"  name="marque">
                    @error('marque')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                  @enderror
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $vehicule->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.vehicule.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

