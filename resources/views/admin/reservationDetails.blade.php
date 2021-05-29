
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
          <h1 class="m-0 text-dark">Reservation Details </h1> <hr>
         
        </div><!-- /.col -->




        <!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
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
          <form action="/admin/filterAllResDetails" method="POST">
            {{csrf_field()}}

          <div class="row">
          <div class="col-12 col-lg-3">
          <select name="zone" id="zone" class="form-control">
            @foreach(App\zone::all(); as $zone)
            <option value="{{$zone->zone}}">{{$zone->zone}}</option>
            @endforeach
          </select>
          </div>

          <div class="col-12 col-lg-2">
            <select name="status" id="status" class="form-control">
             
              <option value="Not Approved">Not Approved</option>
              <option value="Approved">Approved</option>
              <option value="Cancelled">Cancelled</option>
              <option value="Confirmed">Confirmed</option>
              <option value="Completed">Completed</option>
              <option value="Successfull">Successfull</option>
            
            </select>
            </div>
          
              <div class="col-12 col-lg-3">
               
              <div class=" input-group input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:60px;" id="inputGroup-sizing">From</span>
              </div>
              <input type="date" name="from" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing">
              </div>
               
                </div>
              
                <div class="col-12 col-lg-3">
                  
                <div class=" input-group input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:50px;" id="inputGroup-sizing">To</span>
              </div>
              <input type="date" name="to" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing">
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
  <h4  style="color: black;">Reservation Report</h4>
  <h6 style="color: black;">All Reservations | Department of Education - CP<h6>
</div>


      <table class="table table-striped table-bordered" id="vehicle">
        <thead>
          <tr>
              
              <th style="text-align: center;" colspan="2">Requester & Vehicle Details</th>
              <th style="text-align: center;" colspan="2">Destination</th>
              <th style="text-align: center;" colspan="2">Reservation Details</th>
              <th style="text-align: center;">Status</th>
             
  
              
              
             
          </tr>
          </thead>
          <tbody>
           @foreach($view as $view)
          <tr>
              <form action="#" method="POST">
                {{csrf_field()}}
              <td style="text-align: right;">
                Name : <br>
                Branch : <br>
                Vehicle No. : <br>
                Type : <br>
                
              </td>
              <td style="text-align: left;">
                {{$view->name}} <br>
                {{$view->branch}} <br>
                {{$view->vehicleNo}} <br>
                {{$view->vType}} 
                 
                
  
              </td>
            
                
                <input type="text" name="driver" value="{{$view->driver}}" hidden>
              
  
              
  
  
              <td style="text-align: right;">
                From : <br>
                To :
              </td>
              <td style="text-align: left;">
                {{$view->ResFrom}} <br>
                {{$view->ResTo}} 
              </td>
  
              <td style="text-align: right;">
                Res. Date : <br>
                Duration : <br>
                Passengers : <br>
                Driver :
              
              </td>
              <td style="text-align: left;">
                {{$view->reserveDate}} <br>
                {{$view->endDate}} <br>
                {{$view->passengers}} <br>
                {{$view->driver}}
              </td>
                <?php
                $status=$view->resStatus;
                ?>
                <td
                <?php if($status == "Not Approved"):?> 
                style="color:orange; text-align:center" 
                <?php elseif($status == "Approved"):?>  
                style="color:yellow;  text-align:center" 
                <?php elseif ($status == "Cancelled"):?> 
                 style="color:red;  text-align:center" 
                 <?php elseif ($status == "Confirmed"):?> 
                 style="color:blue;  text-align:center" 
                 <?php elseif ($status == "Completed"):?> 
                 style="color:green;  text-align:center" 
                 <?php elseif ($status == "Successfull"):?> 
                 style="color:gray;  text-align:center" 
                 <?php endif; ?>>
                
                 <b>{{$view->resStatus}}</b>
              </td>
  
              </form>
          </tr>
          @endforeach
          </tbody>
             
      </table>
<div>
    </div>
  </div>
    </div>
        </div>

        <!-- view Driver modal -->
         

       

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
