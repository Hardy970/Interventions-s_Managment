@extends('layout')

@section('title','Consultant')

@section('content')

<div class="" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $consultant->exists?'Modifier un utilisateur':'Ajouter un utilisateur' }}</h5>
        </div>
        <div class="modal-body d-flex flex-column">
          <form class="" id="bookmark-form" method="POST" action=" {{ !$consultant->exists?route('admin.consultant.store'):route('admin.consultant.update',['consultant'=>$consultant ])}}" >
            @csrf
            @method($consultant->exists?'PUT':'POST')
            <div class="row g-2">
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label>Prénoms du consultant</label>
                    <input class="form-control" id="con-name" type="text" autofocus  placeholder="Prénoms"  value="{{ old('first_name',$consultant->first_name) }}"  name="first_name" >
                    @error('first_name')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                  <div class="col-sm-6 form-group">   
                    <label>Nom du consultant</label>
                    <input class="form-control" id="con-last" type="text"  placeholder="Nom"   value="{{ old('last_name',$consultant->last_name) }}"  name="last_name">
                    @error('last_name')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                  @enderror
                  </div>
                </div>
              </div>
              <div class="mb-3 col-md-12 mt-0">
                <div class="row">
                  <div class="col-sm-7">
                    <div class=" form-group">
                    <label for="con-mail">Email </label>
                    <input class="form-control" id="con-mail" type="email"  value="{{ old('email',$consultant->email) }}"  name="email" >
                    @error('email')
                    <div>
                      <span class="text-danger fw-bold "> {{ $message }} </span>
                    </div>
                    @enderror
                  </div>
                  </div>
                  <div class="col-sm-5">
                    <div class=" form-group">
                      <label>Rôle</label>
                      <div class="input-group">
                        <select name="role_id" class="js-example-basic-single" >
                          <option value="">Choisir un rôle</option>
                          @foreach ($roles as $role)
                              <option value="{{ $role->id }}" @selected($role->id==$consultant->role_id)>{{ $role->libelle }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('role_id')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                  </div>

                </div>
              </div>
              <div class="mb-3 col-md-12 my-0">
                <div class="row">
                  @if (!$consultant->exists)
                  <div class="col-sm-6">
                        <div class="form-group">
                            <label>Mot de passe </label>
                                <input class="form-control" type="password"   name="password" >
                         @error('password')
                         <div>
                          <span class="text-danger fw-bold "> {{ $message }} </span>
                        </div>
                         @enderror
                        </div>
                  </div>
                  @endif
                  <div class="col-sm-6">
                    <div class=" form-group">
                      <label>Equipe du consultant</label>
                        <select name="equipe_id" class="js-example-basic-single">
                          <option value="">Choisir une équipe</option>
                          @foreach ($equipes as $equipe)
                              <option value="{{ $equipe->id }}" @selected($equipe->id==$consultant->equipe_id)>{{ $equipe->nom }}</option>
                          @endforeach
                        </select>
                      @error('equipe_id')
                      <div>
                        <span class="text-danger fw-bold "> {{ $message }} </span>
                      </div>
                      @enderror
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success " type="submit">{{ $consultant->exists?'Modifier':'Ajouter' }}</button>
            <a class="btn btn-danger" href="{{ route('admin.consultant.index') }}" >Quitter</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

