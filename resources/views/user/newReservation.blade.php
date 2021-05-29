
@extends('layouts.user')

@section('content')
<link rel="stylesheet" href="{{asset('js/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

<style>
  .zoom {
      
      transition: transform .2s; /* Animation */
     
  }
  
  .zoom:hover {
      transform: scale(2.10); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
      background-color: gray;
  }
  </style>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-4">
          <h1 class="m-0 text-dark">Reserve Vehicle</h1><hr>
          
        </div><!-- /.col -->




        <!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
 
  <!-- /.content-header -->

  <!-- Main content -->

  

    <section class="content">
        <div class="container-fluid">

          
            <div class="card">
              <center>
                <div class="card-body">
                  <form action="/user/reserve" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
               <div class="row">
                   <div class="col-12 col-lg-5" >
                       
                   <div class="card card-primary border-primary card-outline mt-2" style=" border-width:3px; border-bottom:none; border-top:none;">
                    <h6 style="color: gray;" class="mt-2">  &nbsp; &nbsp; Vehicle Details</h6>
                          <div class="card-body box-profile">
        
                          <div class="text-center">
                             <img class="profile-user-img img-fluid img-square" 
                               src="{{asset('/img/'. $dvInfo->image)}}" style="width:450px; height:220px;"
                               alt="User profile picture" >
                           </div> 
                           <br>
                     <input type="text" hidden name="image" value="{{$dvInfo->image}}">
                     <input type="text" hidden name="email" value="{{Auth::user()->email}}">   
                     <input type="text" hidden name="name" value="{{Auth::user()->name}}">     
                      
                    <div class=" input-group input-group-sm mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Make</span>
                          </div>
                          <input type="text" name="make"  value="{{$dvInfo->makeAndtype}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>   
                    
                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Vehicle No.</span>
                      </div>
                      <input type="text" name="vehicleNo"  value="{{$dvInfo->regNo}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                </div> 

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Type</span>
                      </div>
                      <input type="text" name="type"  value="{{$dvInfo->type}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Passengers</span>
                      </div>
                      <input type="text" name="passengers"  value="{{$dvInfo->passengers}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Pay Load</span>
                      </div>
                      <input type="text" name="payLoad" value="{{$dvInfo->payLoad}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>

                   
        
        
              </div>
                </div>
               </div>

               <div class="col-12 col-lg-7">

                <div class="card card-danger border-danger card-outline mt-2" style=" border-width:3px; border-bottom:none; border-top: none;">
                 <h6 style="color: gray;" class="mt-2">  &nbsp; &nbsp; Reservation Details</h6>
                  <div class="card-body box-profile">

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Name</span>
                      </div>
                      <input type="text" name="name"  value="{{Auth::user()->name}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Zone</span>
                      </div>
                      <input type="text" name="zone" value="{{Auth::user()->zone}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Branch</span>
                      </div>
                      <input type="text" name="branch"  value="{{Auth::user()->branch}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Position</span>
                      </div>
                      <input type="text" name="position"  value="{{Auth::user()->position}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>
      
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;">Destination From</span>
                      </div>
                      <input type="text" name="from" class="form-control" style="width:250px;"  >
                      <div class="input-group-prepend">
                          <span class="input-group-text">To</span>
                        </div>
                      <input type="text" name="to"  class="form-control" style="width:250px;">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;">Reserve Date</span>
                      </div>
                      <input type="date" name="resDate"  class="form-control" style="width:250px;"  >
                      <div class="input-group-prepend">
                          <span class="input-group-text">No. of Passengers</span>
                        </div>
                      <input type="text" name="ResPassengers" class="form-control" style="width:250px;">
                      </div>
        
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Duration</span>
                        </div>
                        <input type="text"  name="duration" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px;" >
                      </div>
                      
        
                    <div class="input-group input-group-default mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Reason</span>
                      </div>
                      <textarea type="text" name="reason" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px;"></textarea>
                    </div>

                    <button class="btn btn-primary float-right mt-3 btn-block" type="submit"><b>Reserve</b></button>
      
                  </div>
                </div>
                    
                
               </div>
               </div>
                  </form>
                </div>
              </center>
            </div>
          

        
         </div>
    </section>

  
   <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
   <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

   <script>
  
  $(document).ready(function(){
      var table=$('#vehicle').DataTable();    
      
} );   
            
       
   </script>
@endsection
