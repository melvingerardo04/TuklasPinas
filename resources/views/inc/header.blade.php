<html>
    <link href="{{ asset("css/scrollFunction.css")}}" rel="stylesheet" type="text/css"/>
    
<head>
    <style>
      .box1{
  box-sizing: border-box;
  background: rgba(114, 110, 110, 0.6);
  border-radius: 0.625rem;
}
      </style>
</head>
<body>

<!-- Main Header -->
@if (Auth::guest())
<div class="box1">
  <header class="main-header">
    <!-- Logo -->
    <a class="logo" href="{{ url('/home') }}"height="55px" width="220px;" style="position:fixed;background-color:black;background-color:#666666">
      <img src="/img/Final.png" height="45px" width="225px" style="margin-left:-14px;">
    
     </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-fixed-top" role="navigation" style="background-color:#666666; border-bottom: 0.065rem solid #fff;" >
    <!-- Sidebar toggle button-->    
    <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu" >
        <ul class="nav navbar-nav navbar-right"  >
          <li><a href="{{ route('login') }}">Sign In</a></li>
          <li><a href="{{ route('register') }}">Sign Up</a></li>
        </ul>    
      </div>
    </nav>
  </header>
</div>

<script src="{{ asset ("js/scrollFunction.js") }}" type="text/javascript"></script>             

@else
<header class="main-header">
   
  
<!-- Header Navbar -->
 <a class="logo" href="{{ url('/home') }}" width="220px;" style="position:fixed;height:52px;background-color:#666666">
  <img src="/img/Final.png" height="46px" width="225px" style="margin-left:-14px;">

 </a>
          
<nav class="navbar navbar-fixed-top" role="navigation" style="background-color:#666666; border-bottom: 0.065rem solid #fff;" >
   
        
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
       
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu"  >
          <ul class="nav navbar-nav">
              
            <!-- Messages: style can be found in dropdown.less-->
            
              <li class="pull-right">
                 
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                  Logout
                  </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>         
                  </li>
              <!-- User Account Menu -->
              
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      @endif
</body>
</html>