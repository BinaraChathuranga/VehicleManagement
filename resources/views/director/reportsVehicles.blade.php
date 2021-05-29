
@extends('layouts.director')

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
          <h1 class="m-0 text-dark">Vehicle Reports</h1> 
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

          <form action="/director/filterReportsVehicles" method="POST">
            {{csrf_field()}}

          <div class="row">

          <div class="col-12 col-lg-3">
          </div>

          <div class="col-12 col-lg-3">
          </div>

          <div class="col-12 col-lg-3">
          <select name="zone" id="zone" class="form-control">
          <option value="0" selected="true" disabled>--Select--</option>
            @foreach(App\zone::all(); as $zone)
            <option value="{{$zone->zone}}">{{$zone->zone}}</option>
            @endforeach
          </select>
          </div>

          <div class="col-12 col-lg-2">
            <select name="vType" class="form-control">
            <option value="0" selected="true" disabled>--Select--</option>
             <option value="Bus">Bus</option>
             <option value="Lorry">Lorry</option>
             <option value="Van">Van</option>
             <option value="Cab">Cab</option>
             <option value="Car">Car</option>
             <option value="Three Wheeler">Three Wheeler</option>
             <option value="All">All</option>
            </select>
            </div>
          
            
        <div class="col-12 col-lg-1">
          <button type="submit" class="btn btn-success" >Filter</button>
          </div>
        </div>
    
      </form>
</div>
</div>



<div class="card">
         <div class="card-body">
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
         
        
        <tr>
            
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$vI->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td>{{$vI->regNo}}</td>
            <td>{{$vI->type}}</td>
            <td>{{$vI->vehDriver}}</td>
            <td>{{$vI->avaFuel}}</td>
            <td>{{$vI->capacity}}</td>
            <td>
              <div class="btn-group-sm">
                <a href="/director/viewReportVehicleDetails/{{$vI->regNo}}" class="btn btn-success" >View Reports</a>
              </div>
            </td> 
        </tr>

        
        @endforeach
        </tbody>
           
    </table>
        </div>
        </div>

        <!-- Modal -->
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
