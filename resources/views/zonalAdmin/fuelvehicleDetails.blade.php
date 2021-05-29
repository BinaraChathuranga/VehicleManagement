
@extends('layouts.zonalAdmin')

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
          <h1 class="m-0 text-dark">Fuel Consumption </h1> 
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
          @endif

    <table class="table table-striped table-bordered" id="vehicle">
      <thead>
        <tr>
            
            <th></th>
            <th>Vehicle No</th>
            <th>Type</th>
            <th>Driver</th>
            <th>Available fuel</th>
            <th>Fuel Capacity</th>
            <th>Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
          @foreach(App\vehicleDetail::where('zone','=',Auth::user()->zone)->get(); as $vI)
          <?php
         $vehicles=Illuminate\Support\Facades\DB::table('fuelconsuption')->where('vehicleNo','=',$vI->regNo)->count();
         ?>
         @if($vehicles > 0)
        <tr>
            
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$vI->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td>{{$vI->regNo}}</td>
            <td>{{$vI->type}}</td>
            <td>{{$vI->vehDriver}}</td>
            <td>{{$vI->avaFuel}}</td>
            <td>{{$vI->capacity}}</td>
            <td>
              <div class="btn-group-sm">
                <a href="#" class="btn btn-success refillB" >Refill</a>
                <a href="/zonalAdmin/vehFuelConsumption/{{$vI->regNo}}" class="btn btn-warning" >Consumption</a>
                <a href="/zonalAdmin/viewRefillDetails/{{$vI->regNo}}" class="btn btn-secondary" >Refill Details</a>
              </div>
            </td> 
        </tr>

        @elseif($vehicles == 0)
        <tr>
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$vI->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td>{{$vI->regNo}}</td>
            <td>{{$vI->type}}</td>
            <td>{{$vI->vehDriver}}</td>
            <td>{{$vI->avaFuel}}</td>
            <td>{{$vI->capacity}}</td>
            <td>
              <div class="btn-group-sm" hidden>
                <a href="#" class="btn btn-success refillB" >Refill</a>
                <a href="/zonalAdmin/vehFuelConsumption/{{$vI->regNo}}" class="btn btn-warning" >Consumption</a>
                <a href="/zonalAdmin/viewRefillDetails/{{$vI->regNo}}" class="btn btn-secondary" >Refill Details</a>
              </div>
            </td> 
        </tr>
        @endif
        @endforeach
        </tbody>
           
    </table>
        </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="refillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Refill Fuel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="refillForm" method="POST" action="/zonalAdmin/refillFuel">
          {{csrf_field()}}
           
      <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Vehicle No.</span>
            </div>
            <input class="form-control" name="regNo" id="regNo" value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Available Fuel</span>
            </div>
            <input class="form-control avaFuel" name="avaFuel" id="avaFuel" value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Refilled Fuel</span>
            </div>
            <input class="form-control refill" name="refillFuel" value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Total Fuel</span>
            </div>
            <input class="form-control totalFuel" name="totalFuel" value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Product Name</span>
            </div>
            <select name="product" id="" class="form-control">
            <option value="Lanka Super">Lanka Super</option>
            <option value="Lanka Regular">Lanka Regular</option>
            </select>
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Price</span>
            </div>
            <input class="form-control" name="price" value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Refilling Station</span>
            </div>
            <input class="form-control" name="reCenter" value="">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Refilled Date</span>
            </div>
            <input class="form-control" type="date" name="refilledDate" value="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="sumbit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
   </form>
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
        processing:true,
      });  

      table.on('click','.refillB',function(){
        $tr=$(this).closest('tr');
        if ($($tr).hasClass('child')){
          $tr=$tr.prev('.parent');
        }

        var data = table.row($tr).data();
        console.log(data);

        $('#regNo').val(data[1]);
        $('#avaFuel').val(data[4]);

        $('#refillModal').modal('show');
      });  
} ); 

$('.refill').keyup(function(){
          var available=parseFloat($('.avaFuel').val());
          var refill=parseFloat($(this).val());
          var total;

        if(Number.isNaN(available))
        total=0;
        else if(Number.isNaN(refill))
        total=0;
        else
        total= available+refill;
        $('.totalFuel').val(total);

     });
            
       
   </script>
@endsection
