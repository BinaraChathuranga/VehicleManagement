
@extends('layouts.user')

@section('content')

<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-4">
          <h1 class="m-0 text-dark">Reserve Vehicle</h1><hr>
          
        </div><!-- /.col -->




        <!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
 
  <!-- /.content-header -->

  <!-- Main content -->

  

    <section class="content">
        <div class="container-fluid">

          
            <div class="card">
              
              
                <div class="card-body">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newReserve">
                    New Reserve
                  </button>
                  <center>
                  <div class="row">
                   <div class="col-12 col-lg-12" >
                       
                   <div class="card card-primary border-primary card-outline mt-2" style=" border-width:3px; border-bottom:none; border-top:none;">
                    <h6 style="color: gray;" class="mt-2">  &nbsp; &nbsp; Vehicle Details</h6>
                          <div class="card-body box-profile">                          
                            {!! $calendar->calendar() !!}
                            {!! $calendar->script() !!}

                 </div>
                </div>
               </div>
              </div>
                  </center>
             </div>
              
            </div>
          

            <!-- New Reservation Modal -->

           

        
         </div>
            </div>
          </div>
        </div>
    </section>

    



  
@endsection
