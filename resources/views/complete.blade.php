
   <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

  


   <div class="col-8 offset-2 mt-2">
    <h4 style="margin-left:185px;">Hey <b>{{Auth::user()->name}}</b>, Welcome To Vehicle Management System</h4>
    <h5 style="margin-left:300px; color: red;">Please complete your profile to continue</h5>    
   </div>

           <div class="col-4 offset-4 mt-2">
            <form method="post" action="/completeUser/{{Auth::user()->id}}">
              {{csrf_field()}}
                <div class="card card-primary card-outline" style="width: 500px; border-bottom:none; border-top: none;">
                  <div class="card-body box-profile">
                   <div class="text-center">
                     <img class="profile-user-img img-fluid img-circle"
                       src="{{asset(Auth::user()->avatar)}}" style="width: 80px; height:80px;"
                       alt="User profile picture">
                   </div>
            
                <h4 class="profile-username text-center">{{Auth::user()->name}}</h4>
                <p class="text-muted text-center">{{Auth::user()->email}}</p>
            
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>District</b> <a class="float-right">
                        <select name="district" id="dist" class="form-control" style="width:250px;" required>
                        <option value="" hidden selected >-select-</option>
                        @foreach($dis as $d)
                        <option value="{{$d->district}}">{{$d->district}}</option>
                        @endforeach
                        </select></a>
                    </li>
                    <li class="list-group-item">
                      <b>Zone</b> 
                        <a class="float-right">
                          <select name="zone" id="zones" class="form-control" style="width:250px;" required>
                          </select>
                        </a>
                    </li>
        
                    <li class="list-group-item">
                        <b>Branch</b> 
                          <a class="float-right"> 
                          <select name="branch" id="branches" class="form-control" style="width:250px;" required>
                          </select>
                        </a>
                      </li>

                      <li class="list-group-item">
                      <b>Position</b> <a class="float-right">
                        <select name="position" id="position" class="form-control" style="width:250px;" required>
                        <option value="" hidden selected >-select-</option>
                      
                        <option value="Clarke">Clarke</option>
                        <option value="Manager">Manager</option>
                        <option value="Assistant Director">Assistant Director</option>
                      
                        </select></a>
                    </li>

                      <li class="list-group-item">
                        <b>Preferred Role</b> 
                          <a class="float-right"> 
                          <select name="preRole" id="preRoles" class="form-control" style="width:250px;" required>
                            <option value="Admin">Admin</option>
                            <option value="Zonal Admin">Zonal Admin</option>
                            <option value="Director">Director</option>
                            <option value="User">User</option>
                            <option value="Manager">Manager</option>
                          </select>
                        </a>
                      </li>
                  </ul>

                <button class="btn btn-primary btn-block" type="submit"><b>Complete Profile</b></button>
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

