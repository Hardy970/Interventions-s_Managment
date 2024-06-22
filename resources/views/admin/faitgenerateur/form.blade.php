@extends('layout')

@section('title','faitgenerateur')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $faitgenerateur->exists?'Modifier un fait generateur':'Ajouter un fait generateur' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$faitgenerateur->exists?route('admin.faitgenerateur.store'):route('admin.faitgenerateur.update',['faitgenerateur'=>$faitgenerateur ])}}" >
            @csrf
            @method($faitgenerateur->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-7">
                    <label>Libellé du faitgenerateur</label>
                    <input class="form-control" id="con-name" type="text" autofocus   value="{{ old('libelle',$faitgenerateur->libelle) }}"  name="libelle" >
                    @error('libelle')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
              </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $faitgenerateur->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.faitgenerateur.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection