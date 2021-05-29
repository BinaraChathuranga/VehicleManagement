
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
          <h1 class="m-0 text-dark">Confirmed Reservations </h1> <hr>
         
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
            
            <th style="text-align: center;" colspan="2">Vehicle & Requester Details</th>
            <th style="text-align: center;" >Driver</th>
            <th style="text-align: center;" colspan="2">Res. Details</th>
            <th style="text-align: center;">Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
         @foreach($view as $view)
        <tr>
            <form action="/admin/completeReservation/{{$view->id}}" method="POST">
              {{csrf_field()}}
            <td style="text-align: right;">
              Vehicle No. : <br>
              Type : <br>
              Name : <br>
              Branch :
            </td>
            <td style="text-align: left;">
              {{$view->vehicleNo}} <br>
              {{$view->vType}} <br> 
              {{$view->name}} <br>
              {{$view->branch}} 
              

            </td>
            <td>
              {{$view->driver}}
              <input type="text" name="driver" value="{{$view->driver}}" hidden>
            </td>

            <td style="text-align: right;">
              Res. Date : <br>
              End Date : <br>
              Passengers : <br>
              From : <br>
              To :
            </td>
            <td style="text-align: left;">
              {{$view->reserveDate}} <br>
              {{$view->endDate}} <br>
              {{$view->passengers}} <br>
              {{$view->ResFrom}} <br>
              {{$view->ResTo}} 
            </td>

            

            <?php
            $status=$view->status;
            ?>
            
            <td style="text-align: center;">
              <div class="btn-group">
                <button type="submit" class="btn btn-success btn-sm view" style="width: 80px;">Complete</button>
                <a href="/admin/editReservation/{{$view->id}}" class="btn btn-primary btn-sm view" style="width: 60px;">Edit</a>
                <a href="/admin/cancelReservation/{{$view->id}}" class="btn btn-danger btn-sm view" style="width: 80px;">Cancel</a>
               
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
         

       

    </div>
    </section>

  
   <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
   <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

   <script>
  
  
            
       
   </script>
@endsection
