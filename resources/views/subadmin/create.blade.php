@extends('admin.master')
@section('header-title')
    <title>Sub Admins</title>
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
      <center><h1 class="page-heading">Sub Admin</h1></center>
    <div class="container div-style">
    @if(isset($subadmin->id))
      <form action="{{url('admin/updateSubAdmin')}}" method="POST">
      {{method_field('PUT')}}
      <input type="hidden" name="subadmin_id" value="{{$subadmin->id}}">
    @else
      <form action="{{url('admin/createSubAdmin')}}" method="POST">
    @endif
      {{ csrf_field() }}
      <div class="row">
          <div class="form-group">
              <label class="control-label col-m-6 col-2">Sub Admin Name:</label>
              <div class="col-m-6 col-6">
                  <input type="text" class="form-control" name="name" placeholder="Name" value="{{isset($subadmin->id)?$subadmin->name:NULL}}" required="true">
              </div>
              @if($errors->has('name')) <p class="alert alert-danger">{{ $errors->first('name') }}</p> @endif
          </div>
      </div>
      <div class="row">
          <div class="form-group">
              <label class="control-label col-m-6 col-2">Email:</label>
              <div class="col-m-6 col-6">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{isset($subadmin->id)?$subadmin->email:NULL}}" required="true">
              </div>
              @if($errors->has('email')) <p class="alert alert-danger">{{ $errors->first('email') }}</p> @endif
          </div>
      </div>
      @if(!empty($subadmin->id))
        @if(1 == $subadmin->is_subadmin)
          <div class="row">
        @else
          <div class="row hide">
        @endif
      @else
          <div class="row">
      @endif
          <div class="form-group">
              <label class="control-label col-m-6 col-2">Password:</label>
              <div class="col-m-6 col-6">
                @if(isset($subadmin->id))
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                @else
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required="true">
                @endif
              </div>
              @if($errors->has('password')) <p class="alert alert-danger">{{ $errors->first('password') }}</p> @endif
          </div>
      </div>
      @if(!empty($subadmin->id))
          <div class="row hide">
      @else
          <div class="row">
      @endif
          <div class="form-group">
              <label class="control-label col-m-6 col-2">Confirm Password:</label>
              <div class="col-m-6 col-6">
                @if(isset($subadmin->id))
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="">
                @else
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="" required="true">
                @endif
              </div>
              @if($errors->has('confirm_password')) <p class="alert alert-danger">{{ $errors->first('confirm_password') }}</p> @endif
          </div>
      </div>
      <div class="row">
          <div class="form-group">
              <label class="control-label col-m-6 col-2">Is Admin:</label>
              @if(isset($subadmin->id))
                <div class="col-m-1 col-1">
                  <label><input type="radio" name="is_admin" value="1" @if(1 == $subadmin->is_subadmin)  checked="true" @endif > No </label>
                </div>
                <div class="col-m-1 col-1">
                  <label><input type="radio" name="is_admin" value="0" @if(0 == $subadmin->is_subadmin)  checked="true" @endif > Yes </label>
                </div>
              @else
                <div class="col-m-1 col-1">
                  <label><input type="radio" name="is_admin" value="1" checked="true"> No </label>
                </div>
                <div class="col-m-1 col-1">
                  <label><input type="radio" name="is_admin" value="0"> Yes </label>
                </div>
              @endif
          </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-3" title="Submit">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </form>
  </div>
</div>
@stop