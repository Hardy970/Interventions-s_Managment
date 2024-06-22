@extends('layout')

@section('title','typedemande')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $typedemande->exists?'Modifier un type de demande':'Ajouter un type de demande' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$typedemande->exists?route('admin.typedemande.store'):route('admin.typedemande.update',['typedemande'=>$typedemande ])}}" >
            @csrf
            @method($typedemande->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-8">
                    <label>Libellé du type de demande</label>
                    <input class="form-control" id="con-name" type="text" autofocus  value="{{ old('libelle',$typedemande->libelle) }}"  name="libelle" >
                    @error('libelle')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                 
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $typedemande->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.typedemande.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection

