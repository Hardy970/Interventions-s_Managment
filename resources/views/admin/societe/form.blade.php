@extends('authLayout')

@section('title','societe')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $societe->exists?'Modifier une societe':'Ajouter une societe' }}</h5>
          <button class="btn-close" onclick="history.back()"  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-bookmark needs-validation" id="bookmark-form" method="POST" action=" {{ !$societe->exists?route('admin.societe.store'):route('admin.societe.update',['societe'=>$societe ])}}" >
            @csrf
            @method($societe->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Nom de la société</label>
                    <input class="form-control" id="con-name" type="text" required   value="{{ old('nom',$societe->nom) }}"  name="nom" >
                    @error('nom')
                        {{ $message }}
                    @enderror
                  </div>
                  <div class="col-sm-6">   
                    <label>Localité</label>
                    <input class="form-control" id="con-last" type="text" required  value="{{ old('localite',$societe->localite) }}"  name="localite">
                    @error('localite')
                    {{ $message }}
                  @enderror
                  </div>
                </div>
              </div>
              <div class="mb-3 col-md-12 mt-0">
                <label for="con-mail">Email de la société</label>
                <input class="form-control" type="email" required="" value="{{ old('email',$societe->email) }}"  name="email" >
                @error('email')
                {{ $message }}
              @enderror
              </div>
              <div class="mb-3 col-md-12 my-0">
                <div class="row">
                  
                  <div class="col-sm-6">
                    <div class=" form-group">
                      <label>Téléphone</label>
                      <div class="input-group">
                        <input class="form-control" id="con-mail" type="number" value="{{ old('telephone',$societe->telephone) }}"  name="telephone" >
                      </div>
                      @error('telephone')
                        {{ $message }}
                      @enderror
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-secondary" type="submit">{{ $societe->exists?'Modifier':'Ajouter' }}</button>
            <button class="btn btn-primary" type="button"  onclick="history.back()" >Quitter</button>
          </form>
        </div>
      </div>
    </div>
  </div>

{{-- <form class="theme-form login-form" method="POST" action=" {{ !$societe->exists?route('admin.societe.store'):route('admin.societe.update',['societe'=>$societe ])}}" >
  @csrf
  @method($societe->exists?'PUT':'POST')
  <h4>{{ $societe->exists?'Modifier un societe':'Ajouter un societe' }}</h4>
  <div class="form-group mt-3">
      <label>Nom du societe</label>
      <div class="input-group">
        <input class="form-control" type="text" required value="{{ old('localite',$societe->nom) }}"  name="localite" >
      </div>
      @error('localite')
        {{ $message }}
      @enderror
    </div>
    <div class="form-group mt-3">
        <label>Prénoms du societe</label>
        <div class="input-group">
          <input class="form-control" type="text" required value="{{ old('nom',$societe->nom) }}"  name="nom" >
        </div>
        @error('nom')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Equipe du societe</label>
        <div class="input-group">
          <select name="equipe_id" id="" class="form-control" >
            @foreach ($equipes as $equipe)
                <option value="{{ $equipe->id }}" @selected($equipe->id==$societe->equipe_id)>{{ $equipe->nom }}</option>
            @endforeach
          </select>
        </div>
        @error('equipe_id')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Email du societe</label>
        <div class="input-group">
          <input class="form-control" type="email" required value="{{ old('email',$societe->email) }}"  name="email" >
        </div>
        @error('email')
          {{ $message }}
        @enderror
    </div>
   @if (!$societe->exists)
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
    <button class="btn btn-primary btn-block" type="submit">{{ $societe->exists?'Modifier':'Ajouter' }}</button>
  </div>
  
</form> --}}
@endsection

