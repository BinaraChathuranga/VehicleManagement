
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
          <h1 class="m-0 text-dark">Repair Details </h1> <hr>
         
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

         <form action="/admin/filterRepairDetails" method="POST">
            {{csrf_field()}}

          <div class="row">
              <input type="text" name="vName" value="{{$rd->vehicleNoRepair}}" hidden>
              <div class="col-12 col-lg-3">
          <h3 class="m-0 text-dark ml-3 mb-3">{{$rd->vehicleNoRepair}}</h3>
          </div>

          <div class="col-12 col-lg-2">
              <select name="repairType" class="form-control" required>
                <option value="0" selected="true" disabled>Repair Type</option>
                 <option value="Annual Repair">Annual Repair</option>
                 <option value="Accident Repair">Accident Repair</option>
                </select>
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
<?php
$zone=App\vehicleDetail::where('regNo','=',$rd->vehicleNoRepair)->distinct('zone')->first();
?>

<div class="alert alert-light collapse" role="alert" style="text-align: center;" id="alert">
  <h4  style="color: black;">Repair Details Report</h4>
  <h6 style="color: black;">Vehicle No : {{$rd->vehicleNoRepair}} | {{$zone->zone}} | All Repair Details<h6>
</div> 
    <table class="table table-striped table-bordered" id="vehicle">
      <thead>
        <tr>
          
            <th style="text-align: center;" hidden>Vehicle No</th>
            <th style="text-align: center; width:120px;" >Repair Details</th>
            <th style="text-align: center; width:120px;" >Parts Replaced</th>
            <th style="text-align: center; width:100px;">Service Center</th>
            <th style="text-align: center;" colspan="2">Repair Start - End</th>
            <th style="text-align: center; " colspan="2">Payment</th> 
            <th style="text-align: center; " colspan="2">Reports No.</th>
        </tr>
        </thead>
        <tbody>
            @foreach(App\repairDetail::where('vehicleNoRepair','=',$rd->vehicleNoRepair)->get(); as $rd)
            @if($rd->repairStatus == "Repaired")
        <tr>
            <td style="text-align: center;" hidden>{{$rd->vehicleNoRepair}}</td>
            <td style="text-align: center; width:120px;">{{$rd->repairDetails}}</td>
            <td style="text-align: center; width:120px;">{{$rd->partsReplaced}}</td>
            <td style="text-align: center; width:100px;">{{$rd->garageName}}</td>
            <td style="text-align: right; width:50px;">
              Start <br>
              End
            </td>
            <td style="text-align: left; width:50px;">
              {{$rd->repairStarted}} <br>
              {{$rd->repairStarted}}
            </td>
            <td style="text-align: right; width:50px;">
              Bill No. <br>
              Payment
            </td>
            <td style="text-align: left; width:70px;">
              {{$rd->billNo}} <br>
              {{$rd->repairPayment}}
            </td>

            <td style="text-align: right; width:85px;">
              Police : <br>
              Insuarance :
            </td>
            <td style="text-align: left;">
              {{$rd->policeReportNo}} <br>
              {{$rd->insReportNo}}
            </td>
              
        </tr>

        @elseif($rd->repairStatus == "At Repair")
        <tr>
            <td style="text-align: center;" hidden>{{$rd->vehicleNoRepair}}</td>
            <td style="text-align: center; width:120px;">Still at Repair</td>
            <td style="text-align: center; width:120px;">Still at Repair</td>
            <td style="text-align: center; width:100px;">{{$rd->garageName}}</td>
            <td style="text-align: right; width:50px;">
              Start <br>
              End
            </td>
            <td style="text-align: left; width:50px;" >
              {{$rd->repairStarted}} <br>
              -
            </td>
            <td style="text-align: right; width:50px;">
              Bill No. <br>
              Payment
            </td>
            <td style="text-align: center; width:70px;">
              - <br>
              -
            </td> 
            <td style="text-align: right; width:85px;">
              Police :<br>
              Insuarance :
            </td>
            <td style="text-align: center;">
              - <br>
              -
            </td>
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
      $('#resReport').printThis();
  });
    </script>
  

@endsection
