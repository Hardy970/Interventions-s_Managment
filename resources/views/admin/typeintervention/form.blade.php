@extends('layout')

@section('title','typeintervention')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $typeintervention->exists?'Modifier un type d\'intervention':'Ajouter un type d\'intervention' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$typeintervention->exists?route('admin.typeintervention.store'):route('admin.typeintervention.update',['typeintervention'=>$typeintervention ])}}" >
            @csrf
            @method($typeintervention->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-8">
                    <label>Libellé du type d'intervention</label>
                    <input class="form-control" id="con-name" type="text" autofocus  value="{{ old('libelle',$typeintervention->libelle) }}"  name="libelle" >
                    @error('libelle')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $typeintervention->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.typeintervention.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection

