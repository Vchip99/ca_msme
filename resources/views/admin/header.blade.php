<nav class="navbar navbar-default navbar-fixed-top mainnav" style="">
  <div class="navbar-header">
    <div>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <a class="navbar-brand" href="{{ url('admin/home')}}">MSME</a>
  </div>
  @php
    $loginUser = Auth::guard('admin')->user();
  @endphp
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{ url('admin/home') }}">All Registration</a></li>
      @if(0 == $loginUser->is_subadmin)
      <li><a href="{{ url('admin/sub-admin') }}">Sub Admin</a></li>
      <li><a href="{{ url('admin/all-payments')}}">All Payments</a></li>
      @endif
      @if(0 == $loginUser->is_subadmin)
        <li><a href="{{ url('admin/update-admin') }}" data-toggle="tooltip" title="Update Password"><i class="fa fa-user" aria-hidden="true"></i>Password</a>
      @endif
      <li><a data-toggle="tooltip" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        </li>
      <!-- <li>
        <a href="#" class="dropdown-toggle pull-right user_menu" data-toggle="dropdown" role="button" aria-expanded="false" title="User">
            <img src="{{ asset('images/login.png') }}" id="currentUserImage" class="img-circle user-profile" alt="user name" aria-haspopup="true"   aria-expanded="true"/>&nbsp;
        </a>
        <ul class="dropdown-menu user-dropdown ">
          <div class="navbar-content">
            @if(0 == $loginUser->is_subadmin)
              <li><a href="{{ url('admin/update-admin') }}" data-toggle="tooltip" title="Update Password" target="_blank"><i class="fa fa-user" aria-hidden="true"></i>Password</a>
            @endif
              <li><a data-toggle="tooltip" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
              <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
              </li>
          </div>
        </ul>
      </li> -->
      <li>&nbsp;&nbsp;</li>
    </ul>
  </div>
</nav>