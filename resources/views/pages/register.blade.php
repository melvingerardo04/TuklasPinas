<html>
<head>

</head>
<body>
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" >
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                
                <div class="panel-body">
                    <!--
                    <div class="form-inline">
                        <div class="form-group col-md-6">
                            <label>Name: </label>
                            <input type="" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                                <label>Name: </label>
                                <input type="" class="form-control">
                            </div>
                    </div>
                -->
                  
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                         
                                <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                                    <label for="firstName" class="col-md-4 control-label">First Name</label>

                                    <div class="col-md-6">
                                        <input id="firstName" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}" required autofocus autocomplete="off">

                                        @if ($errors->has('firstName'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('firstName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                             
                                    <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                                        <label for="lastName" class="col-md-4 control-label">Last Name</label>

                                        <div class="col-md-6">
                                            <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus autocomplete="off">

                                            @if ($errors->has('lastName'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('lastName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                  

                                <table style="margin-left:160px;">
                                    <tr>
                                        <td>
                                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                                <label for="age" class="col-md-4 control-label"> Age</label>
                                                    <div class="col-md-4">
                                                        <input id="age" type="number" class="form-control" name="age" value="{{ old('age') }}" required autofocus autocomplete="off">
                                                            @if ($errors->has('age'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('age') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>
                                            </div>
                                        </td>    
                                   
                                        <td>    
                                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}" >
                                                <label for="gender" class="col-md-5 control-label"> Gender</label>
                                                    <div class="col-md-7" >
                                                        {!! Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), 'Male',['class' => 'form-control']); !!}
                                                            @if ($errors->has('gender'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                                </span>
                                                            @endif
                                                         
                                                    </div>
                                            </div>
                                        </td>
                                              
                                </table>
                                <div class="form-group{{ $errors->has('userType') ? ' has-error' : '' }}">
                                    <label for="userType" class="col-md-4 control-label"> User Type</label>

                                    <div class="col-md-3">
                                        {!! Form::select('userType', array('Traveler' => 'Traveler', 'Tourguide' => 'Tourguide'), 'Traveler',['class' => 'form-control']); !!}
                                        @if ($errors->has('userType'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('userType') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                        
                                    
                             
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                               
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="off">

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                       

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                    </form>

                
                </div>
                
            </div>
        </div>
    </div>
</div>
 
@endsection

</body>
</html>
