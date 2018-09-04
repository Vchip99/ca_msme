@extends('layouts.master')
@section('header-title')
    <title>Online Msme Registration | Registration Status</title>
@stop
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
  <style type="text/css">
  .cust-container {
    padding-bottom: 50px;
    padding-top: 50px;
    margin-left: 50%;
  }
  /*.progressbar {
      counter-reset: step;
  }
  .progressbar li {
      list-style-type: none;
      width: 20%;
      float: left;
      font-size: 16px;
      position: relative;
      text-align: center;
      text-transform: uppercase;
      color: #d9534f;
      font-weight: bold;
  }
  .progressbar li:before {
      width: 50px;
      height: 50px;
      content: counter(step);
      counter-increment: step;
      line-height: 45px;
      border: 4px solid #d9534f;
      display: block;
      text-align: center;
      margin: 0 auto 10px auto;
      border-radius: 50%;
      background-color: white;
  }
  .progressbar li:after {
      width: 100%;
      height: 2px;
      content: '';
      position: absolute;
      background-color: #d9534f;
      top: 25px;
      left: -50%;
      z-index: -1;
  }
  .progressbar li:first-child:after {
      content: none;
  }
  .progressbar li.active {
      color: #4bb543;
  }
  .progressbar li.active:before {
      border-color: #55b776;
      content: "\2713";
  }
  .progressbar li.active + li:after {
      background-color: #55b776;
  }
  .span{
    display: inline;
  }
  .support{
    font-size: 16px;
    color: #337ab7;
  }*/
</style>
<style>
  .span{
    display: inline;
  }
  .support{
    font-size: 16px;
    color: #337ab7;
  }
  .cust-wrapper {
  width: 100%;
  font-family: 'Helvetica';
  font-size: 14px;
  /*margin-left: 40%;*/
}
.StepProgress {
  position: relative;
  padding-left: 45px;
  list-style: none;
}
.StepProgress::before {
  display: inline-block;
  content: '';
  position: absolute;
  top: 0;
  left: 15px;
  width: 100%;
  height: 100%;
  border-left: 2px solid #CCC;
}
.StepProgress-item {
  position: relative;
  counter-increment: list;
}
.StepProgress-item:not(:last-child) {
  padding-bottom: 100px;
}
.StepProgress-item::before {
  display: inline-block;
  content: '';
  position: absolute;
  left: -30px;
  height: 100%;
  width: 100%;
}
.StepProgress-item::after {
  content: '';
  display: inline-block;
  position: absolute;
  top: 0;
  left: -42px;
  width: 24px;
  height: 24px;
  border: 2px solid #CCC;
  border-radius: 50%;
  background-color: #FFF;
}
.StepProgress-item.is-done::before {
  border-left: 2px solid green;
}
.StepProgress-item.is-done::after {
  /*content: "✔";*/
  font-size: 10px;
  color: #FFF;
  text-align: center;
  /*border: 16px solid green;*/
  background-color: green;
}
.StepProgress-item.current::before {
  border-left: 2px solid green;
}
.StepProgress-item.current::after {
  content: counter(list);
  padding-top: 1px;
  width: 19px;
  height: 18px;
  top: -4px;
  left: -40px;
  font-size: 14px;
  text-align: center;
  color: green;
  border: 2px solid green;
  background-color: white;
}
.StepProgress strong {
  display: block;
}

</style>
@stop
@section('content')
  @include('header.header')
  <!-- <div class="container" style="padding: 30px 20px 20px 20px;">

    <div class="container">
          <ul class="progressbar">
            @if($registration->application_status >= 1 )
              <li class="active">Application Filling</li>
            @else
              <li class="">Application Filling</li>
            @endif
            @if($registration->application_status >= 2 )
              <li class="active">Payment</li>
            @else
              <li class="">Payment</li>
            @endif
            @if($registration->application_status >= 3 )
              <li class="active">Document Verification</li>
            @else
              <li class="">Document Verification</li>
            @endif
            @if($registration->application_status >= 4 )
              <li class="active">ID Generation</li>
            @else
              <li class="">ID Generation</li>
            @endif
            @if($registration->application_status >= 5 )
              <li class="active">Complete</li>
            @else
              <li class="">Complete</li>
            @endif
        </ul>
      </div>
    <div class="support">For Support?  <span class="fa fa-phone" style="font-size: 17px;"></span> +91 9763996677 | 9960859069</div>

</div> -->
<div class="cust-container">
  <ul class="StepProgress">
    @if($registration->application_status >= 1 )
      <li class="StepProgress-item is-done"><strong>Application Filling</strong></li>
    @else
      <li class="StepProgress-item"><strong>Application Filling</strong></li>
    @endif
    @if($registration->application_status >= 2 )
      <li class="StepProgress-item is-done"><strong>Payment</strong></li>
    @else
      <li class="StepProgress-item"><strong>Payment</strong></li>
    @endif
    @if($registration->application_status >= 3 )
      <li class="StepProgress-item is-done"><strong>Document Verification</strong></li>
    @else
      <li class="StepProgress-item"><strong>Document Verification</strong></li>
    @endif
    @if($registration->application_status >= 4 )
      <li class="StepProgress-item is-done"><strong>ID Generation</strong></li>
    @else
      <li class="StepProgress-item"><strong>ID Generation</strong></li>
    @endif
    @if($registration->application_status >= 5 )
      <li class="StepProgress-item is-done"><strong>Complete</strong></li>
    @else
      <li class="StepProgress-item"><strong>Complete</strong></li>
    @endif
  </ul>
</div>
<div class="container support">For Support?  <span class="fa fa-phone" style="font-size: 17px;"></span> +91 8530440444</div>
  @include('footer.footer')
@stop