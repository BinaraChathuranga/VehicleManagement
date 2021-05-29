
@extends('layouts.zonalAdmin')

@section('content')
<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

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
          <h1 class="m-0 text-dark">Edit Reserve Vehicle </h1> <hr>
         
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

        
          <div class="alert alert-success" role="alert" style="text-align: right;">
            Requested Reserve Date is From <b>{{$edit->reserveDate}}</b> To <b>{{$edit->endDate}}</b>
          </div>


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
            @foreach(App\vehicleDetail::where('zone','=',Auth::user()->zone)->get(); as $resVehicle)
          
        <tr>
            <form action="/zonalAdmin/editReservationInfo/{{$resVehicle->regNo}}" method="post">
            {{csrf_field()}}
            <input type="text" name='ResId' value="{{$edit->id}}" hidden>
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'. $resVehicle->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$resVehicle->regNo}}</td>
            <td style="text-align: center;">{{$resVehicle->vehDriver}}</td>
            <td style="text-align: center;">{{$resVehicle->type}}</td>
            <td style="text-align: center;">{{$resVehicle->passengers}}</td>
            <td style="text-align: center;">{{$resVehicle->payLoad}}</td>
            
            <td style="text-align: center;">
              <div class="btn-group">
                <button type="submit" class="btn btn-success" style="width: 100px;" >Assign</button>
              </div>
            </td> 
            </form>
        </tr>
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

  

@endsection
