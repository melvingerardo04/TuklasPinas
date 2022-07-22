<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("css/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("css/registerbackground.css")}}" rel="stylesheet" type="text/css" /> 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<style>

    .load{
        animation: slide 4s;
    }
    .slider{
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        width: 100%;
        height: 100vh;
        animation: animate 16s ease-in-out infinite;
    }
    .content{
        color: #fff;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    @keyframes animate {
        0%,100%{
            background-image: url('/img/1.jpg');
        }
        15%{
            background-image: url('/img/2.jpg');
        }
        30%{
            background-image: url('/img/3.jpg');
        }
        45%{
            background-image: url('/img/4.jpg');
        }
        60%{
            background-image: url('/img/5.jpg');
        }
        85%{
            background-image: url('/img/6.jpeg');
        }
    }
</style>
    
</head>
 
  <body>
    
      <div class="slider"> 
          
          <div class="load">
          </div>
          <!-- Header -->
      @include('inc.header')
      <div class="box">
            <h3 ><img class="register" src="storage/img/Register.png"></h3>
            <!--<div class="form-inline">
                <div class="form-group col-md-6">
                    <label>Name: </label>
                    <input type="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                        <label>Name: </label>
                        <input type="" class="form-control">
                    </div> </div>-->
          
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                    
                <div class="inputBox">
                <div class="form-inline">
                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="firstName" type="text" class="form-control" onkeyup="this.setAttribute('value', this.value);" name="firstName" value="{{ old('firstName') }}" required autofocus autocomplete="off" maxlength="30">
                                <label for="firstName" class=" control-label">First Name</label>
                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('middleName') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="middleName" type="text" class="form-control" onkeyup="this.setAttribute('value', this.value);" name="middleName" value="{{ old('middleName') }}" required autofocus autocomplete="off" maxlength="30">
                                    <label for="middleName" class="control-label">Middle Name</label>
                                    @if ($errors->has('middleName'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('middleName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                    
                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="lastName" type="text" class="form-control"  onkeyup="this.setAttribute('value', this.value);"name="lastName" value="{{ old('lastName') }}" required autofocus autocomplete="off" maxlength="30">
                                <label for="lastName" class="control-label">Last Name</label>
                                    @if ($errors->has('lastName'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastName') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                </div>
                          
                       <table style="margin-left:-15px;width:87%;margin-top:15px;">
                           <tr>
                               <td>
                                    <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                        
                                        <div class="col-md-6 col-md-offset-1" >
                                            <input id="birthday" type="date" class="form-control" name="birthday" value="{{ old('birthday') }}" required xautofocus autocomplete="off" >
                                            <label for="birthday" class="control-label1"> Birthdate</label>
                                                @if ($errors->has('birthday'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('birthday') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                               </td>
                               <td></td>
                               <td>
                                 
                                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}" >
                                        
                                        <div class="col-md-10  col-md-offset-4">
                                                {!! Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), 'Male',['class' => 'form-control','value' => '']  ); !!}
                                                <label for="gender" class="control-label2"> Gender</label>   
                                                @if ($errors->has('gender'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('gender') }}</strong>
                                                        </span>
                                                    @endif
                                                 
                                            </div>
                                    </div>
                               </td>
                            </tr>
                        </table>
                        
                        <div class="form-group{{ $errors->has('userType') ? ' has-error' : '' }}">
                            <div class="col-md-4 col-md-offset-4">
                                   
                                    <select name="userType" class="form-control" value="">
                                        <option value="Tourguide">Tourguide</option>
                                        <option value="Traveler">Traveler</option>     
                                    </select>
                                    <label for="userType" class="control-label1"> User Type</label>
                                    @if ($errors->has('userType'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('userType') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                               
                            
                    <div class="form1">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">            
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="email" type="email" class="form-control" onkeyup="this.setAttribute('value', this.value);" name="email" value="{{ old('email') }}" required autofocus maxlength="50">
                                    <label for="email" class="control-label">Email</label>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                         
                                                    
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="password" type="password"  class="form-control"onkeyup="this.setAttribute('value', this.value);" value="" name="password" required maxlength="30">
                                <label for="password" class=" control-label">Password</label>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                     
               
                         
                        <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                <input id="password-confirm" type="password" class="form-control"  onkeyup="this.setAttribute('value', this.value);"name="password_confirmation" value=""  required autocomplete="off" maxlength="30">
                                <label for="password-confirm" class="control-label">Confirm Password</label>
                            </div>
                        </div>
                   
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-10">
                                <input type="submit" value="Register" class="btn btn-primary">
                                   
                            </div>
                        </div>
                     </div>
                    </div>
            </form>                
        </div>
          
      
        
    
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("js/bootstrap.min.js") }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("js/app.min.js") }}" type="text/javascript"></script>

    <script src="{{ asset ("js/index.js") }}" type="text/javascript"></script>


    <!-- Optionally, you can add Slimscroll and FastClick plugins. 
          Both of these plugins are recommended to enhance the 
          user experience -->
  </body>
</html>
