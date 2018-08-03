@extends('layouts.master')
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/career.css')}}">
@stop
@section('content')
  @include('header.header')
  <div class="container-fluid">
    <div class="element-with-background-image">
    <h1 class="animated zoomIn">CAREER</h1>
    </div>
    <div class="content">
      @if(Session::has('message'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
      @endif
      <div class="head">WE ARE HIRING</div>
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
      <h3>RIGHT PLACE FOR YOUR CAREER</h3>
      <div class="para"><p>C A Mahore and Co is a Chartered Accountants firm based in Pune. The firm has been set up by a group of young, enthusiastic, highly skilled and motivated professionals who have taken experience from best consulting firms and are extensively experienced in their chosen fields has providing a wide array of Accounting, Auditing, Taxation, Assurance and Business advisory services to various clients and their stakeholders.</p></div>
      <div class="para"><p>We value relationships and take pride in our personalized service that is tailored to our clients’ needs. Our aim is to provide a one-stop solution for all our client’s business requirements. Evolving with the growing technology, our methodologies are customized to meet client requirements; and our interface with the client is a perfect balance between professionalism and personal rapport. Our work methodologies rest on the principles of Quality, doing our job with Passion and constantly working on Innovation to deliver excellent results.</p></div>
    </div>
    <div class="content">

      <div class="head">CAREER</div>
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
      <center><div class="career-form">
         <form class="vertical-form" role="form" method="POST" action="{{ url('send-resume') }}"  enctype="multipart/form-data">
            {{ csrf_field() }}
          Make your career with CA Mahore
          <br><br>
          <div class="form-group">
            <label class="control-label">Your Name</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user fa-cust"></i></span>
              <input type="text" class="form-control" name="name" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Your Email</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-envelope fa-cust"></i></span>
              <input type="text" class="form-control" name="email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Your Phone Number</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone fa-cust"></i></span>
              <input type="phone" class="form-control" name="phone" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Your Resume</label>
            <input type="file" class="form-control" name="resume" required>
          </div>
          <button class="btn btn-default btn-send">Send</button>
        </form>
      </div></center>
    </div>
  </div>
  @include('footer.footer')
@stop