@extends('authLayout')

@section('title','SIGN UP')


@section('header','Create Your Account')

@section('sub-header','Enter your personal details to create account')

@section('form-content')
<div class="form-group">            
    <label>Your Name</label>
    <div class="small-group">
      <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
        <input class="form-control" type="text" required="" placeholder="Fist Name">
      </div>
      <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
        <input class="form-control" type="email" required="" placeholder="Last Name">
      </div>
    </div>
  </div>
  <div class="form-group">
    <label>Email Address</label>
    <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
      <input class="form-control" type="email" required="" placeholder="Test@gmail.com">
    </div>
  </div>
  <div class="form-group">
    <label>Password</label>
    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
      <input class="form-control" type="password" name="login[password]" required="" placeholder="*********">
      <div class="show-hide"><span class="show">                         </span></div>
    </div>
  </div>
  <div class="form-group">
    <div class="checkbox">
      <input id="checkbox1" type="checkbox">
      <label class="text-muted" for="checkbox1">Agree with <span>Privacy Policy                   </span></label>
    </div>
  </div>
@endsection

@section('button-text','CREATE ACCOUNT')

@section('already','Already have an account?')

@section('login-social-title','signup with')

@section('action','Sign in')