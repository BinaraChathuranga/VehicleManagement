
@extends('layouts.zonalAdmin')

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
          <h1 class="m-0 text-dark">Service/Renew Parts</h1> <hr>
         
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
        

        <div class="card">
        <h3 class="m-0 text-dark ml-3 mt-3"> Vehicle No : {{$vParts->vNo}}</h3>
          

         <div class="card-body">
    <table class="table table-striped table-bordered" id="vehi">
      <thead>
        <tr>
            <th style="text-align: center;" hidden>Vehicle No</th>
            <th style="text-align: center;">Part Name</th>
            <th style="text-align: center;">Service Mileage</th>
            <th style="text-align: center;">Current Mileage</th>
            <th hidden></th>
            <th hidden></th>
            <th style="text-align: center;">Action</th>

            
            
           
        </tr>
        </thead>
        <tbody>
         @foreach(App\vehiclePart::where('vNo','=',$vParts->vNo)->get(); as $vParts)
         @if(($vParts->partName != "Full Service") && ($vParts->currentMileage > $vParts->remindMileage) && ($vParts->serviceStatus == "Not at Service"))
        <tr class="table-danger">
            <td style="text-align: center;" hidden>{{$vParts->vNo}}</td>
            <td style="text-align: center;">{{$vParts->partName}}</td>
            <td style="text-align: center;">{{$vParts->serviceMileage}}</td>
            <td style="text-align: center;">{{$vParts->currentMileage}}</td> 
            <td hidden>{{$vParts->id}}</td> 
            <td hidden>{{$vParts->remindMileage}}</td>         
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="#" class="btn btn-success service" style="width: 120px;" >Renew Part</a>
                <a href="#" class="btn btn-primary extend" style="width: 140px;" >Extend Remind</a>
              </div>
            </td>    
        </tr>

        @elseif(($vParts->partName != "Full Service") && ($vParts->currentMileage > $vParts->remindMileage) && ($vParts->serviceStatus == "At Service"))
        <tr class="table-danger">
            <td style="text-align: center;" hidden>{{$vParts->vNo}}</td>
            <td style="text-align: center;">{{$vParts->partName}}</td>
            <td style="text-align: center;">{{$vParts->serviceMileage}}</td>
            <td style="text-align: center;">{{$vParts->currentMileage}}</td> 
            <td hidden>{{$vParts->id}}</td> 
            <td hidden>{{$vParts->remindMileage}}</td>         
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="#" class="btn btn-warning serviced" style="width: 150px;" >Mark as Serviced</a>
                <a href="#" class="btn btn-primary extend" style="width: 140px;" >Extend Remind</a>
              </div>
            </td>    
        </tr>

        @elseif(($vParts->partName == "Full Service") && ($vParts->currentMileage > $vParts->remindMileage) && ($vParts->serviceStatus == "Not at Service"))
        <tr class="table-warning">
            <td style="text-align: center;" hidden>{{$vParts->vNo}}</td>
            <td style="text-align: center;">{{$vParts->partName}}</td>
            <td style="text-align: center;">{{$vParts->serviceMileage}}</td>
            <td style="text-align: center;">{{$vParts->currentMileage}}</td>
            <td hidden>{{$vParts->id}}</td> 
            <td hidden>{{$vParts->remindMileage}}</td>          
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="#" class="btn btn-success service" style="width: 100px;" >Service</a>
                <a href="#" class="btn btn-primary extend" style="width: 140px;" >Extend Remind</a>
              </div>
            </td>    
        </tr>

        @elseif(($vParts->partName == "Full Service") && ($vParts->currentMileage > $vParts->remindMileage) && ($vParts->serviceStatus == "At Service"))
        <tr class="table-warning">
            <td style="text-align: center;" hidden>{{$vParts->vNo}}</td>
            <td style="text-align: center;">{{$vParts->partName}}</td>
            <td style="text-align: center;">{{$vParts->serviceMileage}}</td>
            <td style="text-align: center;">{{$vParts->currentMileage}}</td>
            <td hidden>{{$vParts->id}}</td> 
            <td hidden>{{$vParts->remindMileage}}</td>       
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="#" class="btn btn-warning serviced" style="width: 150px;" >Mark as Serviced</a>
                <a href="#" class="btn btn-primary extend" style="width: 140px;" >Extend Remind</a>
              </div>
            </td>    
        </tr>

        @elseif(($vParts->currentMileage < $vParts->remindMileage) && ($vParts->partName != "Full Service") )

        <tr>
            <td style="text-align: center;" hidden>{{$vParts->vNo}}</td>
            <td style="text-align: center;">{{$vParts->partName}}</td>
            <td style="text-align: center;">{{$vParts->serviceMileage}}</td>
            <td style="text-align: center;">{{$vParts->currentMileage}}</td>   
            <td hidden>{{$vParts->id}}</td> 
            <td hidden>{{$vParts->remindMileage}}</td>       
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="#" class="btn btn-success service" style="width: 100px;" >Service</a>
                <a href="#" class="btn btn-secondary edit" style="width: 100px;" >Edit</a>
              </div>
            </td>    
        </tr>

        @elseif(($vParts->currentMileage < $vParts->remindMileage) && ($vParts->partName == "Full Service") )

        <tr>
            <td style="text-align: center;" hidden>{{$vParts->vNo}}</td>
            <td style="text-align: center;">{{$vParts->partName}}</td>
            <td style="text-align: center;">{{$vParts->serviceMileage}}</td>
            <td style="text-align: center;">{{$vParts->currentMileage}}</td>     
            <td hidden>{{$vParts->id}}</td> 
            <td hidden>{{$vParts->remindMileage}}</td>     
            <td style="text-align: center;">
              <div class="btn-group">
                <a href="#" class="btn btn-success service" style="width: 100px;" >Service</a>
              </div>
            </td>    
        </tr>
        @endif

        @endforeach
        </tbody>
           
    </table>

   
        </div>
        </div>

        <!-- service parts -->
        <div class="modal fade" id="addServiceDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/zonalAdmin/addServiceDetails" method="POST">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Service Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Vehicle No</span>
          </div>
          <input class="form-control" name="vehNo" id="vehNo" value="">
          
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Part Name</span>
          </div>
          <input class="form-control " name="partName" id="parName" value="">
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Service At</span>
          </div>
          <input class="form-control" name="servicedAt" value="">
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Service Start Date</span>
          </div>
          <input type="date" class="form-control" name="serviceStart" value="" required>
        </div>

      
          </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
  </div>
</div>

 <!-- serviced Parts -->
 <div class="modal fade" id="ServicedDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/zonalAdmin/ServicedDetails" method="POST">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Serviced Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Vehicle NO</span>
          </div>
          <input class="form-control" name="vehNo" id="veNo" value="" required>
  
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Part Name</span>
          </div>
          <input class="form-control " name="partName" id="paName" value="" required>
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Service Details</span>
          </div>
          <textarea class="form-control" name="serviceDetails" value="" required></textarea>
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Service End Date</span>
          </div>
          <input type="date" class="form-control" name="serviceEnd" value="" required>
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Payment</span>
          </div>
          <input type="text" class="form-control" name="payment" value="" required>
        </div>

      
          </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
  </div>
</div>

  <!-- Extend Mileage -->

  <div class="modal fade" id="extend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="/zonalAdmin/extendMileage" method="POST" id="extendMileage">
          {{csrf_field()}}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Extend Mileage</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-sm mb-3" hidden>
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Fuel Balance</span>
            </div>
            <input class="form-control" name="vNo" id="vNo" value="" required>
            <input class="form-control " name="partName" id="partName" value=""> required
          </div>
  
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Extend Mileage</span>
            </div>
            <input class="form-control fuelBal" name="extendMileage" value="" required>
          </div>
  
        
            </div>
  
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
    </div>
  </div>

  <!-- Edit Service Parts -->

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="/zonalAdmin/editPartsDetails" method="POST">
          {{csrf_field()}}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Parts Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-sm mb-3" hidden>
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Fuel Balance</span>
            </div>
            <input class="form-control" name="partId" id="partId" value="" required>
          </div>
  
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Part Name</span>
            </div>
            <input class="form-control fuelBal" name="partName" id="pName" required>
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Service Mileage</span>
            </div>
            <input class="form-control fuelBal" name="serviceMileage" id="serviceMileage" required>
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 130px;">Remind Mileage</span>
            </div>
            <input class="form-control fuelBal" name="remindMileage" id="remindMileage" required>
          </div>

            </div>
  
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
    </div>
  </div>
        </div>
         <!-- Button trigger modal -->


<!-- Modal -->
    </div>
    </section>
    <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
    <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
      $(document).ready(function(){
    var table=$('#vehi').DataTable();  

      table.on('click','.extend',function(){
        $tr=$(this).closest('tr');
        if ($($tr).hasClass('child')){
          $tr=$tr.prev('.parent');
        }

        var data = table.row($tr).data();
        console.log(data);

        $('#vNo').val(data[0]);
        $('#partName').val(data[1]);
       

        $('#extend').modal('show');
      });  

      table.on('click','.service',function(){
      $tr=$(this).closest('tr');
      if ($($tr).hasClass('child')){
        $tr=$tr.prev('.parent');
      }

      var data = table.row($tr).data();
      console.log(data);

      $('#vehNo').val(data[0]);
      $('#parName').val(data[1]);
     
      $('#addServiceDetails').modal('show');
    });  

    table.on('click','.serviced',function(){
      $tr=$(this).closest('tr');
      if ($($tr).hasClass('child')){
        $tr=$tr.prev('.parent');
      }

      var data = table.row($tr).data();
      console.log(data);

      $('#veNo').val(data[0]);
      $('#paName').val(data[1]);
     
      $('#ServicedDetails').modal('show');
    });  

    table.on('click','.edit',function(){
      $tr=$(this).closest('tr');
      if ($($tr).hasClass('child')){
        $tr=$tr.prev('.parent');
      }

      var data = table.row($tr).data();
      console.log(data);

      $('#partId').val(data[4]);
      $('#pName').val(data[1]);
      $('#serviceMileage').val(data[2]);
      $('#remindMileage').val(data[5]);
     
      $('#editModal').modal('show');
    });  
} ); 

    </script>

  

@endsection
