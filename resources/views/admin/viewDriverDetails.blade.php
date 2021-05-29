
@extends('layouts.admin')

@section('content')   
   <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

  
   <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-8 col-sm-6 lg-col-6">
        <h1 class="m-0 text-dark">Driver Details </h1> 
          
      </div><!-- /.col -->


      <!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<hr>
  

          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-lg-6" >
                <div class="card card-primary border-primary card-outline" style="width: 500px; border-width:3px; border-bottom:none; border-top: none; ">
                  <div class="card-body box-profile">
                   <div class="text-center">
                     <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('/img/'. $dInfo->avatar)}}" style="width: 80px; height:80px;"
                       alt="User profile picture">
                   </div>
               
                <h4 class="profile-username text-center">{{$dInfo->nameInt}}</h4>
                <p class="text-muted text-center">{{$dInfo->email}}</p>
            
                <div class=" input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-sm">Full Name</span>
                  </div>
                  <input type="text" name="name" value="{{$dInfo->name}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style="width:250px; background-color: white;" readonly >
                </div>

                <div class=" input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-sm">Date of Birth</span>
                  </div>
                  <input type="text" name="bday" value="{{$dInfo->bday}}"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style="width:250px; background-color: white;" readonly >
                </div>
  
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">NIC</span>
                </div>
                <input type="text" name="NIC" value="{{$dInfo->NIC}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
              </div>
  
              <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">Address</span>
                  </div>
                  <input type="text" name="address" value="{{$dInfo->address}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                </div>

                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">Mobile</span>
                  </div>
                  <input type="text" name="mobile" value="{{$dInfo->mobile}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                </div>
    
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:130px;">Other Contact</span>
                    </div>
                    <input type="text" name="OCName" value="{{$dInfo->otherName}}" aria-label="First name" class="form-control" style="width:250px; background-color: white;" readonly >
                    <div class="input-group-prepend">
                        <span class="input-group-text">Contact No.</span>
                      </div>
                    <input type="text" name="OCNumber" value="{{$dInfo->otherTel}}" aria-label="Last name" class="form-control" style="width:250px; background-color: white;" readonly >
                  </div>
    
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">Home Tel. No.</span>
                    </div>
                    <input type="text" name="homeTel" value="{{$dInfo->homeTel}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                  </div>
    
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">Marriage Status</span>
                    </div>
                    <input type="text" name="homeTel" value="{{$dInfo->MStatus}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                  </div>
                </div>
              </div>
            </div>


                  <div class="col-12 col-lg-6">

                    <div class="card card-danger border-danger card-outline" style="width: 500px; height:260px; border-width:3px; border-bottom:none; border-top: none;">
                      <div class="card-body box-profile">
          
                  <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:150px;"  id="inputGroup-sizing-default">Zone</span>
                      </div>
                      <input type="text" name="homeTel" value="{{$dInfo->zone}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>
          
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Registered Date</span>
                      </div>
                      <input type="text" name="homeTel" value="{{$dInfo->regDate}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly >
                    </div>
          
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:150px;"  id="inputGroup-sizing-default">Appointment Grade</span>
                      </div>
                          <input type="text" name="homeTel" value="{{$dInfo->appointGrade}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly > 
                     
                    </div>
          
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:150px;"  id="inputGroup-sizing-default">Current Grade</span>
                      </div>
                      <input type="text" name="homeTel" value="{{$dInfo->currentGrade}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="width:250px; background-color: white;" readonly > 
                    </div>
          
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="width:120px;">Basic Salary</span>
                      </div>
                      <input type="text" name="BSalary" value="{{$dInfo->basicSalary}}" aria-label="First name" class="form-control" style="width:250px; background-color: white;" readonly>
                      <div class="input-group-prepend">
                          <span class="input-group-text">Current Salary</span>
                        </div>
                      <input type="text" name="CSalary" value="{{$dInfo->currentSalary}}" aria-label="Last name" class="form-control" style="width:250px; background-color: white;" readonly>
                    </div>
          
                      </div>
                  </div>
               
            
                        <div class="card card-danger border-danger card-outline" style="width: 500px; height:280px;  border-width:3px;border-bottom:none; border-top: none;">
                            <div class="card-body box-profile">
            
                            <table class="table-sm">
                                <tr>
                                  <th style="text-align: center;">Prev. Work Place</th>
                                  <th><br></th>
                                  <th><br></th>
                                  <th><br></th>
                                  <th><br></th>
                                  <th style="text-align: center;">From</th>
                                  <th><br></th>
                                  <th><br></th>
                                  <th><br></th>
                                  <th><br></th>
                                  <th style="text-align: center;">To</th>
                                </tr>
                               @foreach(App\driverWorkplace::where('NIC','=',$dInfo->NIC)->get() as $d)
                                <tr>
                                  <td style="text-align: center;"> {{$d->workPlace}}</td>
                                  <td><br> </td>
                                  <td><br> </td>
                                  <td><br> </td>
                                  <td><br> </td>
                                  <td style="text-align: center;">{{$d->workFrom}}</td>
                                  <td><br> </td>
                                  <td><br> </td>
                                  <td><br> </td>
                                  <td><br> </td>
                                  <td style="text-align: center;">{{$d->workTo}}</td>
                                </tr>
                               @endforeach
                                
                              </table>
                              
                                
                            </div>
                    </div>
                   </div>
                  </div>




                  </div>
              </div>
            </div>
          </div>
             
         
     
              
           
            


        <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
        <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        

        <script>
            $('#dist').on('change', function(e){
        console.log(e);
        var d_id = e.target.value;
        $.get('/json-getzone?d_id=' + d_id,function(data) {
          console.log(data);
          $('#zones').empty();
          $('#zones').append('<option value="0" disabled="true" selected="true">- Select -</option>');
          

          $.each(data, function(index, zoneObj){
            $('#zones').append('<option value="'+ zoneObj.zone+'">'+ zoneObj.zone+'</option>');
          })
        });
      });

      $('#zones').on('change', function(e){
        console.log(e);
        var z_id = e.target.value;
        $.get('/json-getdiv?z_id=' + z_id,function(data) {
          console.log(data);
          $('#divisions').empty();
          $('#divisions').append('<option value="0" disabled="true" selected="true">- Select -</option>');
          

          $.each(data, function(index, divObj){
            $('#divisions').append('<option value="'+ divObj.divName+'">'+ divObj.divName+'</option>');
          })
        });
      });

      $('#divisions').on('change', function(e){
        console.log(e);
        var div_id = e.target.value;
        $.get('/json-getbranch?div_id=' + div_id,function(data) {
          console.log(data);
          $('#branches').empty();
          $('#branches').append('<option value="0" disabled="true" selected="true">- Select -</option>');
          

          $.each(data, function(index, divObj){
            $('#branches').append('<option value="'+ divObj.branchName+'">'+ divObj.branchName+'</option>');
          })
        });
      });
        </script>

@endsection