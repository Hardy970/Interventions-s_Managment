@extends('authLayout')

@section('title','LOGIN')

@section('content')
<form class="theme-form login-form" method="POST" action="" >
  @csrf
  <h4>Se connecter</h4>
  {{-- <h6>Welcome back! Log in to your account.</h6> --}}
    <div class="form-group">
      <label>Email </label>
      <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
        <input class="form-control" type="email" required="" value="{{ old('email') }}"  name="email" >
      </div>
      @error('email')
      <div>
        <span class="text-danger fw-bold "> {{ $message }} </span>
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label>Password</label>
      <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
        <input class="form-control " type="password" name="password">
        <div class="show-hide" id="password-addon" ><i  class="mdi mdi-eye-outline"></i></div> 
      </div>
    </div>
    <div class="form-group">
      <div class="checkbox">
        <input id="checkbox1" name="remember" type="checkbox">
        <label for="checkbox1">Se rappeler de moi</label>
      </div><a class="link" href="{{ route('password.request') }}">Mot de passe oublié?</a>
    </div>
  <div class="form-group">
    <button class="btn btn-primary btn-block" type="submit">SE CONNECTER</button>
  </div>
  
</form>
@endsection

