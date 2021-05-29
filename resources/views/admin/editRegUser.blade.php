@extends('layouts.admin')

@section('content')

   <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

   <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-8 col-sm-6 lg-col-6">
        <h1 class="m-0 text-dark">Edit Registered User</h1>
          
      </div><!-- /.col -->


      <!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<hr>

          <div class="col-4 offset-3 mt-2">
            <form method="post" action="/editedRegUser/{{$edit->id}}">
              {{csrf_field()}}
                <div class="card card-primary border-primary card-outline" style="width: 500px;border-width:3px; border-bottom:none; border-top: none;">
                  <div class="card-body box-profile">
                   <div class="text-center">
                    
                     <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('/img/'. $edit->avatar)}}" style="width: 80px; height:80px;"
                       alt="User profile picture">
                     
                   </div>
            
                <h4 class="profile-username text-center">{{$edit->name}}</h4>
                <p class="text-muted text-center">{{$edit->email}}</p>
              
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>District</b> <a class="float-right">
                        <select name="district" id="dist" class="form-control" style="width:250px;" required>
                        <option value="" hidden selected >-select-</option>
                        @foreach($dis as $key => $value)
                        <option value="{{$value->district}}" {{$value->district == $edit->district ? 'selected':''}}>{{$value->district}}</option>
                        @endforeach
                        </select></a>
                    </li>
                    <li class="list-group-item">
                      <b>Zone</b> 
                        <a class="float-right">
                          <select name="zone" id="zones" class="form-control" style="width:250px;" required>
                         
                          <option value="{{$edit->zone}}" selected="true">{{$edit->zone}}</option>;
                          </select>
                        </a>
                    </li>
                   
                    <li class="list-group-item">
                        <b>Branch</b> 
                          <a class="float-right"> 
                          <select name="branch" id="branches" class="form-control" style="width:250px;" required>
                          @foreach($bra as $key => $value)
                          <option value="{{$value->branchName}}" {{$value->branchName == $edit->branch ? 'selected':''}}>{{$value->branchName}}</option>;
                          @endforeach
                          </select>
                        </a>
                      </li>

                      <li class="list-group-item">
                        <b>Position</b> 
                          <a class="float-right"> 
                          <select name="position" id="position" class="form-control" style="width:250px;" required>
                      
                          <option value="{{$edit->position}}">{{$edit->position}}</option>
                          <option value="Clarke">Clarke</option>
                          <option value="Manager">Manager</option>
                          <option value="Assistant Director">Assistant Director</option>
                          </select>
                        </a>
                      </li>

                      <li class="list-group-item">
                        <b>Preferred Role</b> 
                          <a class="float-right"> 
                          <input name="preRole" id="preRoles" class="form-control" style="width:250px;" value="{{$edit->preRole}}" required>
                        </a>
                      </li>

                      <li class="list-group-item">
                        <b>Role</b> 
                          <a class="float-right"> 
                          <select name="Role" id="Roles" class="form-control" style="width:250px;" required>
                          <option value="{{$edit->role}}">{{$edit->role}}</option>
                            <option value="Admin">Admin</option>
                            <option value="Zonal Admin">Zonal Admin</option>
                            <option value="Director">Director</option>
                            <option value="User">User</option>
                            <option value="Manager">Manager</option>
                          </select>
                        </a>
                      </li>
                  </ul>

                <button class="btn btn-primary btn-block" type="submit"><b>Edit Profile</b></button>
              </div>
            </div>
              </form>
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
        $.get('/json-getbranch?z_id=' + z_id,function(data) {
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