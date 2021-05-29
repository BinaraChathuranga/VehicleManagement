
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
          <h1 class="m-0 text-dark">Vehicle Details </h1> <br> <hr>
          <a href="{{route('admin.vehicleDetails.create')}}" class="btn btn-primary">New Vehicle</a> 
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
            <th style="text-align: center;">Vehicle No</th>
            <th style="text-align: center;">Type</th>
            <th style="text-align: center; width: 150px;">Driver</th>
            <th style="text-align: center;">Milometer</th>
            <th style="text-align: center; width: 100px;">Zone</th>
            <th style="text-align: center;">Status</th>
            <th>Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
          @foreach($dvInfo as $vI)
          @if($vI->status == "Available")
        <tr>
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$vI->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$vI->regNo}}</td>
            <td style="text-align: center;">{{$vI->type}}</td>
            <td style="text-align: center; width: 150px;">{{$vI->vehDriver}}</td>
            <td style="text-align: center;">{{$vI->milometer}}</td>
            <td style="text-align: center; width: 100px;">{{$vI->zone}}</td>
            @if($vI->status == "Available")
            <td style="text-align: center; color: green;">{{$vI->status}}</td>
            @elseif($vI->status == "Not Available")
            <td style="text-align: center; color: red;">{{$vI->status}}</td>
            @endif
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="/admin/viewVehicleDetails/{{$vI->regNo}}" class="btn btn-success view" >View</a>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item " href="/admin/editVDetails/{{$vI->regNo}}">Edit</a>
                  <a class="dropdown-item " href="/admin/deleteVDetails/{{$vI->regNo}}">Delete</a>
                </div>
              </div>
            </td> 
           
        </tr>

        @elseif($vI->status == "At Service")
        <tr class="table-danger">
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$vI->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$vI->regNo}}</td>
            <td style="text-align: center;">{{$vI->type}}</td>
            <td style="text-align: center; width: 150px;">{{$vI->vehDriver}}</td>
            <td style="text-align: center;">{{$vI->milometer}}</td>
            <td style="text-align: center; width: 100px;">{{$vI->zone}}</td>
            @if($vI->status == "Available")
            <td style="text-align: center; color: green;">{{$vI->status}}</td>
            @elseif($vI->status == "At Service")
            <td style="text-align: center; color: red;">{{$vI->status}}</td>
            @endif
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="/admin/viewVehicleDetails/{{$vI->regNo}}" class="btn btn-success view" >View</a>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item " href="/admin/editVDetails/{{$vI->regNo}}">Edit</a>
                  <a class="dropdown-item " href="/admin/deleteVDetails/{{$vI->regNo}}">Delete</a>
                </div>
              </div>
            </td> 
           
        </tr>

        @elseif($vI->status == "At Repair")
        <tr class="table-danger">
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$vI->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$vI->regNo}}</td>
            <td style="text-align: center;">{{$vI->type}}</td>
            <td style="text-align: center; width: 150px;">{{$vI->vehDriver}}</td>
            <td style="text-align: center;">{{$vI->capacity}}</td>
            <td style="text-align: center; width: 100px;">{{$vI->zone}}</td>
            @if($vI->status == "Available")
            <td style="text-align: center; color: green;">{{$vI->status}}</td>
            @elseif($vI->status == "Not Available")
            <td style="text-align: center; color: red;">{{$vI->status}}</td>
            @endif
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="/admin/viewVehicleDetails/{{$vI->regNo}}" class="btn btn-success view" >View</a>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item " href="/admin/editVDetails/{{$vI->regNo}}">Edit</a>
                  <a class="dropdown-item " href="/admin/deleteVDetails/{{$vI->regNo}}">Delete</a>
                </div>
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
         

       

    </div>
    </section>

  
   <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
   <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

   <script>
  
  $(document).ready(function(){
      $('#vehicle').DataTable({
        processing:true,
      });    
      
} );   
            
       
   </script>
@endsection
