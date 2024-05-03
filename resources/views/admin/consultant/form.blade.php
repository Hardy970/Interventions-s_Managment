@extends('authLayout')

@section('title','Consultant')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $consultant->exists?'Modifier un consultant':'Ajouter un consultant' }}</h5>
          <button class="btn-close" onclick="history.back()"  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-bookmark needs-validation" id="bookmark-form" method="POST" action=" {{ !$consultant->exists?route('admin.consultant.store'):route('admin.consultant.update',['consultant'=>$consultant ])}}" >
            @csrf
            @method($consultant->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Prénoms du consultant</label>
                    <input class="form-control" id="con-name" type="text" required placeholder="Prénoms"  value="{{ old('first_name',$consultant->first_name) }}"  name="first_name" >
                    @error('first_name')
                        {{ $message }}
                    @enderror
                  </div>
                  <div class="col-sm-6">   
                    <label>Nom du consultant</label>
                    <input class="form-control" id="con-last" type="text" required="" placeholder="Nom"   value="{{ old('last_name',$consultant->last_name) }}"  name="last_name">
                    @error('last_name')
                    {{ $message }}
                  @enderror
                  </div>
                </div>
              </div>
              <div class="mb-3 col-md-12 mt-0">
                <label for="con-mail">Email </label>
                <input class="form-control" id="con-mail" type="email" required="" value="{{ old('email',$consultant->email) }}"  name="email" >
                @error('email')
                {{ $message }}
              @enderror
              </div>
              <div class="mb-3 col-md-12 my-0">
                <div class="row">
                  @if (!$consultant->exists)
                  <div class="col-sm-6">
                        <div class="form-group">
                            <label>Mot de passe </label>
                            <div class="input-group">
                                <input class="form-control" type="password" required  name="password" >
                            </div>
                         @error('password')
                          {{ $message }}
                         @enderror
                        </div>
                  </div>
                  @endif
                  <div class="col-sm-6">
                    <div class=" form-group">
                      <label>Equipe du consultant</label>
                      <div class="input-group">
                        <select name="equipe_id" id="" class="form-controsl form-select " >
                          <option value="">Choisir une équipe</option>
                          @foreach ($equipes as $equipe)
                              <option value="{{ $equipe->id }}" @selected($equipe->id==$consultant->equipe_id)>{{ $equipe->nom }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('equipe_id')
                        {{ $message }}
                      @enderror
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-secondary" type="submit">{{ $consultant->exists?'Modifier':'Ajouter' }}</button>
            <button class="btn btn-primary" type="button"  onclick="history.back()" >Quitter</button>
          </form>
        </div>
      </div>
    </div>
  </div>

{{-- <form class="theme-form login-form" method="POST" action=" {{ !$consultant->exists?route('admin.consultant.store'):route('admin.consultant.update',['consultant'=>$consultant ])}}" >
  @csrf
  @method($consultant->exists?'PUT':'POST')
  <h4>{{ $consultant->exists?'Modifier un consultant':'Ajouter un consultant' }}</h4>
  <div class="form-group mt-3">
      <label>Nom du consultant</label>
      <div class="input-group">
        <input class="form-control" type="text" required value="{{ old('last_name',$consultant->nom) }}"  name="last_name" >
      </div>
      @error('last_name')
        {{ $message }}
      @enderror
    </div>
    <div class="form-group mt-3">
        <label>Prénoms du consultant</label>
        <div class="input-group">
          <input class="form-control" type="text" required value="{{ old('first_name',$consultant->nom) }}"  name="first_name" >
        </div>
        @error('first_name')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Equipe du consultant</label>
        <div class="input-group">
          <select name="equipe_id" id="" class="form-control" >
            @foreach ($equipes as $equipe)
                <option value="{{ $equipe->id }}" @selected($equipe->id==$consultant->equipe_id)>{{ $equipe->nom }}</option>
            @endforeach
          </select>
        </div>
        @error('equipe_id')
          {{ $message }}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label>Email du consultant</label>
        <div class="input-group">
          <input class="form-control" type="email" required value="{{ old('email',$consultant->email) }}"  name="email" >
        </div>
        @error('email')
          {{ $message }}
        @enderror
    </div>
   @if (!$consultant->exists)
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
    <button class="btn btn-primary btn-block" type="submit">{{ $consultant->exists?'Modifier':'Ajouter' }}</button>
  </div>
  
</form> --}}
@endsection

