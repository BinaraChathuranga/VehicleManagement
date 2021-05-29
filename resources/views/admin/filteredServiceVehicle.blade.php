
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
          <h1 class="m-0 text-dark">Service Vehicle </h1> <hr>
         
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

         <form action="/admin/filterServiceVehicles" method="POST">
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
          
            <th style="text-align: center;"></th>
            <th style="text-align: center;">Vehicle No</th>
            <th style="text-align: center;">Driver</th>
            <th style="text-align: center;">Type</th>
            <th style="text-align: center;">Max Pasengers</th>
            <th style="text-align: center;">Pay load</th>
            <th style="text-align: center;">Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
         @foreach($vI as $vDetails)
         <?php
         $count=Illuminate\Support\Facades\DB::table('vehicleParts')->where('vNo','=',$vDetails->regNo)->whereColumn('remindMileage','<','currentMileage')->count();
         $vehicles=Illuminate\Support\Facades\DB::table('vehicleParts')->where('vNo','=',$vDetails->regNo)->count();
         ?>

         @if($count > 0 && $vehicles > 0)
        <tr class="table-danger">
            
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'. $vDetails->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$vDetails->regNo}}</td>
            <td style="text-align: center;">{{$vDetails->vehDriver}}</td>
            <td style="text-align: center;">{{$vDetails->type}}</td>
            <td style="text-align: center;">{{$vDetails->passengers}}</td>
            <td style="text-align: center;">{{$vDetails->payLoad}}</td>
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="/admin/viewVehicleParts/{{$vDetails->regNo}}" class="btn btn-danger" style="width: 120px;" >View Parts <span class="badge badge-light">{{$count}}</span></a>
                <a href="/admin/viewServiceDetails/{{$vDetails->regNo}}" class="btn btn-secondary" style="width: 140px;" >Service Details</a>
              </div>
            </td>   
        </tr>

        @elseif($count == 0 && $vehicles > 0)
        <tr>
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'. $vDetails->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$vDetails->regNo}}</td>
            <td style="text-align: center;">{{$vDetails->vehDriver}}</td>
            <td style="text-align: center;">{{$vDetails->type}}</td>
            <td style="text-align: center;">{{$vDetails->passengers}}</td>
            <td style="text-align: center;">{{$vDetails->payLoad}}</td>
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="/admin/viewVehicleParts/{{$vDetails->regNo}}" class="btn btn-success" style="width: 100px;" >View Parts</a>
                <a href="/admin/viewServiceDetails/{{$vDetails->regNo}}" class="btn btn-secondary" style="width: 140px;" >Service Details</a>
              </div>
            </td>   
        </tr>

        @elseif($vehicles == 0)
        <tr>
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'. $vDetails->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$vDetails->regNo}}</td>
            <td style="text-align: center;">{{$vDetails->vehDriver}}</td>
            <td style="text-align: center;">{{$vDetails->type}}</td>
            <td style="text-align: center;">{{$vDetails->passengers}}</td>
            <td style="text-align: center;">{{$vDetails->payLoad}}</td>
            <td style="text-align: center;">
              <div class="btn-group" hidden>
                <a href="/admin/viewVehicleParts/{{$vDetails->regNo}}" class="btn btn-success" style="width: 100px;" >View Parts</a>
                <a href="/admin/viewServiceDetails/{{$vDetails->regNo}}" class="btn btn-secondary" style="width: 140px;" >Service Details</a>
              </div>
            </td>   
        </tr>
        @endif


        @endforeach
        </tbody>
           
    </table>

   
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
      }); 
    </script>
@endsection
