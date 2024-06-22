@extends('layout')

@section('title','categorie')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $categorie->exists?'Modifier une categorie':'Ajouter une categorie' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$categorie->exists?route('admin.categorie.store'):route('admin.categorie.update',['categorie'=>$categorie ])}}" >
            @csrf
            @method($categorie->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-8">
                    <label>Libellé de la categorie</label>
                    <input class="form-control" autofocus id="con-name" type="text"   value="{{ old('libelle',$categorie->libelle) }}"  name="libelle" >
                    @error('libelle')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $categorie->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger "  href="{{ route('admin.categorie.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
