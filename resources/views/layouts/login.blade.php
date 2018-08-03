@extends('layouts.master')
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
@stop
@section('content')
  @include('header.header')
  <header id="vchip-header" class="vchip-cover vchip-cover-md" role="banner" style="height: 100%;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="vchip-container login-top" style="">
      <div class="row">
        <div class="text-left">
          <div class="row mrgn_200_top">
          @if(Session::has('message'))
            <div class="alert alert-success" id="message">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
          @endif
          @if (session('status'))
              <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session('status') }}
              </div>
          @endif
            <div class="animated bounceInRight" data-animate-effect="fadeInRight"></div>
            <div id="signinsignup" class="animated bounceInRight" data-animate-effect="fadeInRight">
              <div class="form-wrap">
                <div class="tab">
                  <div class="tab-content">
                    <div class="tab-content-inner active" data-content="signup">
                      @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                      @endif
                      <ul class=" nav-tabs v_login_reg text-center">
                        <li class="active"><a data-toggle="tab" href="#home" title="Sign In">Sign In</a></li>
                        <li><a data-toggle="tab" href="#menu1" title="Sign Up">Sign Up</a></li>
                      </ul>
                      <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                          <form id="loginForm" method="post" action="{{ url('login') }}">
                              {!! csrf_field() !!}
                            <div class="form-group">
                              <input name="email" type="email" class="form-control" placeholder="enter email id" autocomplete="off" required>
                              <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                              <input name="password" type="password" class="form-control" placeholder="password" data-type="password" autocomplete="off" required >
                              <span class="help-block"></span>
                            </div>
                            <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
                            <button type="submit" value="login" name="submit" class="btn btn-info btn-block">Login</button>
                            </br>
                          </form>
                          <div title="Forgot Password">
                          <a href="{{ url('forgotPassword')}}" >Forgot Password?</a></div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                          <form id="registerUser" method="post" action="{{ url('register')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <input id="name" type="text" class="form-control" name="name" value="" placeholder="User Name" autocomplete="off" required/>
                              <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                              <input type="phone" class="form-control" name="phone" value="" placeholder="Mobile number(10 digit)" pattern="[0-9]{10}"/>
                              <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                              <input id="email" name="email" type="email" class="form-control" autocomplete="off" placeholder="enter email id" required>
                              <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                              <input id="password" name="password" type="password" class="form-control" data-type="password" autocomplete="off" placeholder="password" required>
                              <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                              <input id="confirm_password" name="confirm_password" type="text" class="form-control" data-type="password" onfocus="this.type='password'" autocomplete="off" placeholder="confirm password" required>
                              <span class="help-block"></span>
                            </div>
                            <button type="submit" class="btn btn-info btn-block" title="Register">Register</button></br>
                          </form>
                          <div>
                            <a data-toggle="tab" href="#home" title="Alredy Member">Alredy Member?</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  @include('footer.footer')
@stop