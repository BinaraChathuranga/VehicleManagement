
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
          <h1 class="m-0 text-dark">Reserve Vehicle </h1> <hr>
         
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

        <form action="/admin/vehicleFilter" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="col-12 col-lg-7">

            </div>

          <div class="col-12 col-lg-4">
          <div class="input-group input-group-default mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" style="width:100px;" id="inputGroup-sizing-default">Type</span>
            </div>
            <select class="form-control" name="type" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              <option value="0" selected="true" disabled>--Select--</option>
             
              <option value="Bus">Bus</option>
              <option value="Lorry">Lorry</option>
              <option value="Van">Van</option>
              <option value="Cab">Cab</option>
              <option value="Car">Car</option>
              <option value="All">All</option>
          </select>
          </div>
          </div>
          <div class="col-12 col-lg-1">
          <button type="submit" class="btn btn-primary" >Filter</button>
          </div>
        </div>
      </form>

        <div class="card">

          <?php
          $resDate=App\reservation::where('resStatus','=','Pending')->where('zone','=',Auth::user()->zone)->first();
          ?>
          <div class="row">
          <div class="col-lg-6 col-12">

          <div class="alert alert-success" role="alert">
            Requested Reserve Date is From <b>{{$resDate->reserveDate}}</b> To <b>{{$resDate->endDate}}</b>
            </div>

            <div class="col-lg-6 col-12">
            @if(session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 400px;">
              {{session('status')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif
            </div>
          </div>

          </div>

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
         @foreach($resVehicle as $resVehicle)
        <tr>
  
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'. $resVehicle->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align: center;">{{$resVehicle->regNo}}</td>
            <td style="text-align: center;">{{$resVehicle->vehDriver}}</td>
            <td style="text-align: center;">{{$resVehicle->type}}</td>
            <td style="text-align: center;">{{$resVehicle->passengers}}</td>
            <td style="text-align: center;">{{$resVehicle->payLoad}}</td>
            
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="/zonalAdmin/NewReservation/{{$resVehicle->regNo}}" class="btn btn-success view" style="width: 100px;" >Assign</a>
               
               
              </div>
            </td> 
           
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
