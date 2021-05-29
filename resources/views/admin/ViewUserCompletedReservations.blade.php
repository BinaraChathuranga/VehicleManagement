
@extends('layouts.admin')

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
          <h1 class="m-0 text-dark">Completed Reservations </h1> <hr>
         
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
          
            <th hidden></th>
            <th hidden></th>
            <th hidden></th>
            <th hidden></th>
            <th style="text-align: center;">Vehicle & Requester Details</th>
            <th style="text-align: center;" >Driver</th>
            <th style="text-align: center;">Res. Details</th>
            <th style="text-align: center;">Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
          <?php
          $viewUserRes=Illuminate\Support\Facades\DB::table('reservation')
          ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
          
          ->join('users','users.email','=','reservation.email')
          ->select('reservation.*','vehicleInfo.status','vehicleInfo.type','vehicleInfo.regNo','vehicleInfo.avaFuel','users.name','users.branch','users.position') 
          ->where('resStatus','=','Completed')
          ->where('reservation.zone','=',Auth::user()->zone) 
          ->get();
          ?>
         @foreach($viewUserRes as $view)
        <tr>
              {{csrf_field()}}
            
            <td hidden>{{$view->vehicleNo}}</td>
            <td hidden>{{$view->avaFuel}} </td>  
            <td hidden>{{$view->id}} </td> 
            <td hidden>{{$view->reserveDate}} </td> 
            <td align="center">
              <table style="border: none;" class="table-sm">
                <tr style="background-color: transparent; border: none; height: 5 px;">
                  <td style="text-align:right;">Vehicle No. :</td>
                  <td style="text-align:left;">{{$view->vehicleNo}}</td>
                </tr>

                <tr style="background-color: transparent; border: none;">
                  <td style="text-align:right;">Type :</td>
                  <td style="text-align:left;">{{$view->vType}}</td>
                </tr>

                <tr style="background-color: transparent; border: none;">
                  <td style="text-align:right;">Name :</td>
                  <td style="text-align:left;">{{$view->name}}</td>
                </tr>

                <tr style="background-color: transparent; border: none;">
                  <td style="text-align:right;">Branch :</td>
                  <td style="text-align:left;">{{$view->branch}}</td>
                </tr>
              </table>  
            </td>
    
            <td>
              {{$view->driver}}
              <input type="text" name="driver" value="{{$view->driver}}" hidden>
            </td>

            <td align="center">
              <table>
                <tr style="background-color: transparent; border: none;">
                  <td style="text-align:right;">Res. Date : </td>
                  <td style="text-align:left;">{{$view->reserveDate}}</td>
                </tr>

                <tr  style="background-color: transparent; border: none;">
                  <td style="text-align:right;">End Date :</td>
                  <td style="text-align:left;">{{$view->endDate}}</td>
                </tr>

                <tr style="background-color: transparent; border: none;">
                  <td style="text-align:right;">Passengers : </td>
                  <td style="text-align:left;">{{$view->passengers}}</td>
                </tr>

                <tr style="background-color: transparent; border: none;">
                  <td style="text-align:right;">From :</td>
                  <td style="text-align:left;">{{$view->ResFrom}}</td>
                </tr>

                <tr style="background-color: transparent; border: none;">
                  <td style="text-align:right;">To :</td>
                  <td style="text-align:left;">{{$view->ResTo}}</td>
                </tr>
              </table> 
            </td>

            <td style="text-align: center;">
              <div class="btn-group">
                <button type="button" class="btn btn-success btn-sm view complete">Add Mileage Info</button>
              </div>
             
            </td> 
        </tr>
        @endforeach
        </tbody>
           
    </table>

     <!-- Modal -->
<div class="modal fade" id="complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/admin/resFuelConsumption" method="POST">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Complete Reservation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
           $viewCM=Illuminate\Support\Facades\DB::table('reservation')
          ->join('vehicleparts','vehicleparts.VNo','=','vehicleNo')  
          ->select('vehicleparts.currentMileage','vehicleparts.id') 
          ->where('resStatus','=','Completed')
          ->where('reservation.zone','=',Auth::user()->zone) 
          ->get();
        ?>

<table hidden>
  @foreach($viewCM as $cm)
  <tr>
    <td><input type="text" name="idv[]" value="{{$cm->id}}"> </td>
    <td><input type="text" name="cm[]" value="{{$cm->currentMileage}}"> </td>
  </tr>
  @endforeach
</table>

      <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Vehicle No</span>
        </div>
        <input class="form-control" name="regNo" id="regNo" value="">
        <input class="form-control" name="resId" id="resId" value="" hidden>
        <input class="form-control" name="resDate" id="resDate" value="" hidden>
      

      </div>

      <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Time (Out)</span>
            </div>
            <input type="time" class="form-control" name="out" value="">

            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Time (In)</span>
            </div>
            <input type="time" class="form-control" name="in"  value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Places Visited</span>
            </div>
            <textarea class="form-control" name="places" value=""></textarea>
          </div>   

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Via</span>
            </div>
            <input class="form-control via" name="via" value="">
          </div>

      <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Milometer (Start)</span>
            </div>
            <input class="form-control start" name="start" value="">

            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Milometer (End)</span>
            </div>
            <input class="form-control end" name="end"  value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Journey</span>
            </div>
            <input class="form-control journey" name="journey" value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Available Fuel</span>
            </div>
            <input class="form-control avaFuel" id="avaFuel" name="Avafuel" value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Fuel Consumption</span>
            </div>
            <input class="form-control fuel" name="fuel" value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Fuel Balance</span>
            </div>
            <input class="form-control fuelBal" name="fuelBal" value="">
          </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
  </div>
</div>
        </div>
        </div>

   

        <!-- view Driver modal -->
         

       

    </div>
    </section>

  
   <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
   <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

   <script>
  
  $(document).ready(function(){
    var table=$('#vehicle').DataTable({
      
      });  

      table.on('click','.complete',function(){
        $tr=$(this).closest('tr');
        if ($($tr).hasClass('child')){
          $tr=$tr.prev('.parent');
        }

        var data = table.row($tr).data();
        console.log(data);

        $('#regNo').val(data[0]);
        $('#resId').val(data[2]);
        $('#avaFuel').val(data[1]);
        $('#resDate').val(data[3]);
        
        $('#complete').modal('show');
      });  
} ); 
  $('.end').keyup(function(){
          var start=parseFloat($('.start').val());
          var end=parseFloat($(this).val());
          
          var journey;

        if(Number.isNaN(start))
        journey=0;
        else if(Number.isNaN(end))
        journey=0;
        else
       
        journey= end-start;
        $('.journey').val(journey);
        

     });

     $('.fuel').keyup(function(){
          var avaFuel=parseFloat($('.avaFuel').val());
          var fuel=parseFloat($(this).val());
          var fuelBal;

        if(Number.isNaN(avaFuel))
        fuelBal=0;
        else if(Number.isNaN(fuel))
        fuelBal=0;
        else
        fuelBal= avaFuel-fuel;
        $('.fuelBal').val(fuelBal);

     });
            
       
   </script>
@endsection
