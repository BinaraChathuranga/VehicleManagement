
@extends('layouts.admin')

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
          $resDate=App\reservation::where('resStatus','=','Pending')->where('zone','=',Auth::user()->zone)->first();
          ?>
          <div class="alert alert-success" role="alert" style="text-align: right;">
            Requested Reserve Date is From <b>{{$resDate->reserveDate}}</b> To <b>{{$resDate->endDate}}</b>
          </div>
              
                <div class="card-body">
  <?php
  $reservations = App\reservation::where('vehicleNo','=',$dvInfo->regNo)->get();
  $reservation =[];
   foreach($reservations as $row)
   {
       if($row->resStatus == 'Confirmed'){
           $reservation[] = MaddHatter\LaravelFullcalendar\Facades\Calendar::event(
     
               $row->resStatus,
               true,
               new \DateTime($row->reserveDate),
               new \DateTime($row->created_at),
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
                   new \DateTime($row->created_at),
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

      <form action="/admin/reserve" method="POST" enctype="multipart/form-data">
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
                                 src="{{asset('/img/'. $dvInfo->image)}}" style="width:450px; height:220px;"
                                 alt="User profile picture" >
                             </div> 
                             <br>
                       <input type="text" hidden name="image" value="{{$dvInfo->image}}">
        
                        
                     
                      
                      <div class=" input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Vehicle No.</span>
                        </div>
                        <input type="text" name="vehicleNo"  value="{{$dvInfo->regNo}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                  </div> 

                  <div class=" input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Driver</span>
                    </div>
                    <input type="text" name="driver"  value="{{$dvInfo->vehDriver}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
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
  
                 <?php
                 $res=Illuminate\Support\Facades\DB::table('reservation')
                                                    ->join('users','users.email','=','reservation.email')
                                                    ->select('reservation.*','users.zone','users.zone','users.branch','users.name','users.position') 
                                                    ->where('resStatus','=','Pending')
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
                        <input type="text" name="from" class="form-control" value="{{$res->ResFrom}}" style="width:250px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text">To</span>
                          </div>
                        <input type="text" name="to" value="{{$res->ResTo}}"  class="form-control" style="width:250px;">
                      </div>
  
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;">Reserve Date</span>
                        </div>
                        <input type="date" name="resDate" value="{{$res->reserveDate}}"  class="form-control" style="width:250px;" readonly>
                        <div class="input-group-prepend">
                            <span class="input-group-text">End Date</span>
                          </div>
                        <input type="date" name="endDate" class="form-control" value="{{$res->endDate}}" style="width:250px;" readonly>
                        </div>
          
                      <div class="input-group input-group-sm mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">No. of Pasengers</span>
                          </div>
                          <input type="text" value="{{$res->passengers}}"  name="duration" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px;" >
                        </div>
                        
          
                      <div class="input-group input-group-default mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Reason</span>
                        </div>
                        <textarea type="text" name="reason" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px;">{{$res->reason}}</textarea>
                      </div>
  
                      
        
                    </div>
                  </div>
                      
                  
                 </div>
                 </div>

                 <div class="card">
                  <div class="card-body" id="gatePass">
<?php
$today=Carbon\Carbon::today();
$today1=$today->format('Y/m/d')
?>
                   <center>
                     <h4> <b> Gatepass for Official Vehicle Reservation</b></h4>
                     <h5>{{Auth::user()->zone}}</h5>
                     <h5 >{{$today1}}</h5>
                   </center>

                   <br>
                   <hr>
                   <br>

                     <div>
                       <table>
                         <tr>
                           <td> <h5> Reservation ID </h5></td>
                           <td> <h5>: {{$res->reservationId}}</h5> </td>
                           <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
                           <td><h5> Reserve Date (Start) </h5> </td>
                           <td><h5>: {{$res->reserveDate}}</h5></td>
                         </tr>

                         <tr>
                           <td> <h5> Reserved By </h5>  </td>
                           <td> <h5>: {{$res->name}}</h5> </td>
                           <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
                           <td><h5>Reserve Date (End) </h5> </td>
                           <td><h5>: {{$res->endDate}}</h5></td>
                         </tr>

                         <tr>
                           <td> <h5> Vehicle No </h5>  </td>
                           <td> <h5>: {{$dvInfo->regNo}}</h5> </td>
                           <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
                           <td><h5>Destination  </h5> </td>
                           <td><h5>: {{$res->ResTo}}</h5></td>
                         </tr>

                         <tr>
                           <td> <h5> Driver </h5>  </td>
                           <td> <h5>: {{$dvInfo->vehDriver}}</h5> </td>
                           <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
                           <td><h5>No of Passengers  </h5> </td>
                           <td><h5>: {{$res->passengers}}</h5></td>
                         </tr>

                       </table>
                     </div>
                  
                   <br>
                   <br>

                   <div class="row">
                     <div class="col-lg-1">
                     </div>

                     <div class="col-lg-10">
                       <table class="table table table-bordered">
                         <tr style="height:5px;">
                           <th style="text-align: center; width:20px;">#</th>
                           <th style="text-align: center; ">Passenger's Name</th>
                           <th style="text-align: center;">Designation</th>
                           <th style="text-align: center; width:150px;">Signature</th>
                         </tr>
 
                         <tr style="height:5px;">
                           <td style="text-align:center">01</td>
                           <td></td>
                           <td></td>
                           <td></td>
                         </tr>

                         <tr style="height:5px;">
                           <td style="text-align:center">02</td>
                           <td></td>
                           <td></td>
                           <td></td>
                         </tr>

                         <tr style="height:5px;">
                           <td style="text-align:center">03</td>
                           <td></td>
                           <td></td>
                           <td></td>
                         </tr>
                         <tr style="height:5px;">
                           <td style="text-align:center">04</td>
                           <td></td>
                           <td></td>
                           <td></td>
                         </tr>
                         <tr style="height:5px;">
                           <td style="text-align:center">01</td>
                           <td></td>
                           <td></td>
                           <td></td>
                         </tr>
                         <tr style="height:5px;">
                           <td style="text-align:center">05</td>
                           <td></td>
                           <td></td>
                           <td></td>
                         </tr>
                         <tr style="height:5px;">
                           <td style="text-align:center">06</td>
                           <td></td>
                           <td></td>
                           <td></td>
                         </tr>
                         <tr style="height:5px;">
                           <td style="text-align:center">07</td>
                           <td></td>
                           <td></td>
                           <td></td>
                         </tr>

                         <tr style="height:5px;">
                           <td style="text-align:center">08</td>
                           <td></td>
                           <td></td>
                           <td></td>
                         </tr>

                         <tr style="height:5px;">
                           <td style="text-align:center">09</td>
                           <td></td>
                           <td></td>
                           <td></td>
                           </tr>

                           <tr style="height:5px;">
                           <td style="text-align:center">10</td>
                           <td></td>
                           <td></td>
                           <td></td>
                           </tr>
                       </table>
                     </div> 
                   </div>

                   <br>
                   <br>
                     <h5 class="float-right">  .....................................</h5>  
                      <h5 class="float-right">Drivers's Signature : </h5> 
                   
                  

                  </div>
                </div>

                  </div>
                </center>
              </div>

            </div>
            <div class="modal-footer">
              
              <button type="button" class="btn btn-success" id="print">Print</button>
              <button type="submit" class="btn btn-primary">Reserve</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    

         </div>
    </section>
    <script src="{{asset('js/printThis.js')}}"></script>
   <script>
  
  $(document).ready(function(){
      var table=$('#vehicle').DataTable();    
      
} );   

$('#print').click(function(){


$('#gatePass').printThis();
});

            
       
   </script>
@endsection
