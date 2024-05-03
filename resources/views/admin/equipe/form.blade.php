@extends('authLayout')

@section('title','Equipe')

@section('content')
<form class="theme-form login-form" method="POST" action=" {{ !$equipe->exists?route('admin.equipe.store'):route('admin.equipe.update',['equipe'=>$equipe ])}}" >
  @csrf
  @method($equipe->exists?'PUT':'POST')
  <h4>{{ $equipe->exists?'Modifier une équipe':'Ajouter une équipe' }}</h4>
  <div class="form-group mt-3">
      <label>Nom de l'équipe</label>
      <div class="input-group">
        <input class="form-control" type="text" required value="{{ old('email',$equipe->nom) }}"  name="nom" >
      </div>
      @error('nom')
        {{ $message }}
      @enderror
    </div>
  <div class="form-group">
    <button class="btn btn-primary btn-block" type="submit">{{ $equipe->exists?'Modifier':'Ajouter' }}</button>
  </div>
  
</form>
@endsection

