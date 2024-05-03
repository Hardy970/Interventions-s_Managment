@extends('authLayout')

@section('title','chauffeur')

@section('content')

<div class="w-75" id="exampleModal">
    <div class="modal-dialog modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $chauffeur->exists?'Modifier un chauffeur':'Ajouter un chauffeur' }}</h5>
          <button class="btn-close" onclick="history.back()"  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-bookmark needs-validation" id="bookmark-form" method="POST" action=" {{ !$chauffeur->exists?route('admin.chauffeur.store'):route('admin.chauffeur.update',['chauffeur'=>$chauffeur ])}}" >
            @csrf
            @method($chauffeur->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class=" col-md-7">
                    <label>Nom du chauffeur</label>
                    <input class="form-control" id="con-name" type="text" required   value="{{ old('nom',$chauffeur->nom) }}"  name="nom" >
                    @error('nom')
                        {{ $message }}
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-secondary" type="submit">{{ $chauffeur->exists?'Modifier':'Ajouter' }}</button>
            <button class="btn btn-primary" type="button"  onclick="history.back()" >Quitter</button>
          </form>
        </div>
      </div>
    </div>
  </div>

{{-- <form class="theme-form login-form" method="POST" action=" {{ !$chauffeur->exists?route('admin.chauffeur.store'):route('admin.chauffeur.update',['chauffeur'=>$chauffeur ])}}" >
  @csrf
  @method($chauffeur->exists?'PUT':'POST')
  <h4>{{ $chauffeur->exists?'Modifier un chauffeur':'Ajouter un chauffeur' }}</h4>
  <div class="form-group mt-3">
      <label>Nom du chauffeur</label>
      <div class="input-group">
        <input class="form-control" type="text" required value="{{ old('last_name',$chauffeur->nom) }}"  name="last_name" >
      </div>
      @error('last_name')
        {{ $message }}
      @enderror
    </div>
    <div class="form-group mt-3">
        <label>Prénoms du chauffeur</label>
        <div class="input-group">
          <input class="form-control" type="text" required value="{{ old('nom',$chauffeur->nom) }}"  name="nom" >
        </div>
        @error('nom')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Equipe du chauffeur</label>
        <div class="input-group">
          <select name="equipe_id" id="" class="form-control" >
            @foreach ($equipes as $equipe)
                <option value="{{ $equipe->id }}" @selected($equipe->id==$chauffeur->equipe_id)>{{ $equipe->nom }}</option>
            @endforeach
          </select>
        </div>
        @error('equipe_id')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Email du chauffeur</label>
        <div class="input-group">
          <input class="form-control" type="email" required value="{{ old('email',$chauffeur->email) }}"  name="email" >
        </div>
        @error('email')
          {{ $message }}
        @enderror
    </div>
   @if (!$chauffeur->exists)
   <div class="form-group mt-3">
    <label>Mot de passe </label>
    <div class="input-group">
      <input class="form-control" type="password" required  name="password" >
    </div>
    @error('password')
      {{ $message }}
    @enderror
</div>
   @endif
      
  <div class="form-group">
    <button class="btn btn-primary btn-block" type="submit">{{ $chauffeur->exists?'Modifier':'Ajouter' }}</button>
  </div>
  
</form> --}}
@endsection

