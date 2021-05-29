@extends('layouts.app')

@section('content')


        
 
    
    

<div class="container" style="width: 850px;">
    <div class="row"  >
        <div class="col-md-8 col-md-offset-2" >
            <div class="panel panel-default" >
                <div class="panel-heading">Login</div>

                
                    

                <div class="panel-body" style="background-color: grey; height: 400px;">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                            <br><br>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label" style="color: honeydew;">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <h6>{{ $errors->first('email') }}</h6>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <br>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label" style="color: honeydew;">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <h6>{{ $errors->first('password') }}</h6>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label style="color: honeydew; margin-left:100px ;">
                                        <input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="margin-left: 180px;">
                                    Login
                                </button>

                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

</body>

@endsection
