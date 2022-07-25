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
    <link href="{{ asset("css/background.css")}}" rel="stylesheet" type="text/css" /> 

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
        <h3 class="login"><img src="storage/img/Final.png" height="50px"></h3>
            
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
             {{ csrf_field() }}
                <div class="inputBox">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">            
                        <div class="col-md-10 col-md-offset-1">
                            <input id="email" type="email" class="form-control"onkeyup="this.setAttribute('value', this.value);" name="email" value="{{ old('email') }}" required autofocus>
                            <label for="email" class="control-label">Email</label>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="font-size:1rem;">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                
                
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-top:-30px;">
                        <div class="col-md-10 col-md-offset-1" >
                            <input id="password" type="password"  class="form-control"onkeyup="this.setAttribute('value', this.value);" value="" name="password" required>
                            <label for="password" class=" control-label">Password</label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div  class="col-md-10 col-md-offset-1">
                           <a class="btn btn-link" href="{{ route('password.request') }}" style="color:white;margin-top:-40px;">
                               Forgot Your Password?
                            </a>
                        </div>
                    </div>
                    
                    <div class="form-group ">
                       <div class="col-md-10 col-md-offset-1">  
                            <input type="submit" class="btn btn-primary " value="Login">
                            <a href="{{ url('auth/facebook') }}" class="btn btn-primary " style="width:412px;">
                                <strong>Login With Facebook</strong>
                            </a>                        </div>
                    </div>
                    
                    <div class="form-group-inline">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="checkbox">
                                    <label >Remember Me </label> 
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}style="margin-left:-200px;">                       
                                </div> 
                                <div class="account col-md-10 col-md-offset-7">  
                                    <a class="btn btn-link" href="{{ route('register') }}" style="color:white;">
                                        Don't have an account?
                                    </a>  
                                </div>
                                
                            </div>                            
                    </div>                          
            </form>
    </div>
      </div>
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("js/bootstrap.min.js") }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("js/app.min.js") }}" type="text/javascript"></script>

    <script src="{{ asset ("js/index.js") }}" type="text/javascript"></script>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins. 
          Both of these plugins are recommended to enhance the 
          user experience -->
  </body>
</html>
