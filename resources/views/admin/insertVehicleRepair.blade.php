
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
          <h1 class="m-0 text-dark">Repair </h1> <hr>
         
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

          <h1 class="m-0 text-dark mb-3">Vehicle No : {{$vehicle->vehicleNoRepair}} </h1>

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
          
          @if($vehicle->repairType == "Annual Repair")
          <form action="/admin/completedRepair" method="POST">
            {{csrf_field()}}

          <div class="row">
          <div class="col-lg-2 col-6">
          <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Repaired At</span>
              </div>
              <input type="text" name="repairAt" id="repairAt" class="form-control" style="width:200px;" value="{{$vehicle->garageName}}" readonly>
            </div>
          </div>

          <div class="col-lg-2 col-6">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Repair Started</span>
                </div>
                <input type="date" name="repairStarted" id="repairStarted" class="form-control" style="width:120px;" value="{{$vehicle->repairStarted}}" readonly>
              </div>
            </div>

            <div class="col-lg-2 col-6">
              <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Repair Ended</span>
                  </div>
                  <input type="date" name="repairEnded" id="repairEnded" class="form-control" style="width:120px;" required>
                </div>
              </div>

                <div class="col-lg-2 col-6">
                  <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Payment</span>
                      </div>
                      <input type="text" name="payment" id="payment" class="form-control" style="width:120px;" required>
                    </div>
                  </div>

                  <div class="col-lg-2 col-6">
                  <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Bill No.</span>
                      </div>
                      <input type="text" name="bill" id="bill" class="form-control" style="width:120px;" required>
                    </div>
                  </div>
          </div>


                   <input type="text" hidden name="vNo" class="form-control" style="width:140px" value="{{$vehicle->vehicleNoRepair}}" readonly>
                   <input type="text" hidden name="zone"  id="zone" value="{{$vehicle->zone}}" class="form-control" readonly>
                   <input type="text" hidden name="idR"  id="idR" value="{{$vehicle->id}}" class="form-control" readonly>
                   
                   
                   
                   
      <div class="row"> 
        <div class="col-lg-2 col-12">
        <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Police Re. No.</span>
                </div>
                <input type="text" name="police" id="police" class="form-control" value="-" style="width:140px;"  readonly>
              </div>
            </div>
        
        
        <div class="col-lg-2 col-12">
        <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Insuarance Re. No.</span>
                </div>
                <input type="text" name="insuarance" id="insuarance" class="form-control" value="-" style="width:140px;"  readonly>
              </div>
            </div>
        

        <div class="col-lg-2 col-12">
        <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default"> Repair Details</span>
                    </div>
                    <textarea name="repairDetails" id="repairDetails" class="form-control"></textarea>
                  </div>
        </div> 

        <div class="col-lg-2 col-12">
        </div>
        
        <div class="col-lg-4 col-12">
          <div class="table-responsive">
          
            <table class="table" style="border: none;">
              <thead>
                <tr>
                  <th style="border: none;"></th>
                  <th style="border: none; text-align: center;">Parts Replaced</th>
                  <th style="border: none;"><a href="#" class="btn btn-primary addRow"> + </a></th>
                </tr>
               </thead>
            <tbody id="ttt" class="tbody">
               
                <tr>    
                   <td style="border: none;"><input type="text" hidden name="veNo[]" class="form-control" style="width:140px" value="{{$vehicle->vehicleNoRepair}}" readonly></td>
                   <td style="border: none;">
                   <select name="partName[]" id="partName" class="form-control">
                   @foreach(App\vehiclePart::where('vNo','=',$vehicle->vehicleNoRepair)->where('partName','!=','Full Service')->get(); as $vParts)
                   <option value="{{$vParts->partName}}">{{$vParts->partName}}</option>
                   @endforeach
                   </select>
                   </td>
                   <td style="border: none;"><a href="#" class="btn btn-danger remove">X</a></td>
                 </tr>
                
                                         
              </tbody>
             
                <tfoot>
                  <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none; text-align: right;"><input type="submit" name="" value="Submit" class="btn btn-success btn-sm float-left" style="width:60px;"></td>
                  </tr>
                </tfoot>
              </table>
          </div>
          </div>
        </div>
            </form>


            @elseif($vehicle->repairType != "Annual Repair")
            <form action="/admin/completedRepair" method="POST">
              {{csrf_field()}}
  
            <div class="row">
            <div class="col-lg-2 col-6">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Repaired At</span>
                </div>
                <input type="text" name="repairAt" id="repairAt" class="form-control" style="width:200px;" value="{{$vehicle->garageName}}" readonly>
              </div>
            </div>
  
            <div class="col-lg-2 col-6">
              <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Repair Started</span>
                  </div>
                  <input type="date" name="repairStarted" id="repairStarted" class="form-control" style="width:120px;" value="{{$vehicle->repairStarted}}" readonly>
                </div>
              </div>
  
              <div class="col-lg-2 col-6">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Repair Ended</span>
                    </div>
                    <input type="date" name="repairEnded" id="repairEnded" class="form-control" style="width:120px;" required>
                  </div>
                </div>
  
                  <div class="col-lg-2 col-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Payment</span>
                        </div>
                        <input type="text" name="payment" id="payment" class="form-control" style="width:120px;" required>
                      </div>
                    </div>
  
                    <div class="col-lg-2 col-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default">Bill No.</span>
                        </div>
                        <input type="text" name="bill" id="bill" class="form-control" style="width:120px;" required>
                      </div>
                    </div>
            </div>
  
  
                     <input type="text" hidden name="vNo" class="form-control" style="width:140px" value="{{$vehicle->vehicleNoRepair}}" readonly>
                     <input type="text" hidden name="zone"  id="zone" value="{{$vehicle->zone}}" class="form-control" readonly>
                     <input type="text" hidden name="idR"  id="idR" value="{{$vehicle->id}}" class="form-control" readonly>
                     
                     
                     
                     
        <div class="row"> 
          <div class="col-lg-2 col-12">
          <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Police Re. No.</span>
                  </div>
                  <input type="text" name="police" id="police" class="form-control" style="width:140px;" required>
                </div>
              </div>
          
          
          <div class="col-lg-2 col-12">
          <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:145px;" id="inputGroup-sizing-default">Insuarance Re. No.</span>
                  </div>
                  <input type="text" name="insuarance" id="insuarance" class="form-control" style="width:140px;" required>
                </div>
              </div>
          
  
          <div class="col-lg-2 col-12">
          <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:140px;" id="inputGroup-sizing-default"> Repair Details</span>
                      </div>
                      <textarea name="repairDetails" id="repairDetails" class="form-control"></textarea>
                    </div>
          </div> 
  
          <div class="col-lg-2 col-12">
          </div>
          
          <div class="col-lg-4 col-12">
            <div class="table-responsive">
            
              <table class="table" style="border: none;">
                <thead>
                  <tr>
                    <th style="border: none;"></th>
                    <th style="border: none; text-align: center;">Parts Replaced</th>
                    <th style="border: none;"><a href="#" class="btn btn-primary addRow"> + </a></th>
                  </tr>
                 </thead>
              <tbody id="ttt" class="tbody">
                 
                  <tr>    
                     <td style="border: none;"><input type="text" hidden name="veNo[]" class="form-control" style="width:140px" value="{{$vehicle->vehicleNoRepair}}" readonly></td>
                     <td style="border: none;">
                     <select name="partName[]" id="partName" class="form-control">
                     @foreach(App\vehiclePart::where('vNo','=',$vehicle->vehicleNoRepair)->where('partName','!=','Full Service')->get(); as $vParts)
                     <option value="{{$vParts->partName}}">{{$vParts->partName}}</option>
                     @endforeach
                     </select>
                     </td>
                     <td style="border: none;"><a href="#" class="btn btn-danger remove">X</a></td>
                   </tr>
                  
                                           
                </tbody>
               
                  <tfoot>
                    <tr>
                      <td style="border: none;"></td>
                      <td style="border: none;"></td>
                      <td style="border: none; text-align: right;"><input type="submit" name="" value="Submit" class="btn btn-success btn-sm float-left" style="width:60px;"></td>
                    </tr>
                  </tfoot>
                </table>
            </div>
            </div>
          </div>
              </form>
              @endif
          </div>
        </div>
        </div> 
  

        <!-- view Driver modal -->
        
    </section>

   <script type="text/javascript">
    
   

      $('.addRow').on('click',function(){
          addRow();
      });
      function addRow()
      {
          var tr='<tr>'+
          '<td><input type="text" hidden name="veNo[]" class="form-control" style="width:140px" value="{{$vehicle->vehicleNoRepair}}" readonly></td>'+
          '<td style="border: none;"><select name="partName[]" id="partName" class="form-control">@foreach(App\vehiclePart::where("vNo","=",$vehicle->vehicleNoRepair)->where("partName","!=","Full Service")->get(); as $vParts) <option value="{{$vParts->partName}}">{{$vParts->partName}}</option>@endforeach</select></td>'+
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
