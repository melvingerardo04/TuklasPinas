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
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/regular.min.css" crossorigin="anonymous" />


    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset("css/scrollFunction.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("css/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    
  
    <link href="{{ asset("css/background.css")}}" rel="stylesheet" type="text/css" /> 

    <link href="{{ asset("css/postimage.css")}}" rel="stylesheet" type="text/css" /> 
    

    <style>
     .profile_pic {
        vertical-align: middle;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-left: 50px;
       }
      .content{
        width: 100%;
        /* height: calc(100% - 100px); */
        /* background-color: #bbb; */
        overflow: auto;
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
    <div class="wrapper" id="mainpage_content" >

      <!-- Header -->
      
      @include('inc.header')
      @if(Auth::guest())
     
          <!-- Content Header (Page header) -->
         
          <!-- Main content -->
          <section class="content"  >    
                   
            <!-- Your Page Content Here -->
            @yield('content')
       
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
            @include('inc.footer')
          </section><!-- /.content -->
          
      @else 
      <!-- Sidebar -->
    
      @include('inc.sidebar')
      
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
    <script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
    <script src="{{asset('assets/components/modules/admin/modals/assets/js/bootbox-4.4.0.min.js?v=v2.1.0') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("js/bootstrap.min.js") }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("js/app.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("js/scrollFunction.js") }}" type="text/javascript"></script>
    {{-- <script src="{{ asset ("js/postimage.js") }}" type="text/javascript"></script> --}}

    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js?v=v2.1.0') }}"></script>
    
    

    

  
    <script>
      // CKEDITOR.replace('summary-ckeditor');
    </script>
      
    <script>
        $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
      
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div><input type="text" name="title[]" value="Day: " style="width:50px;"/><a href="#" class="remove_field">X</a></div>'); //add input box
        }
      
        });
      
        $(document).ready(function() {
            var max_fields1     = 10; //maximum input boxes allowed
            var wrapper1   		= $(".input_fields_wrap"); //Fields wrapper
            var add_button1      = $(".add_field_button1"); //Add button ID
          
            var x = 1; //initlal text box count
            $(add_button1).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields1){ //max input box allowed
              //text box increment
              $(wrapper1).append('<div><input type="number" class="class="col-md-1 col-md-offset-1"name="time[]" placeholder="Time: " style="margin-left:35px;width:50px;"/><a href="#" class="remove_field"> X</a> to <input type="number" class="class="col-md-1 col-md-offset-1"name="time[]" placeholder="Time: " style="margin-left:35px;width:50px;"/><a href="#" class="remove_field"> X</a></div>'); //add input box
            }
            });
          
            $(wrapper1).on("click",".remove_field1", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
            })
            });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
        })
        });

      
    </script>
    

    
      
  
    

      <!-- Optionally, you can add Slimscroll and FastClick plugins. 
            Both of these plugins are recommended to enhance the 
            user experience -->
  </body>
</html>