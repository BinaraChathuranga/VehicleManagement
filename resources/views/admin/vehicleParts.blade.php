
@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
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
    <div class="container-fluid ">
      <div class="row mb-2">
        <div class="col-4">
          <h1 class="m-0 text-dark">Vehicle parts to service </h1> <hr>
         
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

          <div class="table-responsive">
          <form action="/admin/insertVehicleParts" method="POST">
            {{csrf_field()}}
            <table class="table table-striped ">
              <thead>
                <tr>
                  <th>Vehicle No.</th>
                  <th>Zone</th>
                  <th>Part Name</th>
                  <th>Service Mileage</th>
                  <th>Remind Mileage</th>
                  <th><a href="#" class="btn btn-primary addRow"> + </a></th>
                </tr>
               </thead>
               <td><input type="text" hidden name="vNo" class="form-control" style="width:140px" value="{{$vehicle->regNo}}" ></td>
            <tbody id="ttt" class="tbody">

                <tr>    
                   <td><input type="text" name="vNo[]" class="form-control" style="width:140px" value="{{$vehicle->regNo}}"  required></td>
                   <td><input type="text" name="zone[]" value="{{Auth::user()->zone}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly ></td>
                   <td><select type="text" name="partName[]" class="form-control" style="width:200px;" required>@foreach(App\vpart::all(); as $vpart)<option value="{{$vpart->part}}">{{$vpart->part}}</option>@endforeach</select></td>
                   <td><input type="text" name="serviceMileage[]" class="form-control" style="width:120px;" required></td>
                   <td><input type="text" name="remindMileage[]" class="form-control" style="width:120px;" required></td>
                   
                   <td><a href="#" class="btn btn-danger remove">X</a></td>
                 </tr>
                                         
              </tbody>
             
                <tfoot>
                  <tr>
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td></td>
                    <td><input type="submit" name="" value="Submit" class="btn btn-success btn-sm float-left" style="width:60px;"></td>
                  </tr>
                </tfoot>
              </table>
            </form>
          </div>
        </div>
        </div>

        <!-- view Driver modal -->
         

       

    </div>
    </section>

   <script type="text/javascript">
    
      $('.addRow').on('click',function(){
          addRow();
      });
      function addRow()
      {
          var tr='<tr>'+
          '<td><input type="text" name="vNo[]" class="form-control" style="width:140px" value="{{$vehicle->regNo}}"  required></td>'+
          '<td><input type="text" name="zone[]" value="{{Auth::user()->zone}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly ></td>'+
          '<td><select type="text" name="partName[]" class="form-control" style="width:200px;" required>@foreach(App\vpart::all(); as $vpart)<option value="{{$vpart->part}}">{{$vpart->part}}</option>@endforeach</select></td>'+
          '<td><input type="text" name="serviceMileage[]" class="form-control" style="width:120px;" required></td>'+
          '<td><input type="text" name="remindMileage[]" class="form-control" style="width:120px;" required></td>'+
          '<td><a href="#" class="btn btn-danger remove"> X </a></td>'+
          '</tr>';
          $('#ttt').append(tr);
      };
      $('.remove').live('click',function(){
          var last=$('.tbody tr').length;
          if(last==1){
              alert("you can not remove last row");
          }
          else{
               $(this).parent().parent().remove();
          }
      
      });
  </script>
@endsection
