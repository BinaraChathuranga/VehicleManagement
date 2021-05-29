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
          <h1 class="m-0 text-dark">Vehicle Details </h1> <br> <hr>
          <a href="{{route('admin.vehicleDetails.create')}}" class="btn btn-primary">New Vehicle</a> 
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

         
<!-- Main Cupboard -->
        <div class="card">
         <div class="card-body">
         
<!-- Sub Cupboards Row 1 -->
         <div class="row">
             <!-- Sub Cupboards 1-->
             <div class="col-2">
                <div class="card">
                    <div class="card-body">
                         <!-- Sub Cupboards 1 Row 1-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 1 Row 2-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 1 Row 3-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>
                    </div>
                </div>    
             </div>
             <!-- Sub Cupboards 2-->
             <div class="col-2">
                <div class="card">
                    <div class="card-body">
                        <!-- Sub Cupboards 2 Row 1-->
                        <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 2 Row 2-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 2 Row 3-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                    </div>
                </div>  
            </div>
             <!-- Sub Cupboards 3-->
            <div class="col-2">
                <div class="card">
                    <div class="card-body">
                        <!-- Sub Cupboards 3 Row 1-->
                        <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 3 Row 2-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 3 Row 3-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                    </div>
                </div>  
            </div>
         </div>


<!-- Sub Cupboards Row 2 -->
         <div class="row">
             <!-- Sub Cupboards 4-->
             <div class="col-2">
                <div class="card">
                    <div class="card-body">
                        <!-- Sub Cupboards 4 Row 1-->
                        <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 4 Row 2-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 4 Row 3-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                    </div>
                </div>    
             </div>
             <!-- Sub Cupboards 5-->
             <div class="col-2">
                <div class="card">
                    <div class="card-body">
                        <!-- Sub Cupboards 5 Row 1-->
                        <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 5 Row 2-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 5 Row 3-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                    </div>
                </div>  
            </div>
             <!-- Sub Cupboards 6-->
            <div class="col-2">
                <div class="card">
                    <div class="card-body">
                        <!-- Sub Cupboards 6 Row 1-->
                        <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 6 Row 2-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                            <!-- Sub Cupboards 6 Row 3-->
                            <div>
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>    
                            </div>

                    </div>
                </div>  
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
   <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

   <script>
  
  $(document).ready(function(){
      $('#vehicle').DataTable({
        processing:true,
      });    
      
} );   
            
       
   </script>
@endsection