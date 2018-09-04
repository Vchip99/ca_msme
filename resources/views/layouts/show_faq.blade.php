@extends('layouts.master')
@section('header-title')
    <title>Online Msme Registration | FAQ</title>
@stop
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/FAQ_Style.css')}}">
  <style type="text/css">
  body{
    position: relative;
  }
  h1{
    margin-top: 50px;
    text-align: center;
    color:#003d99;
  }
  .fancy-collapse-panel .panel-heading a:hover{
      color: 2f4f4f;
  }
  .affix-top{
    background-color: #fffafa;
    padding: 30px;
    }

    .affix {
      top: 60px;
      width: 25%;
      padding: 30px;
      position: fixed;
    }
    .pills{
      padding-top:50px;
    font-size:18px;
    background-color: #fffafa;
  }
  .navbar{
    position: fixed;
  }
   @media only screen and (max-width: 992px){
    .navbar{
      position: fixed;
    }
  }
  .dropdown{
    /*position: fixed;*/
    z-index: 9990;
  }
  .dropdown li a{
        color: #104E8B  !important;
  }
  .dropdown li a:hover{
          color: #ffffff !important;
          background-color: #104E8B !important;
          font-weight: bold;
  }
</style>
@stop
@section('content')
  @include('header.header')
<div class="container-fluid small-top" id="FAQ" style="padding-top: 16px;">
    <div class="dropdown hidden-lg hidden-md" >
      <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Schemes
      <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-content">
          <li><a href="#MSME">MSME</a></li>
          <li class="divider"></li>
          <li><a href="#FAQ">Back to top  <span class="fa fa-hand-o-up"></span></a></li>
        </ul>
    </div>
    <h1>Frequently Asked Questions</h1>
    <nav class=" col-3 hidden-xs hidden-sm pills" id="myScrollSpy">
      <ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="405">
            <li><a href="#MSME">MSME</a></li>
            <li><a class="navbar-brand" href="#FAQ">Back to top  <span class="fa fa-hand-o-up"></span></a></li>
          </ul>
    </nav>

    <div class="col-9 col-m-12 col-xs-12" style="padding: 0px;">
      <div class="fancy-collapse-panel">
        <div class="category" id="MSME"><h3>MSME Registration</h3></div>
        <div class="panel-group" id="accordian7" role="tablist">
            <div class="panel panel-default" id="panel1">
                <div class="panel-heading" role="tab" id="msmecheading1">
                    <h4 class="panel-title ques">
                    <a data-toggle="collapse" data-parent="#accordian7" href="#msmecollapse1" aria-expanded="true" aria-conrols="#msmecollapse1">1. How do you get MSME Registration?</a>
                  </h4>
                </div>
                <div id="msmecollapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="#msmeheading1">
                    <div class="panel-body">Although, there is no compulsion to get MSME registration but is always advised to do so as it provides lots of benefits to the enterprises registered under MSME Act. It will save you from a lot of inconveniences later on. After assigning you the Provisional MSME Certificate and you can begin with your production and even apply for a Permanent Certificate which will add more advantages for you. Always apply for provisional registration at an initial stage of the business.
                  </div>
                </div>
            </div>
            <div class="panel panel-default" id="panel2">
                <div class="panel-heading" role="tab" id="msmecheading2">
                    <h4 class="panel-title ques">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordian7" href="#msmecollapse2" aria-expanded="false" aria-conrols="#msmecollapse2">2.Is MSME Registration voluntary or mandatory?</a>
                  </h4>
                </div>
                <div id="msmecollapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="#msmeheading2">
                    <div class="panel-body">As said above, SSI/MSME registration is totally voluntary. Businessmen and entrepreneurs usually get this done to utilise the advantages offered under it. The registration process is quite easy and simple. You can easily avail it (provided you have a manufacturing plant or a commercial space where you render services), many businesses opt for it over other registrations.
                  </div>
                </div>
            </div>
            <div class="panel panel-default" id="panel3">
                <div class="panel-heading" role="tab" id="msmecheading3">
                    <h4 class="panel-title ques">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordian7" href="#msmecollapse3" aria-expanded="false" aria-conrols="#msmecollapse3">3. What benefits are given to MSME by state and central government?</a>
                  </h4>
                </div>
                <div id="msmecollapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="#msmeheading3">
                    <div class="panel-body">Many state government prefers enterprises which are registered under MSMED Act. Subsidy such as on power, taxes, and much more is offered by state governments. In most of the states, sales tax exemption is provided purchase preferences is given on goods produced. The enterprise may also relish excise exemption scheme and exemption from certain direct taxes in the initial years of your business.
                  </div>
                </div>
            </div>
            <div class="panel panel-default" id="panel4">
                <div class="panel-heading" role="tab" id="msmecheading4">
                    <h4 class="panel-title ques">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordian7" href="#msmecollapse4" aria-expanded="false" aria-conrols="#msmecollapse4">4. For how long is an MSME Provisional Registration Certificate(PRC) valid?</a>
                  </h4>
                </div>
                <div id="msmecollapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="#msmeheading4">
                    <div class="panel-body">The validation of a PRC is for 5 years and if the unit is still not under operational then you may still re-apply for it. As soon as you start with your operations, you can easily apply for the Permanent License.
                  </div>
                </div>
            </div>
            <div class="panel panel-default" id="panel5">
                <div class="panel-heading" role="tab" id="msmecheading5">
                    <h4 class="panel-title ques">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordian7" href="#msmecollapse5" aria-expanded="false" aria-conrols="#msmecollapse5">5. Why should I apply before commencing operations?</a>
                  </h4>
                </div>
                <div id="msmecollapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="#msmeheading5">
                    <div class="panel-body">It is advisable to get a Provisional MSME Registration Certificate (PRC) before starting your operation in your enterprise. The PRC will work smoothly for you and will help you out with particular NOCs and clearances from regulatory bodies.
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
  @include('footer.footer')
@stop