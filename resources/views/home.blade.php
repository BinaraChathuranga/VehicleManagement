<link rel="icon" type="image/png" href="/img/favicon.png">
<title>Vehicle Mangement System</title>
        <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

        <style>
            .zoom {
                
                transition: transform .2s; /* Animation */
               
            }
            
            .zoom:hover {
                transform: scale(1.05); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
            }
            </style>

<?php
$uInfo=App\User::where('email','=',Auth::user()->email)->first();
?>

<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
      <div class="row">
          <table>
              <tr>
                  <th>&emsp;</th>
                  <th><a href="/director/regUsers" style="color: white;"> Home</a></th>
                  <th> &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;</th>
                  <th style="text-align: center;"><img src="{{asset('img/nlogo.png')}}" width="30" height="35" class=" ml-5" alt="" loading="lazy"></th> 
                  <th style="color: white;"> &nbsp; Vehicle Management System - Department of Education - Central Province</th>
                  <th style="text-align: center;"><img src="{{asset('img/flag.jpg')}}" width="60" height="35" class=" ml-2" alt="" loading="lazy"></th> 
                  
                  
                  
                  <th style="color: white"> &nbsp;  </th>
                  <th>&emsp; &emsp; &emsp; &emsp;  &emsp; &emsp;</th>
                  <th><div class="image">
                      <img src="{{asset('/img/'.$uInfo->avatar)}}" class="img-circle elevation-2" style="width:30px; height:30px;" alt="User Image">
                      <th> &nbsp;</th>
                      </div>
                  </th>
                  <th style="color: white;"> <a href="#" data-toggle="modal" style="color: white;" data-target="#profile">{{Auth::user()->name}}</a> </th>
                  <th>&emsp; &emsp;</th>

                  <th>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                        
                                    
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    
                                
                            
                        @endguest
                    </ul></th>
              </tr>
          </table>
       
      </div>
   
  </a>
</nav>

<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/dirEditProfile/{{Auth::user()->id}}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
             <div class="text-center">
              
               <img class="profile-user-img img-fluid img-circle"
                 src="{{asset('/img/'.$uInfo->avatar)}}" style="width: 100px; height:100px;"
                 alt="User profile picture">
             </div>
            <br>
             <div class="text-right">
                 <input type="file" name="Eavatar">
                </div>
                <hr>   
      
          <h3  class="profile-username text-center">{{Auth::user()->name}}</h3>
          <p class="text-muted text-center">{{Auth::user()->email}}</p>
      
          <button type="submit" class="btn btn-primary btn-block">Edit Profile</button>
          
        </div>
      </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


   

<body style="background-image: url(/img/vehicle2.jpg);">
  


<table class="mt-2">
  <tr>
    <td>
      <div class="card border-warning zoom" style="width: 14rem; height:16rem; margin-left:100px; border-width:5px; ">
        <a href="/director/reserveVehicle" class="text-decoration-none">
      <img src="{{asset('img/reserve.png')}}" class="card-img-top" alt="..." style="height:140px; background-color: #cecece;" >
    
      <div class="card-body">
        <h5 class="card-title" style="color: black;" >Reserve Vehicle</h5>
        <p class="card-text">Click here to Reserve a Vehicle.</p>
        
      </div>
       </a>
      </div>
    </td>

    <td>
      <div class="card border-primary zoom" style="width: 14rem; height:16rem; margin-left:80px; border-width:5px;">
        <a href="/director/driverDetails" class="text-decoration-none">
      <img src="{{asset('img/driver.png')}}" class="card-img-top" alt="..." style="height:140px; background-color: #cecece;">
    
      <div class="card-body">
        <h5 class="card-title" style="color: black;" >Driver Information</h5>
        <p class="card-text">Click here to See Driver Information</p>
        
      </div>
       </a>
      </div>
    </td>

    <td>
      <div class="card border-success zoom" style="width: 14rem; height:16rem;  margin-left:80px; border-width:5px;" >
        <a href="/director/fuelConsumptionVehicles" class="text-decoration-none">
      <img src="{{asset('img/fuel.png')}}" class="card-img-top" alt="..." style="height:140px; background-color: #cecece;" >
    
      <div class="card-body">
        <h5 class="card-title" style="color: black;" >Fuel Information</h5>
        <p class="card-text">Click here to See Fuel Information</p>
        
      </div>
       </a>
      </div>
    </td>

    <td>
      <div class="card border-danger zoom" style="width: 14rem; height:16rem; margin-left:80px; border-width:5px; ">
        <a href="/director/vehicleDetails" class="text-decoration-none">
      <img src="{{asset('img/vehicleInfo.png')}}" class="card-img-top" alt="..." style="height:140px; background-color: #cecece;">
    
      <div class="card-body">
        <h5 class="card-title" style="color: black;" >Vehicle Information</h5>
        <p class="card-text">Click here see Vehicle Information.</p>
        
      </div>
       </a>
      </div>
    </td>

  </tr>

  <tr>
    <td style="color: white;"><br></td>
  </tr>

  <tr>
  <td>
      <div class="card border-success zoom" style="width: 14rem; height:16rem;  margin-left:100px; border-width:5px;">
        <a href="/reserve" class="text-decoration-none">
      <img src="{{asset('img/vehicle1.png')}}" class="card-img-top" alt="..." style="height:140px; background-color: #cecece;">
    
      <div class="card-body">
        <h5 class="card-title" style="color: black;" >Vehicle Location</h5>
        <p class="card-text">Click here to See Vehicle Location</p>
        
      </div>
       </a>
      </div>
    </td>
    

    <td>
      <div class="card border-dark zoom" style="width: 14rem; height:16rem; margin-left:80px; border-width:5px;">
        <a href="/director/reportsVehicles" class="text-decoration-none">
      <img src="{{asset('img/reports.png')}}" class="card-img-top" alt="..." style="height:140px; background-color: #cecece;">
    
      <div class="card-body">
        <h5 class="card-title" style="color: black;" >Reports</h5>
        <p class="card-text">Click here to generate Reports</p>
        
      </div>
       </a>
      </div>
    </td>

    <td>
      <div class="card border-warning zoom" style="width: 14rem; height:16rem;  margin-left:80px; border-width:5px">
        <a href="/director/serviceDetailsVehicles" class="text-decoration-none">
      <img src="{{asset('img/repair.png')}}" class="card-img-top" alt="..." style="height:140px; background-color: #cecece;">
    
      <div class="card-body">
        <h5 class="card-title" style="color: black;" >Repairs & Services</h5>
        <p class="card-text">Click here to See Repairs & Services of vehicle</p>
        
      </div>
       </a>
      </div>
    </td>

    <td>
      <div class="card border-secondary zoom" style="width: 14rem; height:16rem;  margin-left:80px; border-width:5px">
        <a href="/director/runningChartVehicles" class="text-decoration-none">
      <img src="{{asset('img/service.png')}}" class="card-img-top" alt="..." style="height:140px; background-color: #cecece;">
    
      <div class="card-body">
        <h5 class="card-title" style="color: black;" >Runing Chart</h5>
        <p class="card-text">Click here to See Vehicle Runing Chart</p>
        
      </div>
       </a>
      </div>
    </td>
  </tr>
</table>

</body>



<nav class="navbar navbar-dark bg-dark mt-2" style="height:36px;">
 
    <strong style="color: gray;">Copyright © Department of Education - Central Province 2020</strong>

</nav>





  
  



  
     
    
    
    
   







<script src="{{asset('jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

