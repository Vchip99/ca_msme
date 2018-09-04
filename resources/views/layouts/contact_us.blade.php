@extends('layouts.master')
@section('header-title')
    <title>Online Msme Registration | Contact Us</title>
@stop
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/contact.css')}}">
@stop
@section('content')
  @include('header.header')
  <div class="container-fluid small-top" style="padding-top: 20px;">
    <div class="contact-div" >
      <div class="head">Contact Us</div>
      <center><span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span></center>
      <div class="row">
        @if(Session::has('message'))
          <div class="alert alert-success" id="message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ Session::get('message') }}
          </div>
        @endif
      <div class="column col-m-6 col-6">
        <div class="form-caption">MSME</div><br>
        <!-- <div class="contact-details"><p><span class="fa fa-map-marker"></span></p></div> -->
        <div class="contact-details"><p><span class="fa fa-envelope"></span> contactus@msme-online.org<span class="fa fa-phone"></span>+91 8530440444</p></div>
        <div class="contact-details">This portal is for MSME/SSI/UDYOG ADDHAR Registration and optaining certificate in india. For any Schemes or Benefits related question, you can directly contact the MSME office in your respective districts or write us email for any concern realted to msme registation.In case of any query related to Registration, you can send us email at support@msme-online.org.</div>
      </div>
      <div class="column col-m-6 col-6">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('contact-us') }}">
            {{ csrf_field() }}
            <div class="form-caption" >Get in touch</div>
              <div class="form-group">
                <div class="col-m-12 col-10"><input type="text" class="form-control" placeholder="Name" name="name" required></div>
              </div>
              <div class="form-group"><div class="col-10 col-m-12"><input type="email" class="form-control" placeholder=" Email" name="email" required></div>
              </div>
              <div class="form-group"><div class="col-10 col-m-12"><textarea class="form-control" name="message" placeholder="Message" rows="5"></textarea></div></div>
              <div class="form-group col-m-12 col-12 text-center"><button type="submit" class="btn btn-default btn-danger btn-lg">Send</button></div>
          </form>
      </div>
      </div>
    </div>
  </div>
  @include('footer.footer')
@stop