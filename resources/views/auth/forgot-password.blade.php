{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('authLayout')

@section('title','Mot de passe oublié')

@section('content')
<form class="theme-form login-form" method="POST" action=" {{ route('password.email') }}" >
    @csrf
    <p class="my-2">Entrez votre adresse e-mail pour recevoir lien de réinitialisation de mot de passe par e-mail, vous permettant d'en choisir un nouveau.</p>
    <div class="form-group">
        <div class=" text-success  my-2 ">
            @if(session('status'))
                {{ session('status') }}
            @endif
        </div>
        <label>Email Address</label>
        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
          <input class="form-control" type="email" required="" value="{{ old('email') }}" placeholder="Test@gmail.com" name="email" >
        </div>
        @error('email')
          {{ $message }}
        @enderror
      </div>
    
    <div class="form-group">
      <button class="btn btn-primary btn-block" type="submit">Envoyer</button>
    </div>
    
  </form>

    
@endsection

