
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

<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
      <div class="row">
          <table>
              <tr>
                  <th>&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;</th>
                  <th style="text-align: center;"><img src="{{asset('img/nlogo.png')}}" width="30" height="35" class=" ml-5" alt="" loading="lazy"></th> 
                  <th style="color: white;"> &nbsp; Vehicle Management System - Department of Education - Central Province</th>
                  <th style="text-align: center;"><img src="{{asset('img/flag.jpg')}}" width="60" height="35" class=" ml-2" alt="" loading="lazy"></th> 
                  
                  
                  
                  <th style="color: white"> &nbsp;  </th>
                  <th>&emsp; &emsp; &emsp; &emsp;  &emsp; &emsp;</th>
                  <th><div class="image">
                      <img src="{{asset(Auth::user()->avatar)}}" class="img-circle elevation-2" style="width:30px; height:30px;" alt="User Image">
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

<body style="background-image: url(/img/vehicle2.jpg);">
<div class="col-4 offset-4 mt-5">
<div class="card">
  <div class="card-body">
 
            @if(session('status'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 400px;">
                {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            
            <div class="alert alert-danger mt-3" role="alert" style="width: 385px; text-align: center;">
            You are a Inactive User
            
           

  <hr>
  </div>
</div>
</div>
</body>









  
  



  
     
    
    
    
   







<script src="{{asset('jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

