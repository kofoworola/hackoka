<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hackoak | {{ $hospital->name}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="ionicon/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/css/adminlte.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/css/skin-blue.min.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
  .alert{
    margin:0 10px;
  }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F</b>LA</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{$hospital->name}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="https://randomuser.me/api/portraits/thumb/men/83.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="https://randomuser.me/api/portraits/thumb/men/83.jpg" class="img-circle" alt="User Image">
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="https://randomuser.me/api/portraits/thumb/men/83.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ $hospital->name}}</p>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active treeview">
          <a href="{{ route('admin.doctors',['domain' => $hospital->slug])}}">
            <i class="fa fa-dashboard"></i> <span>Doctors</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route('admin.doctors',['domain' => $hospital->slug])}}"><i class="fa fa-circle-o"></i> All Doctors</a></li>
            <li><a href="{{ route('admin.add_doctor',['domain'=>$hospital->slug])}}"><i class="fa fa-circle-o"></i>Add Doctor</a></li>
          </ul>
        </li>
        <li class="active treeview">
          <a href="{{ route('admin.patients',['domain' => $hospital->slug])}}">
            <i class="fa fa-dashboard"></i> <span>Patients</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route('admin.patients',['domain' => $hospital->slug])}}"><i class="fa fa-circle-o"></i> All Patients</a></li>
            <li><a href="{{ route('admin.add_patient',['domain'=>$hospital->slug])}}"><i class="fa fa-circle-o"></i>Add Patient</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-dashcube"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2017-2018 KOFO.</strong> All rights
    reserved.
  </footer>
  <div>

<!-- ./wrapper -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="/js/adminlte.min.js"></script>
@yield('scripts')
</body>
</html>
