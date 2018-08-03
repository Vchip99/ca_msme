@extends('admin.master')
@section('header-title')
    <title>Update Password</title>
@endsection
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
  <style type="text/css">
    .container{
      padding-top: 50px !important;
    }
  </style>
@stop
@section('content')
  @include('admin.header')
  <div style="padding:40px;">
      <center><h1 class="page-heading">Update Admin Password</h1></center>
    <div class="container div-style">
      @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <form action="{{url('admin/update-admin')}}" method="POST">
      {{method_field('PUT')}}
      {{ csrf_field() }}
      <div class="row">
          <div class="form-group">
              <label class="control-label col-m-6 col-2">Admin Name:</label>
              <div class="col-m-6 col-6">
                  <input type="text" class="form-control" name="name" placeholder="Name" value="{{Auth::guard('admin')->user()->name}}" readonly>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="form-group">
              <label class="control-label col-m-6 col-2">Old Password:</label>
              <div class="col-m-6 col-6">
                  <input type="password" class="form-control" name="old_password" placeholder="Old Password" value="" required>
              </div>
              @if($errors->has('old_password')) <p class="alert alert-danger">{{ $errors->first('old_password') }}</p> @endif
          </div>
      </div>
      <div class="row">
          <div class="form-group">
              <label class="control-label col-m-6 col-2">New Password:</label>
              <div class="col-m-6 col-6">
                  <input type="password" class="form-control" id="password" name="new_password" placeholder="Password" value="" required="true">
              </div>
              @if($errors->has('new_password')) <p class="alert alert-danger">{{ $errors->first('new_password') }}</p> @endif
          </div>
      </div>
      <div class="row">
          <div class="form-group">
              <label class="control-label col-m-6 col-2">Confirm Password:</label>
              <div class="col-m-6 col-6">
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="">
              </div>
              @if($errors->has('confirm_password')) <p class="alert alert-danger">{{ $errors->first('confirm_password') }}</p> @endif
          </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-3" title="Submit">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      </form>
    </div>
  </div>
@stop