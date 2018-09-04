<nav class="navbar navbar-fixed-top mainnav">
  <div class="row" id="msmeImg" style="padding-top: 11px; padding-bottom: 11px;background-color: #9f1d35;">
    <div align="left">
      <img id="leftLogo" src="{{asset('images/msme_logo.png')}}" style="height: 100px; width: auto; margin-left: 10px; margin-right: 10px; float: left;">
    </div>
    <div align="center">
      <img id="centerLogo" src="{{asset('images/right_matter.png')}}" style="height: 100px; width: auto; margin-left: 10px; margin-right: 10px; align-self: center;">
      <img id="rightLogo" src="{{asset('images/msme_logo.png')}}" style="height: 100px; width: auto; margin-left: 10px; margin-right: 10px; float: right;">
    </div>
    </div>
  </div>
  <!-- <div style="margin-top: 13px;float:  left; margin-bottom: 10px;">
    <a class="" href="{{ url('registration')}}" style="color: #ffff !important;"><img src="{{asset('images/zxc.png')}}" style="height: 73px; width: 200px;margin-left: 30px;"></a>
  </div> -->
  <div class="navbar-header pull-right" style="">
    <div class="pull-right dropdown" style="padding-top: 10px;padding-right: 7px;margin-left: -10px;margin-right: 20px;" >
      @if(Auth::user())
        <a href="#" class="dropdown-toggle pull-right user_menu" data-toggle="dropdown" role="button" aria-expanded="false" title="User">
            <img src="{{ asset('images/login.png') }}" id="currentUserImage" class="img-circle user-profile" alt="user name" aria-haspopup="true"   aria-expanded="true"/>&nbsp;
        </a>
        <ul class="dropdown-menu user-dropdown "  style="">
          <div class="navbar-content" style="">
              <li><a href="{{ url('dashboard') }}" data-toggle="tooltip" title="Dashboard" target="_blank"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a>
              <li><a href="{{ url('logout') }}" data-toggle="tooltip" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
          </div>
        </ul>
      @else
        <a href="#" class="dropdown-toggle pull-right user_menu" data-toggle="dropdown" role="button" aria-expanded="false" title="User"><img src="{{ asset('images/user.png') }}" class="img-circle user-profile" alt="user name" aria-haspopup="true" aria-expanded="true"/>
        </a>
        <ul class="dropdown-menu" role="menu" style="background-color: white;">
          <div class="navbar-content">
              <li>
                <a href="{{ url('login')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> Login</a>
              </li>
          </div>
        </ul>
      @endif
    </div>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color: #9f1d35;">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <!-- <a class="navbar-brand pull-left" href="/"><img src="{{ asset('images/icons/cc.png')}}" width="50px" height="30px"></a> -->
  </div>
  <div class="collapse navbar-collapse " id="myNavbar" style="background-color: #ffffff;">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{ url('registration')}}">MSME Registration</a></li>
      <li><a href="{{ url('track-order') }}">Track Registration</a></li>
      <li><a href="{{ url('faq')}}">FAQ</a></li>
      <li><a href="{{ url('contact-us')}}">Contact us</a></li>
      <li><a href="{{ asset('Sample-MSME-Certificate.pdf')}}" download>View Sample Certificate</a></li>
      <li>&nbsp;&nbsp;</li>
    </ul>
  </div>
</nav>
  <div class="row" style="background-color: #9f1d35; margin-top: 173px;">
    <div class="form-group">
      <form method="POST" action="{{ url('enquiry') }}">
        {{ csrf_field() }}
        <div class="col-sm-12 col-m-3 col-3 enq-title center-align" >Enquiry</div>
          <div class="col-xs-12 col-sm-6 col-m-2 col-2" style="padding-left: 30px;">
            <input class="form-control" type="text" name="name" placeholder="Name" required>
          </div>
          <div class="col-xs-12 col-sm-6 col-m-2 col-2" style="padding-left: 30px;">
            <input class="form-control" type="email" name="email" placeholder="Email" required>
          </div>
          <div class="col-xs-12 col-sm-6 col-m-2 col-2" style="padding-left: 30px;">
            <input class="form-control" type="phone" name="mobile" placeholder="Mobile" required>
          </div>
          <div class="col-xs-12 col-sm-6 col-m-3 col-3" style="padding-left: 30px;">
            <input type="submit" class="form-control btn btn-primary" name="Send">
          </div>
      </form>
    </div>
  </div>
  <div class="row setp-bg" >
    <div class="">
        <!-- <div class="col-m-12 col-4 center-align"><strong> 3 Steps to register MSME </strong></div> -->
        <div class="" style="padding-bottom: 0px !important; ">
          <marquee><strong>Online Portal for Registration of Micro, Small & Medium Enterprises and for small scale industiries. (Certificate will be Valid for Lifetime)”</strong></marquee>
        </div>
    </div>
  </div>
