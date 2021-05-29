
@extends('layouts.admin')

@section('content')   
   <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

  <div class="row">
  

  <div class="col-lg-12 col-12">
  <center>
   <div class="btn-group btn-group-toggle" data-toggle="buttons">

    <a href="/admin/vehicleDetailsReport" name="options" id="option1" class="btn btn-dark">Vehicle Report</a>
    <a href="/admin/viewAllReservations" name="options" id="option1" class="btn btn-dark">Reservation Report</a>

    @if(Illuminate\Support\Facades\DB::table('fuelconsuption')->where('vehicleNo','=',$dvInfo->regNo)->count() > 0)
    <a href="/admin/vehFuelConsumption/{{$dvInfo->regNo}}" name="options" id="option1" class="btn btn-dark">Fuel Consumption Report</a>
    <a href="/admin/viewRefillDetails/{{$dvInfo->regNo}}" name="options" id="option1" class="btn btn-dark">Fuel Refilled Report</a>
    <a href="/admin/runnigChart/{{$dvInfo->regNo}}" name="options" id="option1" class="btn btn-dark">Runing Chart</a>

    @elseif(Illuminate\Support\Facades\DB::table('fuelconsuption')->where('vehicleNo','=',$dvInfo->regNo)->count() == 0)
    <a href="/admin/vehFuelConsumption/{{$dvInfo->regNo}}" hidden name="options" id="option1" class="btn btn-dark">Fuel Consumption Report</a>
    <a href="/admin/viewRefillDetails/{{$dvInfo->regNo}}" hidden name="options" id="option1" class="btn btn-dark">Fuel Refilled Report</a>
    <a href="/admin/runnigChart/{{$dvInfo->regNo}}" hidden name="options" id="option1" class="btn btn-dark">Runing Chart</a>
    @endif

    @if(Illuminate\Support\Facades\DB::table('servicedetails')->where('vehicleNoService','=',$dvInfo->regNo)->count() > 0)
    <a href="/admin/viewServiceDetails/{{$dvInfo->regNo}}" name="options" id="option1" class="btn btn-dark">Service Report</a>
    @elseif(Illuminate\Support\Facades\DB::table('servicedetails')->where('vehicleNoService','=',$dvInfo->regNo)->count() == 0)
    <a href="/admin/viewServiceDetails/{{$dvInfo->regNo}}" hidden name="options" id="option1" class="btn btn-dark">Service Report</a>
    @endif

    @if(Illuminate\Support\Facades\DB::table('repairDetails')->where('vehicleNoRepair','=',$dvInfo->regNo)->count() > 0)
    <a href="/admin/viewRepairDetails/{{$dvInfo->regNo}}" name="options" id="option1" class="btn btn-dark">Repair Report</a>
    @elseif(Illuminate\Support\Facades\DB::table('repairDetails')->where('vehicleNoRepair','=',$dvInfo->regNo)->count() == 0)
    <a href="/admin/viewRepairDetails/{{$dvInfo->regNo}}" hidden name="options" id="option1" class="btn btn-dark">Repair Report</a>
    @endif
    </div>
  </center>
  </div>

    

  
   </div> 

   <div class="container-fluid">
    <div class="card">

      <div class="row mt-3">
        <div class="col-lg-10 col-12 ">

        </div>

        <div class="col-lg-2 col-12">
          <button class="btn btn-primary mb-3" id="print" style="width: 100px;">Print</button>
        </div>

      </div>
        <div class="card-body" id="report">

          <form action="#" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
       <div class="row">
           <div class="col-12 col-lg-6" >
               
           <div class="card card-primary border-primary card-outline mt-4" style="width: 500px; border-width:3px; border-bottom:none; border-top: none; ">
                  <div class="card-body box-profile">

                  <div class="text-center">
                     <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('/img/'. $dvInfo->image)}}" style="width: 80px; height:80px;"
                       alt="User profile picture">
                   </div> 
                   
                   <h4 class="profile-username text-center">{{$dvInfo->makeAndtype}}</h4>
                <p class="text-muted text-center">{{$dvInfo->regNo}}</p>
                    
            <div class=" input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Zone</span>
              </div>
              <input type="text"  value="{{$dvInfo->zone}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
            </div>

              <div class=" input-group input-group-default mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Registration Date</span>
                </div>
                <input type="text" value="{{$dvInfo->regDate}}" name="regDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style="width:250px; background-color: white;" readonly>
              </div>

            <div class="input-group input-group-default mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Chasis No.</span>
                </div>
                <input type="text" value="{{$dvInfo->chasisNo}}" name="chaNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
              </div>
              

            <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Engine No.</span>
              </div>
              <input type="text" value="{{$dvInfo->engineNo}}" name="engNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
            </div>

            <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Type</span>
              </div>
              <input type="text" value="{{$dvInfo->type}}" name="engNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
            </div>
            
            <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Horse Power</span>
              </div>
              <input type="text" value="{{$dvInfo->horsePower}}" name="horsePower" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
            </div>


      </div>
        </div>
       </div>

       <div class="col-12 col-lg-6">
        <div class="card card-primary border-primary card-outline mt-4" style="width: 500px; border-width:3px; border-bottom:none; border-top: none;">
            <div class="card-body box-profile">

      <div class=" input-group input-group-default mb-3">
       <div class="input-group-prepend">
        <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Type of Body</span>
       </div>
       <input type="text" value="{{$dvInfo->typeOfBody}}" name="tOfBody" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style="width:250px; background-color: white;" readonly>
      </div>    
      
      <div class=" input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Max Passengers</span>
        </div>
        <input type="text" name="passengers" value="{{$dvInfo->passengers}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
      </div>
              
      <div class=" input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Pay Load</span>
        </div>
        <input type="text" value="{{$dvInfo->payLoad}}" name="payLoad" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style="width:250px; background-color: white;" readonly>
      </div>

      <div class=" input-group input-group-default mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Tyre Size-Front</span>
          </div>
          <input type="text" value="{{$dvInfo->fTyreSize}}" name="tyreFront" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style="width:250px; background-color: white;" readonly>
        </div>

        <div class=" input-group input-group-default mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Tyre Size-Rear</span>
          </div>
          <input type="text" value="{{$dvInfo->rTyreSize}}" name="tyreRear" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style="width:250px; background-color: white;" readonly>
        </div>

      <div class="input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Battery Voltage</span>
        </div>
        <input type="text" value="{{$dvInfo->batteryVoltage}}" name="batteryVolt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
      </div>

      <div class="input-group input-group-default mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Battery Amperage</span>
          </div>
          <input type="text" value="{{$dvInfo->batteryAmp}}" name="batteryAmp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
        </div>
        

      <div class="input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Fuel Tank-Capacity</span>
        </div>
        <input type="text" value="{{$dvInfo->capacity}}" name="capacity" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
      </div>
      
      <div class="input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Engine Crank Case</span>
        </div>
        <input type="text" value="{{$dvInfo->crankSize}}" name="crank" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly>
      </div>
 
</div>

  </div>
 
  
           
       </div>
  
      </div>
    </form>
        </div>
    </div>
    </div>  
     
              
           
            


    <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
    <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/printThis.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
        

        <script>
            $('#dist').on('change', function(e){
        console.log(e);
        var d_id = e.target.value;
        $.get('/json-getzone?d_id=' + d_id,function(data) {
          console.log(data);
          $('#zones').empty();
          $('#zones').append('<option value="0" disabled="true" selected="true">- Select -</option>');
          

          $.each(data, function(index, zoneObj){
            $('#zones').append('<option value="'+ zoneObj.zone+'">'+ zoneObj.zone+'</option>');
          })
        });
      });

      $('#zones').on('change', function(e){
        console.log(e);
        var z_id = e.target.value;
        $.get('/json-getdiv?z_id=' + z_id,function(data) {
          console.log(data);
          $('#divisions').empty();
          $('#divisions').append('<option value="0" disabled="true" selected="true">- Select -</option>');
          

          $.each(data, function(index, divObj){
            $('#divisions').append('<option value="'+ divObj.divName+'">'+ divObj.divName+'</option>');
          })
        });
      });

      $('#divisions').on('change', function(e){
        console.log(e);
        var div_id = e.target.value;
        $.get('/json-getbranch?div_id=' + div_id,function(data) {
          console.log(data);
          $('#branches').empty();
          $('#branches').append('<option value="0" disabled="true" selected="true">- Select -</option>');
          

          $.each(data, function(index, divObj){
            $('#branches').append('<option value="'+ divObj.branchName+'">'+ divObj.branchName+'</option>');
          })
        });
      });

      $('#print').click(function(){
$('#report').printThis();
});
        </script>

@endsection