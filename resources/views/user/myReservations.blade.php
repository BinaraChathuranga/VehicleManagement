
@extends('layouts.user')

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
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-4">
          <h1 class="m-0 text-dark">My Reservations </h1> <hr>
         
        </div><!-- /.col -->




        <!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <hr>
  <!-- /.content-header -->

  <!-- Main content -->

  
  <!-- New driver modal -->
    <section class="content">
        <div class="container-fluid">

        <form action="/user/filterAllResDetails" method="POST">
            {{csrf_field()}}

          <div class="row">
          
          <input name="zone" hidden id="zone" class="form-control" value="{{Auth::user()->zone}}" readonly>
          

          <div class="col-12 col-lg-2">
            <select name="status" id="status" class="form-control">
             
              <option value="Not Approved">Not Approved</option>
              <option value="Approved">Approved</option>
              <option value="Pending">Pending</option>
              <option value="Cancelled">Cancelled</option>
              <option value="Confirmed">Confirmed</option>
              <option value="Completed">Completed</option>
            
            </select>
            </div>
          
            <div class="col-12 col-lg-3">
               
               <div class=" input-group input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" style="width:60px;" id="inputGroup-sizing">From</span>
               </div>
               <input type="date" name="from" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing">
               </div>
                
                 </div>
               
                 <div class="col-12 col-lg-3">
                   
                 <div class=" input-group input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" style="width:50px;" id="inputGroup-sizing">To</span>
               </div>
               <input type="date" name="to" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing">
               </div>
                   </div>
            
    
        

        <div class="col-12 col-lg-1">
          <button type="submit" class="btn btn-success" >Filter</button>
          </div>

          <div class="col-12 col-lg-3">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Reservations Calendar
          </button>
        </div>
          
        </div>

       

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reservation Calendar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
  $reservations = App\reservation::where('email','=',Auth::user()->email)->get();
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

           elseif($row->resStatus == 'Pending'){
               $reservation[] = MaddHatter\LaravelFullcalendar\Facades\Calendar::event(
         
                   $row->resStatus,
                   true,
                   new \DateTime($row->reserveDate),
                   new \DateTime($row->created_at),
                   $row->id,
                   [ 
                   'color' => '#ffff00',
                   ]             
                ); 
               }

               elseif($row->resStatus == 'Cancelled'){
                $reservation[] = MaddHatter\LaravelFullcalendar\Facades\Calendar::event(
          
                    $row->resStatus,
                    true,
                    new \DateTime($row->reserveDate),
                    new \DateTime($row->created_at),
                    $row->id,
                    [ 
                    'color' => '#ff0000',
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
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>
</div>
         

        <div class="card">
         <div class="card-body">
          @if(session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 400px;">
              {{session('status')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @elseif(session('status1'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 400px;">
              {{session('status1')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif

    <table class="table table-striped table-bordered" id="vehicle">
      <thead>
        <tr>
            
            <th style="text-align: center;" colspan="2">Vehicle Details</th>
            <th style="text-align: center;" colspan="2">Destination</th>
            <th style="text-align: center;" colspan="2">Res. Details</th>
            <th style="text-align: center;">Status</th>
            <th style="text-align: center;">Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
         @foreach($myRes as $myRes)
        <tr>
            
            <td style="text-align: right;">
              Vehicle No. : <br>
              Type : <br>
              Driver :
            </td>
            <td style="text-align: left;">
              {{$myRes->vehicleNo}} <br>
              {{$myRes->vType}} <br>
              {{$myRes->driver}}
            </td>

            

            <td style="text-align: right;">
              From : <br>
              To :
            </td>
            <td style="text-align: left;">
              {{$myRes->ResFrom}} <br>
              {{$myRes->ResTo}}
            </td>

            <td style="text-align: right;">
              Res. Date : <br>
              End Date : <br>
              Passengers :
            </td>
            <td style="text-align: left;">
              {{$myRes->reserveDate}} <br>
              {{$myRes->endDate}} <br>
              {{$myRes->passengers}}
            </td>

            <?php
            $status=$myRes->resStatus;
            ?>
            <td
            <?php if($status == "Pending"):?> 
            style="color:orange; text-align:center" 
            <?php elseif($status == "Reserved"):?>  
            style="color:blue;  text-align:center" 
            <?php elseif ($status == "Cancelled"):?> 
             style="color:red;  text-align:center" 
             <?php elseif ($status == "Completed"):?> 
             style="color:green;  text-align:center" 
             <?php endif; ?>>
            
             <b>{{$myRes->resStatus}}</b>
             
            
            </td>
            <td style="text-align: center;">
            <form action="/user/cancelMyReservation/{{$myRes->id}}" method="POST">
              {{csrf_field()}}
              <input type="text" value="{{$myRes->vehicleNo}}" hidden name="vNo">
              <input name="driver" value="{{$myRes->driver}}" hidden>
              <div class="btn-group">
                <button class="btn btn-danger btn-sm view" type="submit" style="width: 60px;" 
                <?php if($status == "Completed" || $status == "Cancelled" ):?> 
                 style="width: 60px;" hidden 
                <?php endif; ?>
                >Cancel</button>
               
               
              </div>
              </form>
            </td> 
           
        </tr>
        @endforeach
        </tbody>
           
    </table>
        </div>
        </div>

        <!-- view Driver modal -->
         

       

    </div>
    </section>

  
  
  
@endsection
