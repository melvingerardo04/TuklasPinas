<html>

<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    #main span:hover {
    color: #f1f1f1;
    }
</style>  
</head>
<body>
<!-- Authentication Links -->
@if (Auth::guest())
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                    
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    
                
                                    
                                     
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
                </a>
            </div>
                    
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}"  style="margin-left:850px;margin-top:-45px;" >
                                    {{ csrf_field() }}
              
                                    
                                      <table colspan="10">
                                        <tr>
                                          <td>
                                            <label for="email" class="control-label">E-Mail Address</label>
                                      </td>
                                      <td>
                                          <label for="password" class="control-label">Password</label>
                                            
                                        
                                      </td>
                                  
                                  </tr>
                                  <tr>
                                    <td bordercolor="black">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
              
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                     
                                    </td> 
                                   
                                    <td> 
                                        
                                            <input id="password" type="password" class="form-control" name="password" >
                
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        
                                    
                                    </td>
                                    <td>
                                        <div >
                                            <button type="submit" class="btn btn-primary">
                                                Login 
                                            </button>
                                        </div>
                                    </td>
                                    
                                  </tr>
                                  <tr>
                                    <td>
                                    </td>
                                      <td>
                                          <a class="btn btn-link" href="{{ route('password.request') }}" >
                                              Forgot Your Password?
                                          </a>
                                      </td>
                                    </tr>
                                
                                  
                                       
                                  
                                </table>
                                </form>
                    </ul>
            </div>
        </div>
    </nav>                
@else
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                    
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Button for sidebar --> 
                
                <div id="main">
                    <span class="pull-left" style="font-size:30px;cursor:pointer;hover  {
                        color: #f1f1f1;
                      }" onclick="openNav()">&#9776; &nbsp;</span>              
                <!-- Branding Image -->
                
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div> 
            </div>
                    
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>
               
                    
                  
                <ul class="nav navbar-nav navbar-right"> 
                    <li>
                        <form class="navbar-form" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                            </form> 
                    </li>        
                    <li class="dropdown">
                       
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->firstName }} {{ Auth::user()->lastName }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li> <a href="/profile">User Profile </a></li>
                           
                                <li> <a href="/dashboard">Dashboard</a></li>
                            <li>
                                    
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li> 
                </ul> 
            </div>
        </div>            
    </nav>  
    
@endif
</body>
</html>
                
                
         

























  