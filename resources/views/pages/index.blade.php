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
<link href="{{ asset("css/scrollFunction.css")}}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,700,400' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
 <style>
   html{
     scroll-behavior: smooth;
   }
   #Dream{
     margin-top: 50%;
     background-color: green;
     height:700px;
   }
   #Explore
   {
     background-color: brown;
     height:700px;
   }
   #Discover{
     background-color: aqua;
     height:700px;
   }
   label{
     margin-top: 50px;
   }
   
 </style>
  <body >
    

      <!-- Header -->
      
     
      @if(Auth::guest())
      @include('inc.header')
          
       <section class="cd-intro">
         
        <img src={{asset('storage/img/1.png')}} title="bg"   style="background-size:cover;position:fixed;width:100%;height:92%;margin-left:-90x;margin-top:50px;">
        <div class="cd-intro-content bouncy">
         
            <p><img src="img/Final.png" height="180px" width="550px;" style="margin-top:180px;"></p>
            
            
            <div class="action-wrapper" >
              <a href="#Dream" class="cd-btn ">Dream</a>
                <a href="#Explore" class="cd-btn main-action">Explore</a>   
                <a href="#Discover" class="cd-btn" style="margin-left:20px;">Discover</a>
                
            </div>
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
            <p>
              <div id="Dream" style="margin-top:280px;">
                <p> <h1><font color="black"><label for="Dream">Dream</label></h1><p>
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of 
                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </font>
              </div>
        
            <div id="Explore"  >
              <h1><font color="black"><label for="Explore">Explore</label></h1><p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,
              or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there 
              isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks 
              as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful 
              of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from 
              repetition, injected humour, or non-characteristic words etc.
            </div>
        
            <div id="Discover" >
              <h1><font color="black"><label for="Discover">Discover</label></h1><p>
             There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,
              or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there 
              isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks 
              as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful 
              of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from 
              repetition, injected humour, or non-characteristic words etc.
            </div>
        </div>
        
        
    </section>
    

   
          
    
      @else
      @include('inc.header')
      <div class="wrapper">
      <!-- Sidebar -->
      @include('inc.sidebar')
     
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
       
        <div class="jumbotron text-center">
          <h1><img src="/img/Final.png"  height="180px" width="550px;"></h1>
          <p> It's more fun in the Philippines</p>
        </div> 
        <!-- Main content -->
        <section class="content">          
          <!-- Your Page Content Here -->
         
          @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Footer -->
      @include('inc.footer')

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    @endif
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("js/bootstrap.min.js") }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("js/app.min.js") }}" type="text/javascript"></script>

    <script src="{{ asset ("js/index.js") }}" type="text/javascript"></script>

    <script src="{{ asset ("js/scrollFunction.js") }}" type="text/javascript"></script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins. 
          Both of these plugins are recommended to enhance the 
          user experience -->
  
          <script src="js/jquery-2.1.4.js"></script>
          <script src="js/main.js"></script> <!-- Resource jQuery -->
        
    </body>

</html>