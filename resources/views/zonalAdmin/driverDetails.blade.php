
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
          <h1 class="m-0 text-dark">Driver Details </h1> <br> <hr>
          <a href="{{route('zonalAdmin.driverDetails.create')}}" class="btn btn-primary">New Driver</a> 
        </div><!-- /.col -->




        <!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <hr>
  <!-- /.content-header -->

  <!-- Main content -->

  
  

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

    <table class="table table-striped table-bordered" id="driverDetails">
      <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>NIC</th>
            <th>Email</th>
            <th>Mobile No.</th>
            <th>Zone</th>
            <th>Status</th>
            <th>Action</th>   
        </tr>
        </thead>
        <tbody>
            @foreach($dInfo as $dI)
        <tr>
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$dI->avatar)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td>{{$dI->nameInt}}</td>
            <td>{{$dI->NIC}}</td>
            <td>{{$dI->email}}</td>
            <td>{{$dI->mobile}}</td>
            <td>{{$dI->zone}}</td>
            @if($dI->status == "Available")
            <td style="color: green;">{{$dI->status}}</td>
            @elseif($dI->status == "Not Available")
            <td style="color: red;">{{$dI->status}}</td>
            @endif
            <td>
              <div class="btn-group">
                <a href="/zonalAdmin/viewDriverDetails/{{$dI->NIC}}" class="btn btn-success" >View</a>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item " href="/zonalAdmin/editDetails/{{$dI->NIC}}">Edit</a>
                  <a class="dropdown-item " href="/zonalAdmin/deleteDetails/{{$dI->NIC}}">Delete</a>
                </div>
              </div>
            </td>    
        </tr>
        @endforeach
        </tbody>
           
    </table>
        </div>
        </div>

        

       

    </div>
    </section>

  
   <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
   <script src="{{asset('js/printThis.js')}}"></script>
   <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

  <script>
    $(document).ready(function(){
      var table= $('#driverDetails').DataTable();
    });
  </script>
@endsection
