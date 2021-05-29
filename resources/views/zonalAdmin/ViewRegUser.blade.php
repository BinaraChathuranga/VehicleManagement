
@extends('layouts.admin')

@section('content')   
   <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

  

  

          <div class="col-4 offset-3 mt-2"  >
            <form method="post" action="">
              {{csrf_field()}}
                <div class="card card-primary border-primary card-outline" style="width: 500px; border-width:3px; border-bottom:none; border-top: none; ">
                  <div class="card-body box-profile">
                   <div class="text-center">
                     <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('/img/'. $view->avatar)}}" style="width: 80px; height:80px;"
                       alt="User profile picture">
                   </div>
            
                <h4 class="profile-username text-center">{{$view->name}}</h4>
                <p class="text-muted text-center">{{$view->email}}</p>
            
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item" >
                      <b>District</b> <a class="float-right">
                        <input name="district" id="dist" value="{{$view->district}}" class="form-control" style="width:250px; border:none; background-color: white;" readonly required>
                       </a>
                    </li>
                    <li class="list-group-item">
                      <b>Zone</b> 
                        <a class="float-right">
                          <input name="zone" id="zones" value="{{$view->zone}}" class="form-control" style="width:250px; border:none; background-color: white;" readonly required>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>Branch</b> 
                          <a class="float-right"> 
                          <input name="branch" id="branches" value="{{$view->branch}}" class="form-control" style="width:250px; border:none; background-color: white;" readonly required>
                         
                        </a>
                      </li>

                      <li class="list-group-item">
                        <b>Position</b> 
                          <a class="float-right"> 
                          <input name="branch" id="branches" value="{{$view->position}}" class="form-control" style="width:250px; border:none; background-color: white;" readonly required>
                         
                        </a>
                      </li>

                      <li class="list-group-item">
                        <b>Preferred Role</b> 
                          <a class="float-right"> 
                          <input name="preRole" id="preRoles" value="{{$view->preRole}}" class="form-control" style="width:250px; border:none; background-color: white;" readonly required>
                        </a>
                      </li>

                      <li class="list-group-item">
                      <b>Role</b> 
                          <a class="float-right"> 
                          <input name="Role" id="Roles" value="{{$view->role}}" class="form-control" style="width:250px; border:none; background-color: white;" readonly required>
                        </a>
                        </li>
                  </ul>

                
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