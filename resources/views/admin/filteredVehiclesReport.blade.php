
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
          <h1 class="m-0 text-dark">Vehicle Details </h1> <hr>
         
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
          <a href="/admin/vehicleDetails" class="btn btn-success mb-3" id="back" style="width: 100px;">Back</a>
        </div>
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
          @endif

          <form action="/admin/filterVehiclesReport" method="POST">
            {{csrf_field()}}

          <div class="row">

          <div class="col-12 col-lg-3">
          </div>

          <div class="col-12 col-lg-3">
          </div>

          <div class="col-12 col-lg-3">
          <select name="zone" id="zone" class="form-control">
          <option value="0" selected="true" disabled>--Select--</option>
            @foreach(App\zone::all(); as $zone)
            <option value="{{$zone->zone}}">{{$zone->zone}}</option>
            @endforeach
          </select>
          </div>

          <div class="col-12 col-lg-2">
            <select name="vType" class="form-control">
            <option value="0" selected="true" disabled>--Select--</option>
             <option value="Bus">Bus</option>
             <option value="Lorry">Lorry</option>
             <option value="Van">Van</option>
             <option value="Cab">Cab</option>
             <option value="Car">Car</option>
             <option value="Three Wheeler">Three Wheeler</option>
             <option value="All">All</option>
            </select>
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
  <h4  style="color: black;">Vehicle Details Report</h4>
  <h6 style="color: black;">zone : {{$zonel}} | Type : {{$vType}}<h6>

</div> 
    <table class="table table-striped table-bordered" id="vehicle">
      <thead>
        <tr>
            <th></th>
            <th style="text-align:center;">Vehicle No</th>
            <th style="text-align:center;">Make</th>
            <th style="text-align:center;">Type</th>
            <th style="text-align:center;">Max Passengers</th>
            <th style="text-align:center;">Fuel Capacity</th>
            <th style="text-align:center;">Zone</th>
            <th style="text-align:center;">Status</th>
            <th style="text-align:center;">Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
          @foreach($dvInfo as $vI)
          @if($vI->status == "Available")
        <tr>
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$vI->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align:center;">{{$vI->regNo}}</td>
            <td style="text-align:center;">{{$vI->makeAndtype}}</td>
            <td style="text-align:center;">{{$vI->type}}</td>
            <td style="text-align:center;">{{$vI->passengers}}</td>
            <td style="text-align:center;">{{$vI->capacity}}</td>
            <td style="text-align:center;">{{$vI->zone}}</td>
            <td style="text-align:center;">{{$vI->status}}</td>
            <td style="text-align:center;">
              <div class="btn-group">
                <a href="/admin/viewVehicleDetails/{{$vI->regNo}}" class="btn btn-success view" >View</a>
                </button>
               
              </div>
            </td> 
           
        </tr>
        @elseif($vI->status == "At Service")
        <tr class="table-danger">
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$vI->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align:center;">{{$vI->regNo}}</td>
            <td style="text-align:center;">{{$vI->makeAndtype}}</td>
            <td style="text-align:center;">{{$vI->type}}</td>
            <td style="text-align:center;">{{$vI->passengers}}</td>
            <td style="text-align:center;">{{$vI->capacity}}</td>
            <td style="text-align:center;">{{$vI->zone}}</td>
            <td style="text-align:center;">{{$vI->status}}</td>
            <td style="text-align:center;">
              <div class="btn-group">
                <a href="/admin/viewVehicleDetails/{{$vI->regNo}}" class="btn btn-success view" >View</a>
                </button>
               
              </div>
            </td> 
           
        </tr>

        @elseif($vI->status == "At Repair")
        <tr class="table-danger">
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$vI->image)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td style="text-align:center;">{{$vI->regNo}}</td>
            <td style="text-align:center;">{{$vI->makeAndtype}}</td>
            <td style="text-align:center;">{{$vI->type}}</td>
            <td style="text-align:center;">{{$vI->passengers}}</td>
            <td style="text-align:center;">{{$vI->capacity}}</td>
            <td style="text-align:center;">{{$vI->zone}}</td>
            <td style="text-align:center;">{{$vI->status}}</td>
            <td style="text-align:center;">
              <div class="btn-group">
                <a href="/admin/viewVehicleDetails/{{$vI->regNo}}" class="btn btn-success view" >View</a>
                </button>
               
              </div>
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
         

       

    </div>
    </section>

  
   <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
   <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('js/printThis.js')}}"></script>
   <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

   <script>
  
  var table=$('#vehicle').DataTable({
      
      language: { search: ""},
      "dom": 'f',
 
    });
  

    $('#print').click(function(){

      $('#alert').show('fade');
      $('#alert1').show();
      $('#resReport').printThis();
  });
            
       
   </script>
@endsection
