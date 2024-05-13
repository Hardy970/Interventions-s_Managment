@extends('layout')

@section('title','Rôle-FORM')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $role->exists?'Modifier un rôle':'Ajouter un rôle' }}</h5>
        </div>
        <div class="modal-body">
          <form class=" needs-validation" id="bookmark-form" method="POST" action=" {{ !$role->exists?route('admin.role.store'):route('admin.role.update',['role'=>$role ])}}" >
            @csrf
            @method($role->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-8">
                    <label>Libellé du rôle</label>
                    <input class="form-control" id="con-name" type="text"   value="{{ old('libelle',$role->libelle) }}"  name="libelle" >
                    @error('libelle')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit">{{ $role->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.role.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection

