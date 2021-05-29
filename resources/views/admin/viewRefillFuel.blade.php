
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
       
          <h1 class="m-0 text-dark">Fuel Refill Details</h1> <hr>
         
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

         <form action="/admin/filterFuelRefill" method="POST">
            {{csrf_field()}}

          <div class="row">
              <input type="text" name="vName" value="{{$rf->vehicleNo}}" hidden>
              <div class="col-12 col-lg-5">
          <h3 class="m-0 text-dark ml-3 mb-3"> Vehicle No : {{$rf->vehicleNo}} </h3>
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
$zone=App\vehicleDetail::where('regNo','=',$rf->vehicleNo)->distinct('zone')->first();
?>

<div class="alert alert-light collapse" role="alert" style="text-align: center;" id="alert">
  <h4  style="color: black;">Fuel Refill Report</h4>
  <h6 style="color: black;">Vehicle No : {{$rf->vehicleNo}} | {{$zone->zone}} | All Fuel Refillings<h6>
</div>

    <table class="table table-striped table-bordered" id="vehicle">
      <thead>
        <tr>
            <th style="text-align: center;">Bill No.</th>
            <th style="text-align: center;">Fuel Available</th>
            <th style="text-align: center;">Filled Fuel</th>
            <th style="text-align: center;">Total Fuel</th>
            <th style="text-align: center;">Product</th>
            <th style="text-align: center;">Filling Station</th> 
            <th style="text-align: center;">Filled Date</th> 
            <th style="text-align: center;">Price</th> 
        </tr>
        </thead>
        <tbody>
            @foreach(App\fuelConsumption::where('vehicleNo','=',$rf->vehicleNo)->where('status','=','Refilled')->get(); as $rf)
        <tr>
            <td style="text-align: center;">{{$rf->FuelBillNo}}</td>
            <td style="text-align: center;">{{$rf->fuelHadAvailable}}</td>
            <td style="text-align: center;">{{$rf->filledFuel}}</td>
            <td style="text-align: center;">{{$rf->totalFuel}}</td>
            <td style="text-align: center;">{{$rf->productName}}</td>
            <td style="text-align: center;">{{$rf->fillingStation}}</td>
            <td style="text-align: center;">{{$rf->refilledDate}}</td>
            <td style="text-align: center;">{{$rf->priceOfFuel}}</td>
              
        </tr>
        @endforeach
        </tbody>

        <tfoot style="text-align: center;">
          <tr>
            <th colspan="7" style="text-align:right">Total :</th>
            <th></th>
          </tr>
        </tfoot>
           
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
  jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
    return this.flatten().reduce( function ( a, b ) {
        if ( typeof a === 'string' ) {
            a = a.replace(/[^\d.-]/g, '') * 1;
        }
        if ( typeof b === 'string' ) {
            b = b.replace(/[^\d.-]/g, '') * 1;
        }
 
        return a + b;
    }, 0 );
} );
</script>
  
    <script>
      $(document).ready(function(){
    var table=$('#vehicle').DataTable({
      
      language: { search: ""},
      "dom": 'f',

      drawCallback: function () {
      var api = this.api();
      $( api.column(7).footer() ).html(
        api.column(7, {page:'current'} ).data().sum()
      );
    }
 
    });
    })

    $('#print').click(function(){

      $('#alert').show('fade');
      $('#resReport').printThis();
  });
    </script>
  

@endsection
