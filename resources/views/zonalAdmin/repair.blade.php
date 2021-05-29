
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
          <h1 class="m-0 text-dark">Repair Vehicle </h1> <hr>
         
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

          <?php
          $vDetails=App\vehicleDetail::where('zone','=',Auth::user()->zone)->get();
          ?>
          

         <div class="card-body">
         @if(session('status'))
             <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 400px;">
                 {{session('status')}}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             @endif
         <form action="/zonalAdmin/filterRepairsVehicles" method="POST">
            {{csrf_field()}}

          <div class="row">

          <div class="col-12 col-lg-3">
          </div>

          <div class="col-12 col-lg-3">
          </div>

          <div class="col-12 col-lg-3">
          <input name="zone" id="zone" style="width: 250px;" class="form-control" value="{{Auth::user()->zone}}" readonly>
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
          
            <th style="text-align: center;"></th>
            <th style="text-align: center;">Vehicle No</th>
            <th style="text-align: center;">Driver</th>
            <th style="text-align: center;">Type</th>
            <th style="text-align: center;">Max Pasengers</th>
            <th style="text-align: center;">Milometer</th>
            <th style="text-align: center;">Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
         @foreach($vDetails as $vDetails)
         <?php
         $repairVeh=App\repairDetail::where('vehicleNoRepair','=',$vDetails->regNo)->latest()->first();
         $count=App\repairDetail::where('vehicleNoRepair','=',$vDetails->regNo)->count();
         ?>
           @if($count == 0)
        <tr class="table">
            
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'. $vDetails->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$vDetails->regNo}}</td>
            <td style="text-align: center;">{{$vDetails->vehDriver}}</td>
            <td style="text-align: center;">{{$vDetails->type}}</td>
            <td style="text-align: center;">{{$vDetails->passengers}}</td>
            <td style="text-align: center;">{{$vDetails->milometer}}</td>
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="/zonalAdmin/viewRepairDetails/{{$vDetails->regNo}}" hidden class="btn btn-success" style="width: 120px;" >View </a>
                <a href="#" class="btn btn-primary repair" style="width: 140px;" >Add Repair</a>
              </div>
            </td>   
        </tr>


          @elseif($count > 0 && $repairVeh->repairStatus != "At Repair")
        <tr class="table">
            
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'. $vDetails->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$vDetails->regNo}}</td>
            <td style="text-align: center;">{{$vDetails->vehDriver}}</td>
            <td style="text-align: center;">{{$vDetails->type}}</td>
            <td style="text-align: center;">{{$vDetails->passengers}}</td>
            <td style="text-align: center;">{{$vDetails->milometer}}</td>
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="/zonalAdmin/viewRepairDetails/{{$vDetails->regNo}}" class="btn btn-success" style="width: 120px;" >View </a>
                <a href="#" class="btn btn-primary repair" style="width: 140px;" >Add Repair</a>
              </div>
            </td>   
        </tr>

        @elseif($count > 0 && $repairVeh->repairStatus == "At Repair")
        <tr class="table-danger">
            
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'. $vDetails->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$vDetails->regNo}}</td>
            <td style="text-align: center;">{{$vDetails->vehDriver}}</td>
            <td style="text-align: center;">{{$vDetails->type}}</td>
            <td style="text-align: center;">{{$vDetails->passengers}}</td>
            <td style="text-align: center;">{{$vDetails->milometer}}</td>
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="/zonalAdmin/viewRepairDetails/{{$vDetails->regNo}}" class="btn btn-success" style="width: 120px;" >View </a>
                <a href="/zonalAdmin/completeRepair/{{$vDetails->regNo}}" class="btn btn-primary" style="width: 160px;" >Complete Repair</a>
              </div>
            </td>   
        </tr>
        @endif
        @endforeach
        </tbody>
           
    </table>

   
        </div>
        </div>

        <!-- service parts -->
        <div class="modal fade" id="addRepairDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/zonalAdmin/addRepairDetails" method="POST">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Repair Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      

      <div class="modal-body">

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Repair Type</span>
          </div>
          <select name="repairType" class="form-control" required>
            <option value="0" selected="true" disabled>--Select--</option>
             <option value="Annual Repair">Annual Repair</option>
             <option value="Accident Repair">Accident Repair</option>
            </select>
        </div>
        
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Vehicle No</span>
          </div>
          <input class="form-control" name="vehNo" id="vehNo" value="">
          <input class="form-control" name="zone" id="zone" value="{{Auth::user()->zone}}" hidden>
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Milometer</span>
          </div>
          <input class="form-control" name="milometer" id="milometer" value="">
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Repair At</span>
          </div>
          <input class="form-control" name="repairAt" value="">
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Repair Start Date</span>
          </div>
          <input type="date" class="form-control" name="repairStart" value="" required>
        </div>

      
          </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
  </div>
</div>

        <!-- view Driver modal -->
         <!-- Button trigger modal -->


<!-- Modal -->


       

    </div>
    </section>
    <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
    <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
  
    <script>
      $(document).ready(function(){
    var table=$('#vehicle').DataTable();
    table.on('click','.repair',function(){
        $tr=$(this).closest('tr');
        if ($($tr).hasClass('child')){
          $tr=$tr.prev('.parent');
        }

        var data = table.row($tr).data();
        console.log(data);

        $('#vehNo').val(data[1]);
     

        $('#addRepairDetails').modal('show');
      });  
      });
    </script>
@endsection
