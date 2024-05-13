

@extends('layout')

@section('title')
    Profile
@endsection

@section('content')
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> --}}
   
     
         
              <div class="edit-profile">
                <div class="row">
                  <div class="col-xl-4">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Modifier le mot de passe</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                      </div>
                      <div class="card-body">
    
<form class="" method="POST" action=" {{ route('password.update') }}" >
    @csrf
    @method('put')
    @if($errors->updatePassword->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->updatePassword->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class=" alert alert-success  "
                >{{ __('Enregistré.') }}</p>
        @endif

    <div class="form-group">
        <label>Mot de passe actuel</label>
        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
          <input class="form-control" type="password" required  name="current_password" >
        </div>
        @error('current_password')
          <div class=" text-bg-danger  text-danger ">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Nouveau mot de passe</label>
        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
          <input class="form-control" type="password" required   name="password" >
        </div>
        @error('password')
        <div class=" text-bg-danger  text-danger ">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Confirmer le mot de passe</label>
        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
          <input class="form-control" type="password" required   name="password_confirmation" >
        </div>
        @error('password_confirmation')
        <div class=" text-bg-danger  text-danger ">
          {{ $message }}
        </div>
        @enderror
      </div>
    
    <div class="form-group">
      <button class="btn btn-primary btn-block" type="submit">Enregistrer</button>
      
    </div>
    
  </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-8">
                    <form class="card" method="POST" action="{{ route('profile.update') }}" >
                        @csrf
                        @method('patch')
                      <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Edit Profile</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-6 col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Email </label>
                              <input class="form-control" type="email" name="email" disabled value="{{ old('email',Auth::user()->email) }}" >
                              @error('email')
                                  {{ $message }}
                              @enderror
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Nom</label>
                              <input class="form-control" type="text" name="last_name" value="{{ old('last_name',Auth::user()->last_name)  }}" >
                              @error('last_name')
                                  {{ $message }}
                              @enderror
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Prénoms</label>
                              <input class="form-control" type="text" name="first_name" value="{{ old('first_name', Auth::user()->first_name )}}" >
                              @error('first_name')
                                  {{ $message }}
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Modifier le profil</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <!-- Container-fluid Ends-->
@endsection