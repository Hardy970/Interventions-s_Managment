@extends('authLayout')

@section('title','vehicule')

@section('content')

<div class="w-75" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $vehicule->exists?'Modifier un vehicule':'Ajouter un vehicule' }}</h5>
          <button class="btn-close" onclick="history.back()"  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-bookmark needs-validation" id="bookmark-form" method="POST" action=" {{ !$vehicule->exists?route('admin.vehicule.store'):route('admin.vehicule.update',['vehicule'=>$vehicule ])}}" >
            @csrf
            @method($vehicule->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Matricule</label>
                    <input class="form-control" id="con-name" type="text" required   value="{{ old('matricule',$vehicule->matricule) }}"  name="matricule" >
                    @error('matricule')
                        {{ $message }}
                    @enderror
                  </div>
                  <div class="col-sm-6">   
                    <label>Marque</label>
                    <input class="form-control" id="con-last" type="text" required   value="{{ old('marque',$vehicule->marque) }}"  name="marque">
                    @error('marque')
                    {{ $message }}
                  @enderror
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-secondary" type="submit">{{ $vehicule->exists?'Modifier':'Ajouter' }}</button>
            <button class="btn btn-primary" type="button"  onclick="history.back()" >Quitter</button>
          </form>
        </div>
      </div>
    </div>
  </div>

{{-- <form class="theme-form login-form" method="POST" action=" {{ !$vehicule->exists?route('admin.vehicule.store'):route('admin.vehicule.update',['vehicule'=>$vehicule ])}}" >
  @csrf
  @method($vehicule->exists?'PUT':'POST')
  <h4>{{ $vehicule->exists?'Modifier un vehicule':'Ajouter un vehicule' }}</h4>
  <div class="form-group mt-3">
      <label>Nom du vehicule</label>
      <div class="input-group">
        <input class="form-control" type="text" required value="{{ old('marque',$vehicule->nom) }}"  name="marque" >
      </div>
      @error('marque')
        {{ $message }}
      @enderror
    </div>
    <div class="form-group mt-3">
        <label>Prénoms du vehicule</label>
        <div class="input-group">
          <input class="form-control" type="text" required value="{{ old('matricule',$vehicule->nom) }}"  name="matricule" >
        </div>
        @error('matricule')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Equipe du vehicule</label>
        <div class="input-group">
          <select name="equipe_id" id="" class="form-control" >
            @foreach ($equipes as $equipe)
                <option value="{{ $equipe->id }}" @selected($equipe->id==$vehicule->equipe_id)>{{ $equipe->nom }}</option>
            @endforeach
          </select>
        </div>
        @error('equipe_id')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Email du vehicule</label>
        <div class="input-group">
          <input class="form-control" type="email" required value="{{ old('email',$vehicule->email) }}"  name="email" >
        </div>
        @error('email')
          {{ $message }}
        @enderror
    </div>
   @if (!$vehicule->exists)
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
    <button class="btn btn-primary btn-block" type="submit">{{ $vehicule->exists?'Modifier':'Ajouter' }}</button>
  </div>
  
</form> --}}
@endsection

