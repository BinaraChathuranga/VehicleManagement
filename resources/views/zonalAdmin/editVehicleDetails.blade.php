
@extends('layouts.zonalAdmin')

@section('content')   
   <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

  
   <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-8 col-sm-6 lg-col-6">
        <h1 class="m-0 text-dark">Edit Vehicle Details</h1> 
          
      </div><!-- /.col -->


      <!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<hr>

  

   <div class="container-fluid">
    <div class="card">
        <div class="card-body">
          <form action="/zonalAdmin/editVehicleDetails/{{$vInfo->regNo}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
       <div class="row">
           <div class="col-12 col-lg-6" >
               
           <div class="card card-primary border-primary card-outline mt-4" style="width: 500px; border-width:3px; border-bottom:none; border-top: none; ">
                  <div class="card-body box-profile">

                  <div class="text-center">
                     <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('/img/'. $vInfo->image)}}" style="width: 80px; height:80px;"
                       alt="User profile picture">
                   </div> 
                   
                   <h4 class="profile-username text-center">{{$vInfo->makeAndtype}}</h4>
                <p class="text-muted text-center">{{$vInfo->regNo}}</p>
                <input type="text" hidden value="{{$vInfo->makeAndtype}}" name="m&t" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <input type="text" hidden value="{{$vInfo->regNo}}" name="regNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    
            <div class=" input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Zone</span>
              </div>
              <select class="form-control" name="zone" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                <option value="0" selected="true" disabled>--Select--</option>
                @foreach($zone as $z)
                <option value="{{$z->zone}}" {{$z->zone == $vInfo->zone ? 'selected':''}}>{{$z->zone}}</option>
                @endforeach
            </select>
            </div>

              <div class=" input-group input-group-default mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-sm">Registration Date</span>
                </div>
                <input type="text" value="{{$vInfo->regDate}}" name="regDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
              </div>

            <div class="input-group input-group-default mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Chasis No.</span>
                </div>
                <input type="text" value="{{$vInfo->chasisNo}}" name="chaNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
              </div>
              

            <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Engine No.</span>
              </div>
              <input type="text" value="{{$vInfo->engineNo}}" name="engNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>

            <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Type</span>
              </div>
              <select class="form-control" name="type" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                <option value="{{$vInfo->type}}" selected="true">{{$vInfo->type}}</option>
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
              <input type="text" value="{{$vInfo-> 	horsePower}}" name="horsePower" pattern="[0-9]+" title="You cannot enter letters here" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
             
            <div class="input-group  input-group-sm mb-3">
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Edit Vehicle Image</label>
                </div>
              </div>

              <div class="input-group input-group-default mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Driver</span>
              </div>
              <select class="form-control" name="driver" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                <option value="0" selected="true" disabled>--Select--</option>
                 @foreach(App\driverDetail::where('status','!=','Assigned')->where('zone','=',Auth::user()->zone)->get(); as $driver)
                 <option value="{{$driver->nameInt}}" {{$driver->nameInt == $vInfo->vehDriver ? 'selected':''}}>{{$driver->nameInt}}</option>
                 @endforeach
                
            </select>
            </div>  

      </div>
        </div>
       </div>

       <div class="col-12 col-lg-6">
        <div class="card card-primary border-primary card-outline mt-4" style="width: 500px; height:630px; border-width:3px;border-bottom:none; border-top: none;">
            <div class="card-body box-profile">

      <div class=" input-group input-group-default mb-3">
       <div class="input-group-prepend">
        <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Type of Body</span>
       </div>
       <input type="text" value="{{$vInfo->typeOfBody}}" name="tOfBody" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
      </div>  
      
      <div class=" input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Max Passengers</span>
        </div>
        <input type="text" name="passengers" value="{{$vInfo->passengers}}" pattern="[0-9]+" title="You cannot enter letters here" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
      </div>
              
      <div class=" input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Pay Load</span>
        </div>
        <input type="text" value="{{$vInfo->payLoad}}" name="payLoad" pattern="[0-9]+" title="You cannot enter letters here" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
      </div>

      <div class=" input-group input-group-default mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Tyre Size-Front</span>
          </div>
          <select type="text" name="tyreFront" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @foreach(Illuminate\Support\Facades\DB::table('tyresizes')->get() as $tyre)
            <option value="{{$tyre->size}}" {{$tyre->size == $vInfo->fTyreSize ? 'selected':''}}>{{$tyre->size}}</option>
            @endforeach
          </select>
        </div>

        <div class=" input-group input-group-default mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-sm">Tyre Size-Rear</span>
          </div>
          <select type="text" name="tyreReara" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @foreach(Illuminate\Support\Facades\DB::table('tyresizes')->get() as $tyre)
            <option value="{{$tyre->size}}" {{$tyre->size == $vInfo->rTyreSize ? 'selected':''}}>{{$tyre->size}}</option>
            @endforeach
          </select>
        </div>

      <div class="input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Battery Voltage</span>
        </div>
        <input type="text" value="{{$vInfo->batteryVoltage}}" name="batteryVolt" pattern="[0-9]+" title="You cannot enter letters here" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
      </div>

      

      <div class="input-group input-group-default mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Battery Amperage</span>
          </div>
          <input type="text" value="{{$vInfo->batteryAmp}}" name="batteryAmp" pattern="[0-9]+" title="You cannot enter letters here" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
        </div>
        

      <div class="input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Fuel Tank-Capacity</span>
        </div>
        <input type="text" value="{{$vInfo->capacity}}" name="capacity" pattern="[0-9]+" title="You cannot enter letters here" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
      </div>

      <div class="input-group input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" style="width:150px;">Service Mileage</span>
            </div>
            <input type="text" name="serviceMilage" aria-label="First name" pattern="[0-9]+" title="You cannot enter letters here" class="form-control" value="{{$vInfo->serviceMileage}}">
          </div>
      
      <div class="input-group input-group-default mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Engine Crank Case</span>
        </div>
        <input type="text" value="{{$vInfo->crankSize}}" name="crank" pattern="[0-9]+" title="You cannot enter letters here" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
      </div>
 
      <button class="btn btn-primary float-right btn-block mt-2" type="submit"><b>Submit</b> </button>
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