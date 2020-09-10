<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
      <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("admin/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("admin/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset("admin/css/scrollFunction.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("admin/css/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    
  
    <link href="{{ asset("admin/css/background.css")}}" rel="stylesheet" type="text/css" /> 
    

    <style>
     .profile_pic {
        vertical-align: middle;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-left: 50px;
       } 
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body >
    <div class="wrapper" >

      <!-- Header -->
      @include('inc.header')
      
      @if(Auth::guest())
     
          <!-- Content Header (Page header) -->
         
          <!-- Main content -->
          <section class="content"  >    
                   
            <!-- Your Page Content Here -->
            @yield('content')
       
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
          
          </section><!-- /.content -->
          
      @else 
      <!-- Sidebar -->
    
      @include('admin.inc.sidebar')
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper"  style="margin-top:44px;">
        <!-- Content Header (Page header) -->
       
        <!-- Main content -->
        <section class="content">   
          
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
          <!-- Your Page Content Here -->
          @yield('content')
        
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
     
      <!-- Footer -->
      

    </div><!-- ./wrapper -->
    @endif
    <!-- REQUIRED JS SCRIPTS -->
    
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset ("admin/js/jQuery-2.1.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("admin/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("admin/js/app.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("admin/js/scrollFunction.js") }}" type="text/javascript"></script>

  <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
  

 
  
  
 
  

    <!-- Optionally, you can add Slimscroll and FastClick plugins. 
          Both of these plugins are recommended to enhance the 
          user experience -->
  </body>
</html>