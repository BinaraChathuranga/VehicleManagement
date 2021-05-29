
@extends('layouts.admin')

@section('content')   
   <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

   <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-8 col-sm-6 lg-col-6">
        <h1 class="m-0 text-dark">Insert Driver Details </h1> 
          
      </div><!-- /.col -->


      <!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<hr>

  

   <div class="container-fluid">
    <div class="card">
        <div class="card-body">
          <form action="{{route('admin.driverDetails.store')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
       <div class="row">
           <div class="col-12 col-lg-6" >
                <div class="card card-primary border-primary card-outline" style="width: 500px;border-width:3px;border-bottom:none; border-top: none; ">
                  <div class="card-body box-profile">
                    
            <div class=" input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-sm">Full Name</span>
              </div>
              <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>

            <div class=" input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-sm">Name with Initials</span>
                </div>
                <input type="text" name="nameIn" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
              </div>

              <div class=" input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-sm">Date of Birth</span>
                </div>
                <input type="date" name="bday" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
              </div>

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">NIC</span>
              </div>
              <input type="text" name="NIC" class="form-control" pattern="([0-9]{9}[V]|[0-9]{12})"  title="Please enter valid old or new NIC No." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">Address</span>
                </div>
                <input type="text" name="address" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
              </div>
              

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">Email</span>
              </div>
              <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">Mobile</span>
              </div>
              <input type="text" name="mobile" class="form-control" pattern="[0-9]{10}" title="Please enter Contact number with 10 digits" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:130px;">Other Contact</span>
                </div>
                <input type="text" name="OCName" aria-label="First name" class="form-control">
                <div class="input-group-prepend">
                    <span class="input-group-text">Contact No.</span>
                  </div>
                <input type="text" name="OCNumber" pattern="[0-9]{10}" title="Please enter Contact number with 10 digits" aria-label="Last name" class="form-control" required>
              </div>

              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:130px;" id="inputGroup-sizing-default">Home Tel. No.</span>
                </div>
                <input type="text" name="homeTel" pattern="[0-9]{10}" title="Please enter Contact number with 10 digits" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>

              <div class="input-group input-group-sm mb-3" style="width: 250px;">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width:130px;"  id="inputGroup-sizing-default">Marriage Status</span>
                </div>
                <select class="form-control" name="mStatus" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"  required>
                    <option value="0" selected="true" disabled>--Select--</option>
                    <option value="Unmarried" selected="true">Unmarried</option>
                    <option value="Married" selected="true">Married</option>

                </select>
              </div>

            <div class="input-group  input-group-sm mb-3">
              <div class="custom-file">
                <input type="file" name="avatar" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Upload Profile Image</label>
              </div>
            </div>


      </div>
        </div>
       </div>

       <div class="col-12 col-lg-6">
        <div class="card card-primary border-danger card-outline" style="width: 500px; border-width:3px; height:260px; border-bottom:none; border-top: none; ">
            <div class="card-body box-profile">

        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" style="width:150px;"  id="inputGroup-sizing-default">Zone</span>
            </div>
            <select class="form-control" name="zone" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                <option value="0" selected="true" disabled>--Select--</option>
                @foreach($zone as $z)
                <option value="{{$z->zone}}">{{$z->zone}}</option>
                @endforeach
            </select>
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" style="width:150px;" id="inputGroup-sizing-default">Registered Date</span>
            </div>
            <input type="date" name="registeredDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" style="width:150px;"  id="inputGroup-sizing-default">Appointment Grade</span>
            </div>
            <input class="form-control" name="appointGrade" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" style="width:150px;"  id="inputGroup-sizing-default">Current Grade</span>
            </div>
            <input class="form-control" name="currentGrade" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>

          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" style="width:120px;">Basic Salary</span>
            </div>
            <input type="text" name="BSalary" pattern="[0-9]+" title="You cannot enter letters here" aria-label="First name" class="form-control" required>
            <div class="input-group-prepend">
                <span class="input-group-text">Current Salary</span>
              </div>
            <input type="text" name="CSalary" pattern="[0-9]+" title="You cannot enter letters here" aria-label="Last name" class="form-control" required>
          </div>

            </div>
        </div>

            <div class="card card-primary border-danger card-outline" style="width: 500px;border-width:3px; height:280px;border-bottom:none; border-top: none; ">
                <div class="card-body box-profile">

                  <table class="table-sm">
                    <tr>
                      <th>Prev. Work Place</th>
                      <th>From</th>
                      <th>To</th>
                    </tr>

                    <tr>
                      <td>
                        <div class="input-group input-group-sm ">
                          <input class="form-control" name="PWP1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="from1" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="to1" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="input-group input-group-sm ">
                          <input class="form-control" name="PWP2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="from2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="to2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="input-group input-group-sm ">
                          <input class="form-control" name="PWP3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="from3" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="to3" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="input-group input-group-sm ">
                          <input class="form-control" name="PWP4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="from4" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="to4" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="input-group input-group-sm ">
                          <input class="form-control" name="PWP5" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="from5" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>

                      <td>
                        <div class=" input-group input-group-sm ">
                          <input type="date" name="to5" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <br>
                  <button class="btn btn-primary btn-sm float-right btn-block mt-2" type="submit"><b>Submit</b> </button>
    
            
    
                </div>
        </div>
       </div>
      </div>
    </form>
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