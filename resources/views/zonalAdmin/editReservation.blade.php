
@extends('layouts.zonalAdmin')

@section('content')
<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>


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
<br>
 
  <!-- /.content-header -->

  <!-- Main content -->

  

    <section class="content">
        <div class="container-fluid">
          <div class="card">
            <button type="button" class="btn btn-primary mt-3 ml-3" data-toggle="modal" data-target="#cal" style="width: 100px;">Reserve</button>
          <center>
            
          <div class="col-12 col-lg-8">
            <div class="card mt-5">
              <?php
          $resDate=App\reservation::where('id','=',$resId)->first();
          ?>
          <div class="alert alert-success" role="alert" style="text-align: right;">
            Requested Reserve Date is From <b>{{$resDate->reserveDate}}</b> To <b>{{$resDate->endDate}}</b>
          </div>
              
                <div class="card-body">
                  
  <?php
  $reservations = App\reservation::where('vehicleNo','=',$vehicle->regNo)->get();
  $reservation =[];
   foreach($reservations as $row)
   {
       if($row->resStatus == 'Confirmed'){
           $reservation[] = MaddHatter\LaravelFullcalendar\Facades\Calendar::event(
     
               $row->resStatus,
               true,
               new \DateTime($row->reserveDate),
               new \DateTime($row->endDate),
               $row->id,
               [ 
                 'color' => '#1931ff',
               ]             
            ); 
           }

           elseif($row->resStatus == 'Completed'){
               $reservation[] = MaddHatter\LaravelFullcalendar\Facades\Calendar::event(
         
                   $row->resStatus,
                   true,
                   new \DateTime($row->reserveDate),
                   new \DateTime($row->endDate),
                   $row->id,
                   [ 
                   'color' => '#298000',
                   ]             
                ); 
               }
       
       }
         
       $calendar=MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($reservation);
  ?>

             <div class="calendar">
             <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
   
                        {!! $calendar->calendar() !!}
                        {!! $calendar->script() !!}
             </div>
                </div>
              
            </div>
          </div>
        </center>
      </div>

      <!-- reserve modal -->

      <form action="/zonalAdmin/editedReserve/{{$resId}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
      <div class="modal fade" id="cal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Reserve Vehicle</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
              <div class="card">
                <center>
                  <div class="card-body">
                    
                 <div class="row">
                     <div class="col-12 col-lg-5" >
                         
                     <div class="card card-primary border-primary card-outline mt-2" style=" border-width:3px; border-bottom:none; border-top:none;">
                      <h6 style="color: gray;" class="mt-2">  &nbsp; &nbsp; Vehicle Details</h6>
                            <div class="card-body box-profile">
          
                            <div class="text-center">
                               <img class="profile-user-img img-fluid img-square" 
                                 src="{{asset('/img/'. $vehicle->image)}}" style="width:450px; height:220px;"
                                 alt="User profile picture" >
                             </div> 
                             <br>
                       <input type="text" hidden name="image" value="{{$vehicle->image}}">
        
                        
                     
                      
                      <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Vehicle No.</span>
                        </div>
                        <input type="text" name="vehicleNo"  value="{{$vehicle->regNo}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                  </div> 

                  <div class=" input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Driver</span>
                    </div>
                    <input type="text" name="driver"  value="{{$vehicle->vehDriver}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
              </div>   
  
                      <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Type</span>
                        </div>
                        <input type="text" name="type"  value="{{$vehicle->type}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                      </div>
  
                      <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Passengers</span>
                        </div>
                        <input type="text" name="passengers"  value="{{$vehicle->passengers}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                      </div>
  
                      <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Pay Load</span>
                        </div>
                        <input type="text" name="payLoad" value="{{$vehicle->payLoad}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                      </div>
  
                     
          
          
                </div>
                  </div>
                 </div>
  
                 <?php
                 $res=Illuminate\Support\Facades\DB::table('reservation')
                                                    ->join('users','users.email','=','reservation.email')
                                                    ->select('reservation.*','users.zone','users.zone','users.branch','users.name','users.position') 
                                                    ->where('reservation.id','=',$resId)
                                                    ->first();
                 ?>
                 <div class="col-12 col-lg-7">
  
                  <div class="card card-danger border-danger card-outline mt-2" style=" border-width:3px; border-bottom:none; border-top: none; height: 550px;">
                   <h6 style="color: gray;" class="mt-2">  &nbsp; &nbsp; Reservation Details</h6>
                    <div class="card-body box-profile">

                      <input type="text" name="resId" value="{{$res->id}}" hidden>
                      <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Name</span>
                        </div>
                        <input type="text" name="name"  value="{{$res->name}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                      </div>
  
                      <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Zone</span>
                        </div>
                        <input type="text" name="zone" value="{{$res->zone}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                      </div>
  
                      <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Branch</span>
                        </div>
                        <input type="text" name="branch"  value="{{$res->branch}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                      </div>
  
                      <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Position</span>
                        </div>
                        <input type="text" name="position"  value="{{$res->position}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                      </div>
        
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;">Destination From</span>
                        </div>
                        <input type="text" name="from" class="form-control" value="{{$res->ResFrom}}" style="width:250px;" required>
                        <div class="input-group-prepend">
                            <span class="input-group-text">To</span>
                          </div>
                        <input type="text" name="to" value="{{$res->ResTo}}"  class="form-control" style="width:250px;" required>
                      </div>
  
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;">Reserve Date</span>
                        </div>
                        <input type="date" name="resDate" value="{{$res->reserveDate}}"  class="form-control" style="width:250px;"  required>
                        <div class="input-group-prepend">
                            <span class="input-group-text">End Date</span>
                          </div>
                        <input type="date" name="endDate" class="form-control" value="{{$res->endDate}}" style="width:250px;"  required>
                        </div>
          
                      <div class="input-group input-group-sm mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">No. of Pasengers</span>
                          </div>
                          <input type="text" value="{{$res->passengers}}"  name="ResPassengers" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px;"  required>
                        </div>
                        
          
                      <div class="input-group input-group-default mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Reason</span>
                        </div>
                        <textarea type="text" name="reason" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px;" required>{{$res->reason}}</textarea>
                      </div>
  
                      
        
                    </div>
                  </div>
                      
                  
                 </div>
                 </div>
                   
                  </div>
                </center>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Reserve</button>
            </div>
          </div>
        </div>
      </div>
    </form>
         </div>
    </section>
   <script>
  
  $(document).ready(function(){
      var table=$('#vehicle').DataTable();    
      
} );   
            
       
   </script>
@endsection
