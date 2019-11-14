@extends('layouts.auth')

@section('title','Sing Up')

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
                      <li class="nav-item" style="    padding-right: 1rem;">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" href="{{ route('register')}}">Sign Up</a>
                      </li>
                      <li class="nav-item" >
                        <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('login')}}" style="background-color: white;">Sign In</a>
                      </li>
                    </ul>
                    <br>
                    @include('includes.partial.msg')
                    <div class="card shadow border-0">

                        <div class="card-body bg-secondary px-lg-5 mb-4">
                            <div class="text-center text-muted mb-4">
                              <small>Sign up with credentials</small>
                            </div>

                            <form data-behaviour="validate-form" class="new_user" id="new_user" action="{{ route('register') }}" accept-charset="UTF-8" method="post">
                              @csrf
                              <div class="form-group focused">
                                <div class="input-group input-group-alternative mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                  </div>
                                  <input placeholder="Name" type="text" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                  @if ($errors->has('name'))
                                      <span class="invalid-feedback">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                  </div>
                                  <input placeholder="Email" type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                                  <input placeholder="Password" type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                                    <input class="custom-control-input" id="customCheckRegister" type="checkbox" required>
                                    <label class="custom-control-label" for="customCheckRegister">
                                      <span>
                                        I agree to the
                                        <a target="_blank" href="privacy.php">Privacy Policy</a>
                                        and
                                        <a target="_blank" href="terms.php">Terms</a>
                                      </span>
                                    </label>
                                  </div>
                                </div>
                              </div>

                            
                              <div class="text-center">
                                <!-- <input type="submit" class="btn btn-primary mt-4"> -->
                                <button type="submit" class="btn btn-primary">
                                  Create account
                                </button>
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
