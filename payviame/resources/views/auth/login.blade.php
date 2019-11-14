@extends('layouts.auth')

@section('title','Login')

@section('content')
<main>  
    <header class="position-relative">  
        <div class="top-section-lined"> 
            <div class="line line-style-1 inner-section-lined" style="transform: skewY(0deg);">
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span> 
            </div>  
            <div class="container pt-lg-md">
                <div class="row justify-content-center" >
                  <div class="col-lg-5" style="margin-top: 100px; margin-bottom: 50px;">
                    <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
                      <li class="nav-item" style="padding-right: 1rem;">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-1-tab" href="{{ route('register')}}" style="background-color: white;">Sign Up</a>
                      </li>
                      <li class="nav-item" >
                        <a class="nav-link mb-sm-3 mb-md-0 active" href="{{ route('login')}}">Sign In</a>
                      </li>
                    </ul>
                    <br>
                    @include('includes.partial.msg')
                    <div class="card shadow border-0">
                      <!-- <div class="card-header bg-white pb-1">
                        <div class="text-muted text-center mb-3">
                          <small>Sign in with</small>
                        </div>
                        <div class="text-center">
                          <a class="btn btn-neutral btn-icon js-confirm-cookies" href="#">
                            <span class="btn-inner--icon">
                              <img src="images/google-ff03329e9210ea5e5f371147b192e613719b5c980161efb63274f5e4ebf76a2b.svg" alt="Google">
                            </span>
                            <span class="btn-inner--text">Google</span>
                          </a>
                        </div>
                      </div> -->
                      <div class="card-body bg-secondary px-lg-5 mb-4">
                        <div class="text-center text-muted mb-4">
                          <small>Sign in with credentials</small>
                        </div>

                        <form data-behaviour="validate-form" class="new_user" id="new_user" action="{{ route('login') }}" accept-charset="UTF-8" method="post">
                          @csrf

                          <div class="form-group focused">
                            <div class="input-group input-group-alternative mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                              </div>
                              <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                        
                          <div class="form-group focused">
                            <div class="input-group input-group-alternative">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                              </div>
                              <input placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>

                              @if ($errors->has('password'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                          
                      
                          <div class="row my-4">
                            <div class="col-12">
                              <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id="customCheckRemember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckRemember">
                                  <span>
                                     Remember Me
                                  </span>
                                </label>
                              </div>
                            </div>
                          </div>

                        
                          <div class="text-center">
                            <!-- <input type="submit" class="btn btn-primary mt-4"> -->
                            <button type="submit" class="btn btn-primary">
                              Sign in
                            </button>
                          </div>
                          <div class="row mt-3" >
                              <div class="col-6">
                                <a href="{{ route('password.request') }}" class="text-light">
                                  <small style="color: #525f7f;">Forgot password?</small>
                                </a>
                              </div>
                              <div class="col-6 text-right">
                                <a class="text-light" href="{{ route('register') }}">
                                  <small style="color: #525f7f;">Create new account</small>
                                </a>
                              </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </header>
</main>
@endsection
