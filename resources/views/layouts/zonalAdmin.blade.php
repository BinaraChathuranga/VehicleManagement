<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="/img/favicon.png">
        <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vehicle Mangement System</title>

        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/zonalAdmin" class="nav-link">Home |</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="/zonalAdmin/reportsVehicles" class="nav-link">Reports |</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
        
      </li>
    </ul>

    <!-- SEARCH FORM -->
   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
      
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      
      <span class="brand-text font-weight-light"></span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/img/'.Auth::user()->avatar)}}" class="img-circle elevation-2" alt="User Image" style="width: 40px; height:40px;">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
            

          <li class="nav-item">
            <a href="/zonalAdmin" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Registered Users
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('zonalAdmin.driverDetails.index')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Driver Details
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('zonalAdmin.vehicleDetails.index')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Vehicle Details
               
              </p>
              
            </a>
          </li>

          <li class="nav-item">
            <a href="/zonalAdmin/runningChartVehicles" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Running Chart 
              </p>
              
            </a>
          </li>

          <li class="nav-item">
            <a href="/zonalAdmin/serviceVehicles" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
              <p>
                Vehicle Service
              </p>
              <span class="badge badge-pill badge-danger">{{App\vehiclePart::whereColumn('currentMileage','>','remindMileage')->where('zone','=',Auth::user()->zone)->distinct()->count('vNo')}}</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="/zonalAdmin/repair" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Repair Vehicles
               
              </p>
              <span class="badge badge-pill badge-danger"></span>
            </a>
          </li>


          <li class="nav-item">
            <a href="/zonalAdmin/newUserReservation" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                New Reservation
               
              </p>
              <span class="badge badge-pill badge-danger"></span>
            </a>
          </li>

          <li class="nav-item">
            <a href="/zonalAdmin/viewUserReservations" class="nav-link" >
            
              <?php
               $current = Carbon\Carbon::now();
               // add 7 days to the current time
               $week = $current->addDays(7);
              ?>

              <p>
                Approved Reservations
              </p>
              <span class="badge badge-pill badge-warning">{{App\reservation::where('reserveDate','<=',$week)->where('resStatus','=','Approved')->where('zone','=',Auth::user()->zone)->count()}}</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="/zonalAdmin/viewPendingUserReservations" class="nav-link">
              
              <p>
                Pending Reservations
               
              </p>
              <span class="badge badge-pill badge-danger">{{App\reservation::where('resStatus','=','Pending')->where('zone','=',Auth::user()->zone)->count()}}</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="/zonalAdmin/viewUserConfirmedReservations" class="nav-link">
            
              <p>
                Confirmed Reservations
               
              </p>
              <span class="badge badge-pill badge-primary">{{App\reservation::where('resStatus','=','Confirmed')->where('zone','=',Auth::user()->zone)->count()}}</span>
            </a>
            
          </li>

          

          <li class="nav-item">
            <a href="/zonalAdmin/viewUserCompletedReservations" class="nav-link">
            
              <p>
                Completed Reservations
               
              </p>
              <span class="badge badge-pill badge-success">{{App\reservation::where('resStatus','=','Completed')->where('zone','=',Auth::user()->zone)->count()}}</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="/zonalAdmin/viewUserCancelledReservations" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Cancelled Reservations
               
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/zonalAdmin/viewAllReservations" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                All Reservation Details
               
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/zonalAdmin/fuelConsumptionVehicles" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Fuel Consumption
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/zonalAdmin/reportsVehicles" class="nav-link">
                  
                  <p>Vehicle Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/zonalAdmin/driverDetailsReport" class="nav-link">
                  
                  <p>Driver Reports</p>
                </a>
              </li>
            </ul>
          </li>

            
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                     <i class="nav-icon far fa-circle text-danger"></i>
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
            
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <b>Department of Education - Central Province</b> .</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
</body>
</html>
