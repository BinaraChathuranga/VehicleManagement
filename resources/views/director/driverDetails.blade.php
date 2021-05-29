
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
          <h1 class="m-0 text-dark">Driver Details </h1> <hr>
          
        </div><!-- /.col -->




        <!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <hr>
  <!-- /.content-header -->

  <!-- Main content -->

  
  

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

          <form action="/director/filterDriverReport" method="POST">
            {{csrf_field()}}

          <div class="row">

          <div class="col-12 col-lg-3">
          </div>

          <div class="col-12 col-lg-5">
          </div>

          <div class="col-12 col-lg-3">
          <select name="zone" id="zone" class="form-control">
          <option value="0" selected="true" disabled>--Select--</option>
            @foreach(App\zone::all(); as $zone)
            <option value="{{$zone->zone}}">{{$zone->zone}}</option>
            @endforeach
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
  <h4  style="color: black;">Drivers Details Report</h4>
  <h6 style="color: black;">Education Department - CP | All Drivers Details<h6>
</div>

    <table class="table table-striped table-bordered" id="driver1">
      <thead>
        <tr>
            <th></th>
           
            <th>Name</th>
            <th>NIC</th>
            <th>Email</th>
            <th>Mobile No.</th>
            <th hidden></th>
            <th hidden></th>
            <th hidden></th>
            <th>Zone</th>
            <th>Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
            @foreach($dInfo as $dI)
        <tr>
            <td class="zoom" style="text-align: center;"><img src="{{asset('/img/'.$dI->avatar)}}" alt="" style="width: 60px; height: 60px;"></td>
            <td>{{$dI->nameInt}}</td>
            <td>{{$dI->NIC}}</td>
            <td>{{$dI->email}}</td>
            <td>{{$dI->mobile}}</td>
            <td hidden>{{$dI->address}}</td>
            <td hidden>{{$dI->homeTel}}</td>
            <td hidden>{{$dI->otherTel}}</td>
            <td>{{$dI->zone}}</td>
            @if($dI->status == "Available")
            <td style="color: green;">{{$dI->status}}</td>
            @elseif($dI->status == "Not Available")
            <td style="color: red;">{{$dI->status}}</td>
            @endif
            <td>
              <div class="btn-group">
                <a href="/director/viewDriverDetails/{{$dI->NIC}}" class="btn btn-success" >View</a>       
              </div>
            </td> 
           
        </tr>
        @endforeach
        </tbody>
            
    </table>
        </div>
        </div>

        

       

    </div>
    </section>

  
   <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
   <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('js/printThis.js')}}"></script>
   <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

   <script>
    $(document).ready(function(){
      var table=$('#driver1').DataTable({ 
      language: { search: ""},
      "dom": 'f',
 });    
      
} );

$('#print').click(function(){

$('#alert').show('fade');
$('#alert1').show();
$('#resReport').printThis();
});
      
            
       
   </script>
@endsection
