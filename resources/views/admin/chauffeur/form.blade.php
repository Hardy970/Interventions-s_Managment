@extends('layout')

@section('title','chauffeur')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $chauffeur->exists?'Modifier un chauffeur':'Ajouter un chauffeur' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$chauffeur->exists?route('admin.chauffeur.store'):route('admin.chauffeur.update',['chauffeur'=>$chauffeur ])}}" >
            @csrf
            @method($chauffeur->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class=" col-md-7">
                    <label>Nom du chauffeur</label>
                    <input class="form-control" id="con-name" autofocus type="text"    value="{{ old('nom',$chauffeur->nom) }}"  name="nom" >
                    @error('nom')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $chauffeur->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.chauffeur.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

