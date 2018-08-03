@extends('layouts.master')
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
@stop
@section('content')
  @include('header.header')
  <div>
      <div class="style-div col-m-12">Carry Forward your business while we take care of your legal procedures</div>
  </div>
  <div class="container-fluid pad-div" id="Home">
    <div class="row">
      <div class="col-4 col-m-12 animated slideInLeft">
        <div class="panel panel-default">
          <div class="panel-heading text-center">
          Get Call from Our Experts
          </div>
          <div class="panel-body">
          @if(Session::has('message'))
            <div class="alert alert-success" id="message">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
          @endif
          @if(Session::has('status'))
            <div class="alert alert-success" id="message">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('status') }}
            </div>
          @endif
          <form class="form-horizontal" role="form" method="POST" action="{{ url('compliance-registration') }}">
                {{ csrf_field() }}
                <div class="col-12"><input type="text" class="form-control" name="name" placeholder="full name*" required></div>
                <div class="col-12"><input type="text" class="form-control" name="email" placeholder="Emailid*" required></div>
                <div class="col-12"><input type="text" class="form-control" name="mobile" placeholder="Mobile no.*" required></div>
                <div class="col-12"><input type="text" class="form-control" name="city" placeholder="City*" required></div>
                <div class="col-12">
                    <select class="form-control" name="looking_for" required>
                        <option>Looking for*</option>
                        <option value="IT Returns">IT Returns</option>
                        <option value="GST Returns">GST Returns</option>
                        <option value="PF ESI Returns">PF ESI Returns</option>
                        <option value="Accounting">Accounting</option>
                        <option value="Payroll Management">Payroll Management</option>
                        <option value="Management Audit">Management Audit</option>
                        <option value="Internal Audit">Internal Audit</option>
                    </select>
                </div>
                <input type="hidden" name="home_url" value="call_to_expert">
                <button type="submit" class="btn btn-default btn-lg btn-primary btn-block pull-right">Get Started<span class="glyphicon glyphicon-chevron-right"></span></button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-8 col-m-12">
        <div class="text-center">
          <div class="row">
            <div class="col-3 col-m-4 col-xs-6 animated slideInLeft">
              <a href="{{url('pf-registration')}}"><img src="{{ asset('images/icons/pf.png')}}" class="img-circle transdiv image" alt="PF ESIC"/></a>
              <h4>PF ESI</h4>
            </div>
            <div class="col-3 col-m-4 col-xs-6 animated slideInLeft">
              <a href="{{url('gst-registration')}}"><img src="{{ asset('images/icons/gst.png')}}" class="img-circle transdiv image" alt="GST"/></a>
              <h4>GST Registration</h4>
            </div>
            <div class="col-3 col-m-4 col-xs-6 animated slideInLeft">
              <a href="{{url('ngo-registration')}}"> <img src="{{ asset('images/icons/abc.png')}}" class="img-circle transdiv image" alt="12A 80G"/></a>
              <h4>12A & 80G Registration</h4>
            </div>
            <div class="col-3 col-m-4 col-xs-6 animated slideInLeft">
              <a href="{{url('company-registration')}}"><img src="{{ asset('images/icons/business.png')}}" class="img-circle transdiv image" alt="company_incorporation"/></a>
              <h4>Company Incorporation</h4>
            </div>
            <div class="col-3 col-m-4 col-xs-6 animated slideInLeft">
              <a href="{{ url('import-export-registration')}}"><img src="{{ asset('images/icons/IEC.png')}}" class="img-circle transdiv image" alt="IEC"/></a>
              <h4>IEC</h4>
            </div>
            <div class="col-3 col-m-4 col-xs-6 animated slideInLeft">
              <a href="{{ url('partnership-registration')}}"><img src="{{ asset('images/icons/partnership.png')}}" class="img-circle transdiv image" alt="Partnership Deed"/></a>
              <h4>Partnership Deed</h4>
            </div>
            <div class="col-3 col-m-4 col-xs-6 animated slideInLeft">
              <a href="{{url('pt-registration')}}"><img src="{{ asset('images/icons/PT.jpg')}}" class="img-circle transdiv image" alt="Professional Tax"/></a>
              <h4>Professional Tax</h4>
            </div>
            <div class="col-3 col-m-4 col-xs-6 animated slideInLeft">
              <a href="{{ url('msme-registration')}}"><img src="{{ asset('images/icons/MSME.png')}}" class="img-circle transdiv image"  alt="MSME"/></a>
              <h4>MSME Registration</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="style-div">All Services at a Glance</div>
  <blockquote><p class="text-center">We believe in providing quality service to the fastest growing startups at cheapest price. Here, we provide a platform to simplify legal and business related matters.</p></blockquote>
  @include('footer.footer')
@stop