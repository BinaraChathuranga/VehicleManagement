
@extends('layouts.zonalAdmin')

@section('content')   
   <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

   <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-8 col-sm-6 lg-col-6">
        <h1 class="m-0 text-dark">Insert Vehicle Details</h1> 
          
      </div><!-- /.col -->


      <!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<hr>

  

   <div class="container-fluid">
    <div class="card">
        <div class="card-body">
          <form action="{{route('zonalAdmin.vehicleDetails.store')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
       <div class="row">
           <div class="col-12 col-lg-6" >
                <div class="card card-primary border-primary card-outline mt-4" style="width: 500px;border-width:3px; border-bottom:none; border-top: none; ">
                  <div class="card-body box-profile">
                    
            <div class=" input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Zone</span>
              </div>
              <input class="form-control" name="zone" value="{{Auth::user()->zone}}" readonly>
            </div>

            <div class=" input-group input-group-default mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Registration No.</span>
                </div>
                <input type="text" name="regNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
              </div>

              <div class=" input-group input-group-default mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Registration Date</span>
                </div>
                <input type="date" name="regDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
              </div>

            <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Make & Type</span>
              </div>
              <input type="text" name="m&t" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group input-group-default mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Chasis No.</span>
                </div>
                <input type="text" name="chaNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>
              

            <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Engine No.</span>
              </div>
              <input type="text" name="engNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Type</span>
              </div>
              <select class="form-control" name="type" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                <option value="0" selected="true" disabled>--Select--</option>
               
                <option value="Bus">Bus</option>
                <option value="Lorry">Lorry</option>
                <option value="Van">Van</option>
                <option value="Cab">Cab</option>
                <option value="Car">Car</option>
                <option value="Three Wheeler">Three Wheeler</option>
            </select>
            </div>
            
            <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Horse Power</span>
              </div>
              <input type="text" name="horsePower" class="form-control" pattern="[0-9]+" title="You cannot enter letters here" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group  input-group-sm mb-3">
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Upload Vehicle Image</label>
                </div>
              </div>
           
              <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Driver</span>
              </div>
              <select class="form-control" name="driver" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                <option value="0" selected="true" disabled>--Select--</option>
                 @foreach(App\driverDetail::where('status','!=','Assigned')->where('zone','=',Auth::user()->zone)->get(); as $driver)
                 <option value="{{$driver->nameInt}}">{{$driver->nameInt}}</option>
                 @endforeach
                
            </select>
            </div>

              
      </div>
        </div>
       </div>

       <div class="col-12 col-lg-6">
        <div class="card card-primary border-primary card-outline mt-4" style="width: 500px;border-width:3px; border-bottom:none; border-top: none; ">
            <div class="card-body box-profile">

      <div class=" input-group input-group-default mb-3">
       <div class="input-group-prepend">
        <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Type of Body</span>
       </div>
       <input type="text" name="tOfBody" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
      </div>          
      
      <div class=" input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Max Passengers</span>
        </div>
        <input type="text" name="passengers" class="form-control" pattern="[0-9]+" title="You cannot enter letters here" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
      </div>
      
      <div class=" input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Pay Load</span>
        </div>
        <input type="text" name="payLoad" class="form-control" pattern="[0-9]+" title="You cannot enter letters here" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
      </div>

      <div class=" input-group input-group-default mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Tyre Size-Front</span>
          </div>
          <select type="text" name="tyreFront" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @foreach(Illuminate\Support\Facades\DB::table('tyresizes')->get() as $tyre)
            <option value="{{$tyre->size}}">{{$tyre->size}}</option>
            @endforeach
          </select>
        </div>

        <div class=" input-group input-group-default mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Tyre Size-Rear</span>
          </div>
          <select type="text" name="tyreRear" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @foreach(Illuminate\Support\Facades\DB::table('tyresizes')->get() as $tyre)
            <option value="{{$tyre->size}}">{{$tyre->size}}</option>
            @endforeach
          </select>
        </div>

      <div class="input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Battery Voltage</span>
        </div>
        <input type="text" name="batteryVolt" class="form-control" pattern="[0-9]+" title="You cannot enter letters here" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
      </div>

      <div class="input-group input-group-default mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Battery Amperage</span>
          </div>
          <input type="text" name="batteryAmp" class="form-control" pattern="[0-9]+" title="You cannot enter letters here" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        

      <div class="input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Fuel Tank-Capacity</span>
        </div>
        <input type="text" id="capacity" name="capacity" class="form-control capacity" pattern="[0-9]+" title="You cannot enter letters here" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
      </div>

      <div class="input-group input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" style="width:150px;">Service Mileage</span>
            </div>
            <input type="text" name="serviceMilage" aria-label="First name" pattern="[0-9]+" title="You cannot enter letters here" class="form-control">
          </div>

      <div class="input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Engine Crank Case</span>
        </div>
        <input type="text" name="crank" class="form-control" aria-label="Sizing example input" pattern="[0-9]+" title="You cannot enter letters here" aria-describedby="inputGroup-sizing-default">
      </div>
 
</div>

  </div>
 
  <button class="btn btn-primary float-right btn-block" type="submit"><b>Submit</b> </button>
           
       </div>
  
      </div>
    </form>
        </div>
    </div>
    </div>  
     
              
           
            


        <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
        <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        

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

    
        </script>

@endsection