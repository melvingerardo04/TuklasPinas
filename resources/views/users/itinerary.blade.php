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
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,700,400' rel='stylesheet' type='text/css'>
    
        <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
        <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
        <link rel="stylesheet" href="https://maxcdn.bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
</head>
<body>
    @if(Auth::guest())
        @include('inc.header')    
        <section class="cd-intro">
           
          <div class="cd-intro-content bouncy">
              <p><img src="img/Final.png" height="180px" width="550px;"></p>
              
              <div class="action-wrapper" style="margin-top:-250px;">
                
                  <a href="#0" class="cd-btn main-action">Explore</a>
                  <a href="#0" class="cd-btn">Learn More</a>
              </div>
          </div>
      </section>
    @else
        @include('inc.header')
      
      <!-- Sidebar -->
        @include('inc.sidebar')
            <div class="wrapper">
                
            <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top:50px;">
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> SL</th>
                        <th> Author</th>
                        <th>Place </th>
                        <th>Days </th>
                        <th>Inclusions </th>
                        <th>Exclusions </th>
                        <th>Budget </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itineraries as $key=>$itineraries)
                    <tr>
                        <td> {{++$key}}</td>
                        <td>{{$itineraries->user->firstName}} {{$itineraries->user->lastName}}</td>
                        <td>{{$itineraries->places}}</td>
                        <td>{{$itineraries->days}}</td>
                        <td>{{$itineraries->inclusions}}</td> 
                        <td>{{$itineraries->exclusions}}</td> 
                        <td>{{$itineraries->budget}}</td> 
                    </tr>  
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td style="border: none"></td>
                        <td style="border: none"></td>
                        <td style="border: none"></td>
                        <td style="border: none"></td>
                        <td> Total</td>
                        <td> <b class="total"></b></td>    
                    </tr>
                </tfoot>
            </table>
</div>

@endif
</body>
</html>