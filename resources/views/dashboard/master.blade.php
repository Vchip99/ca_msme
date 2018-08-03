<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="SHORTCUT ICON" href="{{ asset('images/logo/vedu.png') }}"/>
  <title>Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('css/homestyle.css')}}">

  <link href="{{ asset('css/sidemenu/sidemenu_layout.css?ver=1.0')}}" rel="stylesheet"/>
  <link href="{{ asset('css/sidemenu/_all-skins.css?ver=1.0')}}" rel="stylesheet"/>
  <link href="{{ asset('css/dashboard.css?ver=1.0')}}" rel="stylesheet"/>

  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  </script>
  <style type="text/css">
  .admin_table{
    padding-top: 10px;
    background-color: #01bafd;
  }
  .admin_div{
    padding: 10px;
    background-color: #01bafd;
  }
  .btn-primary {
    background-color: #3c8dbc;
    border-color: #367fa9;
  }
  </style>
  <style type="text/css">
        .input-panel{
            /*margin-top: 40px;*/
            box-shadow: 0px 0px 15px #a8a8a8;
            padding: 5px 20px;
        }
        .results-panel{
            padding: 20px 20px;
            margin-top: 10px;
            box-shadow: 0px 0px 15px #a8a8a8;
        }
        .list-bar{
            padding: 10px 10px;
            background-color: #003d99;
            color: white;
            font-size: 17px;
        }
        table{
            margin-top: 20px;
            border:1px solid #abb2b9;
        }
        th,td{
            padding: 5px 5px;
            width:9%;
        }
        td:hover{
            cursor: pointer;
        }
        .btn{
            font-size: 15px;
        }
        span{
            font-size: 17px;
            color: #fff;
        }
        .rmv{
           color: #fff;
           font-size: 13px;
        }
        .btn-close{
            width: 25px;
            height: 25px;
            padding: 3px 1px;
            background-color: #ff0000;
        }
        .btn-close:hover{
            background-color: #ff0000;
            opacity: 0.8;
        }
        .heading{
            margin-top: 60px;
            font-size: 25px;
            color: #003d99;
        }

        .add-on .input-group-btn > .btn {
            left:-2px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }
        .add-on .form-control:focus {
            box-shadow:none;
           -webkit-box-shadow:none;
            border-color:#cccccc;
        }
    </style>
  @yield('dashboard_header')
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">
  <header class="main-header">
    <a href="{{ url('/')}}" class="logo">
      <span class="logo-mini"><b> Vchip</b></span>
      <span class="logo-lg"><b>Vchip</b>Technology</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <a>
            <img src="{{ url('images/login.png')}}" id="dashboardUserImage" class="img-circle" alt="User Image">
          </a>
        </div>
        <div class="pull-left info">
          <p><a>{{ ucfirst(Auth::user()->name)}}</a></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
          <input type="hidden" name="user_id" id="user_id" value="{{ (is_object(Auth::user()))?Auth::user()->id: NULL }}"/>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">Vchip Technology</li>
        <li class="treeview">
          <a href="#" title="Billing">
            <i class="fa fa-inr"></i> <span>Billing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li title="Show Billing"><a href="{{ url('dashboard')}}"><i class="fa fa-circle-o"></i> Billing </a></li>
          </ul>
        </li>
        <li class="header">LABELS</li>
        <li>
          <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout </span>
            <span class="pull-right-container"></span>
          </a>
          <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    @yield('module_title')
    <section class="v-container">
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            @yield('dashboard_content')
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
        setTimeout(function() {
          $('.alert-success').fadeOut('fast');
        }, 10000); // <-- time in milliseconds
    });

</script>

</body>
</html>
