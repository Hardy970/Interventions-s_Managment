{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('authLayout')

@section('title','Mot de passe oublié')

@section('content')
<form class="theme-form login-form" method="POST" action=" {{ route('password.store') }}" >
    @csrf
    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="form-group">
        <label>Email Address</label>
        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
          <input class="form-control" type="email" required  value="{{ old('email',$request->email) }}" placeholder="Test@gmail.com" name="email" >
        </div>
        @error('email')
          {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <label>Mot de passe</label>
        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
          <input class="form-control" type="password" required  name="password" >
        </div>
        @error('password')
          {{ $message }}
        @enderror
      </div>

      <div class="form-group">
        <label>Confirmer le mot de passe</label>
        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
          <input class="form-control" type="password" required   name="password_confirmation" >
        </div>
        @error('password_confirmation')
          {{ $message }}
        @enderror
      </div>
    
    <div class="form-group">
      <button class="btn btn-primary btn-block" type="submit">Réinitialiser le mot de passe</button>
    </div>
    
  </form>

    
@endsection

