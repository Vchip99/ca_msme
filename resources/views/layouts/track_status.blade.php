@extends('layouts.master')
@section('header-title')
    <title>Online Msme Registration | Track Registration</title>
@stop
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
@stop
@section('content')
  @include('header.header')
  <div class="container small-top" style="padding: 25px 20px 20px 20px;">
    <div class="div-style">
      @if(count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <form class="form-horizontal" role="form" method="POST" action="{{ url('track-order') }}">
      {{ csrf_field() }}
        <h3>Track your Registration Status</h3>
        <hr>
        <div class="form-group">
          <label class="control-label col-m-6 col-3">Order ID <sup>*</sup></label>
          <div class="col-m-6 col-6">
            <input type="text" class="form-control" name="order_id" placeholder="Enter your Order ID" required>
          </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-default btn-primary">Check Status</button>
        </div>
      </form>
    </div>
  </div>
  @include('footer.footer')
@stop