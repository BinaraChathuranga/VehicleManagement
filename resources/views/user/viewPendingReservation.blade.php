
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
          <h1 class="m-0 text-dark">Reservation Details</h1><hr>
          
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
                    
                    <div class="card card-danger border-danger card-outline mt-2" style=" border-width:3px; border-bottom:none; border-top: none; border-right: none;">
                  
                      <div class="card-body box-profile">
                        
               <div class="row">
                <h6 style="color: gray;" class="mt-3">  &nbsp; &nbsp; Vehicle Details</h6>
               </div>
               
               <div class="row">
             
                <div class="col-12 col-lg-4">      
                  <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Make</span>
                        </div>
                        <input type="text" name="make"  value="{{$penRes->makeAndtype}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                  </div>   
                  
                  <div class=" input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Vehicle No.</span>
                    </div>
                    <input type="text" name="vehicleNo"  value="{{$penRes->regNo}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
              </div> 

                  <div class=" input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Type</span>
                    </div>
                    <input type="text" name="type"  value="{{$penRes->type}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                  </div>

                  <div class=" input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Passengers</span>
                    </div>
                    <input type="text" name="passengers"  value="{{$penRes->passengers}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                  </div>

                  <div class=" input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Pay Load</span>
                    </div>
                    <input type="text" name="payLoad" value="{{$penRes->payLoad}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                  </div>
                </div>

                <div class="col-12 col-lg-4">
                   
                          <div class="text-center">
                             <img class="profile-user-img img-fluid img-square" 
                               src="{{asset('/img/'. $penRes->image)}}" style="width:450px; height:220px;"
                               alt="User profile picture" >
                           </div> 
                           <br>
                </div>           
              
               </div>
               
               </div>
             
               </div> 
             
               

               <div class="card card-danger border-danger card-outline mt-2" style=" border-width:3px; border-bottom:none; border-top: none; border-right: none;">
                <div class="card-body box-profile">
               <div class="row">
                <h6 style="color: gray;" class="mt-2">  &nbsp; &nbsp; Reciever Details</h6>
               </div>
               <div class="row">
                
                <div class="col-12 col-lg-4">    

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:100px;" id="inputGroup-sizing-sm">Name</span>
                      </div>
                      <input type="text" name="name"  value="{{$penRes->name}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:100px;" id="inputGroup-sizing-sm">Branch</span>
                      </div>
                      <input type="text" name="branch"  value="{{$penRes->branch}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>

                    <div class=" input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:100px;" id="inputGroup-sizing-sm">Position</span>
                      </div>
                      <input type="text" name="position"  value="{{$penRes->position}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>
      
      
                  
                </div>

                <div class="col-12 col-lg-4">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-square" 
                      src="{{asset($penRes->avatar)}}" style="width:450px; height:220px;"
                      alt="User profile picture" >
                  </div> 
                  <br>
              </div>
                </div>
               </div>
              </div>

               <div class="card card-danger border-danger card-outline mt-2" style=" border-width:3px; border-bottom:none; border-top: none; border-right: none;">
                <div class="card-body box-profile">
               <div class="row">
                <h6 style="color: gray;" class="mt-2">  &nbsp; &nbsp; Reservation Details</h6>
               </div>
               <div class="row">
               <div class="col-12 col-lg-4">

                     <div class="input-group input-group-sm mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" style="width:140px;">Destination From</span>
                       </div>
                       <input type="text" name="from" class="form-control" value="{{$penRes->ResFrom}}" style="width:250px;"  >
                     </div>
                      
                     <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;">Destination To</span>
                      </div>
                      <input type="text" name="from" class="form-control" value="{{$penRes->ResTo}}" style="width:250px;"  >
                    </div>
 
                     <div class="input-group input-group-sm mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" style="width:140px;">Reserve Date</span>
                       </div>
                       <input type="date" name="resDate"  class="form-control" value="{{$penRes->reserveDate}}" style="width:250px;">

                       </div>
               </div> 
               <div class="col-12 col-lg-4">

                       <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;">No. of Passengers</span>
                        </div>
                        <input type="text" name="resDate"  class="form-control" value="{{$penRes->passengers}}" style="width:250px;">
 
                        </div>
         
                     <div class="input-group input-group-sm mb-3">
                         <div class="input-group-prepend">
                           <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">End Date</span>
                         </div>
                         <input type="text"  name="duration" class="form-control" value="{{$penRes->endDate}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px;" >
                       </div>
                       
         
                     <div class="input-group input-group-default mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Reason</span>
                       </div>
                       <textarea type="text" name="reason" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px;">{{$penRes->reason}}</textarea>
                     </div>
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
