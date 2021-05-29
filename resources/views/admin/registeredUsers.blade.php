
@extends('layouts.admin')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="{{asset('js/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

<style>
  .zoom {
      
      transition: transform .2s; /* Animation */
     
  }
  
  .zoom:hover {
      transform: scale(2.10); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
      background-color:transparent;
    

  }
  </style>
</head>
<body>
  
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-8 col-sm-6 lg-col-6">
        <h1 class="m-0 text-dark">Registered Users </h1> 
          
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

  <div class="col-12 col-lg-12">    
    <div class="table-responsive"> 
  <table class="table table-striped table-bordered" id="reg">
    <thead>
      <tr>
          
          <th>Name</th>
          <th></th>
          <th>District</th>
          <th>Zone</th>
          <th>Branch</th>
          <th>Position</th>
          <th>Pre Role</th>
          <th>Role</th>
          <th>action</th>
      </tr>
      </thead>
      <tbody>
          @foreach($userInfo as $uI)
      <tr>
          
          <td>{{$uI->name}}</td>
          <td class="zoom" style="border:none;"><img src="{{asset('/img/'. $uI->avatar)}}" alt="" style="width: 60px; height: 60px;"></td>
          <td>{{$uI->district}}</td>
          <td>{{$uI->zone}}</td>
          <td>{{$uI->branch}}</td>
          <td>{{$uI->position}}</td>
          <td>{{$uI->preRole}}</td>
          <td>{{$uI->role}}</td> 
          <td>
            <div class="btn-group">
              <a href="/viewRegUser/{{$uI->id}}" class="btn btn-success " >View</a>
              <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item " href="/editRegUser/{{$uI->id}}">Edit</a>
                <a class="dropdown-item " href="#">Delete</a>
              </div>
            </div>
          </td> 
      </tr>
      @endforeach
      </tbody>
          
  </table>
</div> 
</div>
      </div>
      </div>

     

  </div>
  </section>
</body>
</html>




  
   <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
   <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

   <script>
    $(document).ready(function(){
      var table=$('#reg').DataTable({
      
        
       });
            
      
} );
      
            
       
   </script>
@endsection
