@extends('authLayout')

@section('title','typedemande')

@section('content')

<div class="w-75" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $typedemande->exists?'Modifier un type de demande':'Ajouter un type de demande' }}</h5>
          <button class="btn-close" onclick="history.back()"  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-bookmark needs-validation" id="bookmark-form" method="POST" action=" {{ !$typedemande->exists?route('admin.typedemande.store'):route('admin.typedemande.update',['typedemande'=>$typedemande ])}}" >
            @csrf
            @method($typedemande->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-8">
                    <label>Libellé du type de demande</label>
                    <input class="form-control" id="con-name" type="text" required  value="{{ old('libelle',$typedemande->libelle) }}"  name="libelle" >
                    @error('libelle')
                        {{ $message }}
                    @enderror
                  </div>
                 
                </div>
              </div>
            </div>
            <button class="btn btn-secondary" type="submit">{{ $typedemande->exists?'Modifier':'Ajouter' }}</button>
            <button class="btn btn-primary" type="button"  onclick="history.back()" >Quitter</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection

