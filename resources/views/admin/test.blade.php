<link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">
   <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">


<select name="veh" id="veh" class="form-control">
    
    @foreach($vehDetails as $v)
<option value="{{$v->type}}">{{$v->type}}</option>
    @endforeach
   
</select>

<table>
    <thead>
    <tr>
        <td>Vehicle No</td>
        <td>Chasis No</td>
    </tr>
    </thead>

    <tbody>
        <td>

        </td>
    </tbody>
</table>

        <script src="{{asset('dist/js/jquery-2.1.0.js')}}"></script>
        <script src="{{asset('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        

        <script>
            $('#veh').on('change', function(e){
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