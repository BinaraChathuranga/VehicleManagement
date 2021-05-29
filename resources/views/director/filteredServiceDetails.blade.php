
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
          <h1 class="m-0 text-dark">Service Details </h1> <hr>
         
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

        <div class="row">
        <div class="col-lg-10 col-12">
        </div>

        <div class="col-lg-2 col-12">
        <div class="alert collapse" role="alert" style="text-align: center; background-color: transparent;" id="alert1">
          <a href="/director/viewServiceDetails/{{$vNo}}" class="btn btn-success mb-3" id="back" style="width: 100px;">Back</a>
        </div>
        </div>
      </div>

        <div class="card">

        
         <div class="card-body">

         <form action="/director/filterServiceDetails" method="POST">
            {{csrf_field()}}

          <div class="row">
              <input type="text" name="vName" value="{{$vNo}}" hidden>
              <div class="col-12 col-lg-5">
          <h3 class="m-0 text-dark ml-3 mb-3"> Vehicle No : {{$vNo}} </h3>
          </div>
          
          <div class="col-12 col-lg-3">
               
               <div class=" input-group input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" style="width:60px;" id="inputGroup-sizing">From</span>
               </div>
               <input type="date" name="from" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing" required>
               </div>
                
                 </div>
               
                 <div class="col-12 col-lg-3">
                   
                 <div class=" input-group input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" style="width:50px;" id="inputGroup-sizing">To</span>
               </div>
               <input type="date" name="to" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing" required>
               </div>
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

    <div class="row">
        <div class="col-lg-10 col-12">

        </div>

        <div class="col-lg-2 col-12">
          <button class="btn btn-primary mb-3" id="print" style="width: 100px;">Print</button>
        </div>

      </div>

      <div id="resReport">

<div class="alert alert-light collapse" role="alert" style="text-align: center;" id="alert">
  <h4  style="color: black;">Service Details Report</h4>
<?php
$zone=App\vehicleDetail::where('regNo','=',$vNo)->distinct('zone')->first();
?>
  <h6 style="color: black;">Vehicle No : {{$vNo}} | {{$zone->zone}} | From {{$from}} To {{$to}}<h6>

</div>   
    <table class="table table-striped table-bordered" id="vehicle">
      <thead>
        <tr>
          
            <th style="text-align: center;" hidden>Vehicle No</th>
            <th style="text-align: center;">Part Name</th>
            <th style="text-align: center;">Service Details</th>
            <th style="text-align: center;">Serviced At</th>
            <th style="text-align: center;">Service Start</th>
            <th style="text-align: center;">Service End</th>
            <th style="text-align: center;">Payment</th> 
        </tr>
        </thead>
        <tbody>
            @foreach($sd as $sd)
            @if($sd->statusService == "Serviced")
        <tr>
            <td style="text-align: center;" hidden>{{$sd->vehicleNoService}}</td>
            <td style="text-align: center;">{{$sd->partNameService}}</td>
            <td style="text-align: center;">{{$sd->serviceDetails}}</td>
            <td style="text-align: center;">{{$sd->serviced_at}}</td>
            <td style="text-align: center;">{{$sd->serviceStart}}</td>
            <td style="text-align: center;">{{$sd->serviceEnd}}</td>
            <td style="text-align: center;">{{$sd->servicePayment}}</td>
              
        </tr>

        @elseif($sd->statusService == "Not at Service")
        <tr>
            <td style="text-align: center;" hidden>{{$sd->vehicleNoService}}</td>
            <td style="text-align: center;">{{$sd->partNameService}}</td>
            <td style="text-align: center;">Still at Service</td>
            <td style="text-align: center;">{{$sd->serviced_at}}</td>
            <td style="text-align: center;">{{$sd->serviceStart}}</td>
            <td style="text-align: center;">Still at Service</td>
            <td style="text-align: center;">0</td>    
        </tr>
        @endif
        @endforeach
        </tbody>
           
    </table>
</div>
   
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
    <script src="{{asset('js/printThis.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
  
    <script>
    $(document).ready(function(){
    var table=$('#vehicle').DataTable({
      
      language: { search: ""},
      "dom": 'f',
 
    });
    })

    $('#print').click(function(){

      $('#alert').show('fade');
      $('#alert1').show();
      $('#resReport').printThis();
  });
    </script>
  

@endsection
