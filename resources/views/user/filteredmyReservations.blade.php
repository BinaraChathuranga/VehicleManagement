
@extends('layouts.user')

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
          <h1 class="m-0 text-dark">My Reservations </h1> <hr>
         
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

        <form action="/user/filterAllResDetails" method="POST">
            {{csrf_field()}}

          <div class="row">
          <div class="col-12 col-lg-3">
          <input name="zone" id="zone" class="form-control" value="{{Auth::user()->zone}}" readonly>
          </div>

          <div class="col-12 col-lg-2">
            <select name="status" id="status" class="form-control">
             
              <option value="Not Approved">Not Approved</option>
              <option value="Approved">Approved</option>
              <option value="Pending">Pending</option>
              <option value="Cancelled">Cancelled</option>
              <option value="Confirmed">Confirmed</option>
              <option value="Completed">Completed</option>
            
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
         

        <div class="card">
         <div class="card-body">
          @if(session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 400px;">
              {{session('status')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @elseif(session('status1'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 400px;">
              {{session('status1')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif

    <table class="table table-striped table-bordered" id="vehicle">
      <thead>
        <tr>
            
            <th style="text-align: center;" colspan="2">Vehicle Details</th>
            <th style="text-align: center;" colspan="2">Destination</th>
            <th style="text-align: center;" colspan="2">Res. Details</th>
            <th style="text-align: center;">Status</th>
            <th style="text-align: center;">Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
         @foreach($myRes as $myRes)
        <tr>
            
            <td style="text-align: right;">
              Vehicle No. : <br>
              Type : <br>
              Driver :
            </td>
            <td style="text-align: left;">
              {{$myRes->vehicleNo}} <br>
              {{$myRes->vType}} <br>
              {{$myRes->driver}}
            </td>

            

            <td style="text-align: right;">
              From : <br>
              To :
            </td>
            <td style="text-align: left;">
              {{$myRes->ResFrom}} <br>
              {{$myRes->ResTo}}
            </td>

            <td style="text-align: right;">
              Res. Date : <br>
              End Date : <br>
              Passengers :
            </td>
            <td style="text-align: left;">
              {{$myRes->reserveDate}} <br>
              {{$myRes->endDate}} <br>
              {{$myRes->passengers}}
            </td>

            <?php
            $status=$myRes->resStatus;
            ?>
            <td
            <?php if($status == "Pending"):?> 
            style="color:orange; text-align:center" 
            <?php elseif($status == "Reserved"):?>  
            style="color:blue;  text-align:center" 
            <?php elseif ($status == "Cancelled"):?> 
             style="color:red;  text-align:center" 
             <?php elseif ($status == "Completed"):?> 
             style="color:green;  text-align:center" 
             <?php endif; ?>>
            
             <b>{{$myRes->resStatus}}</b>
             
            
            </td>
            <td style="text-align: center;">
            <form action="/user/cancelMyReservation/{{$myRes->id}}" method="POST">
              {{csrf_field()}}
              <input type="text" value="{{$myRes->vehicleNo}}" hidden name="vNo">
              <input name="driver" value="{{$myRes->driver}}" hidden>
              <div class="btn-group">
                <button class="btn btn-danger btn-sm view" type="submit" style="width: 60px;" 
                <?php if($status == "Completed" || $status == "Cancelled" ):?> 
                 style="width: 60px;" hidden 
                <?php endif; ?>
                >Cancel</button>
               
               
              </div>
              </form>
            </td> 
           
        </tr>
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
  
  
            
       
   </script>
@endsection
