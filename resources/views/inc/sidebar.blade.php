<html>
  <head>
      <title>{{ config('app.name', 'Laravel') }}</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <style>
      .profile_pic {
                  vertical-align: middle;
                  width: 100px;
                  height: 100px;
                  border-radius: 50%;
                  margin-left: 50px;
                  }
                  body{
                    background:#000;                   
                    background-attachment: fixed;
                  }
                  .sidebar-menu{
                    font-family:Brush Script MT;
                    font-size:30px;
                    line-height:50%
                  }
      </style>
     
</head>

<body>
    @if (Auth::guest())
    @else
<!-- Left side column. contains the sidebar -->

<aside class="main-sidebar" style="position:fixed;background-color:#666666;">
   
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- Sidebar user panel (optional) -->
     <center>
      <div class="user-panel">
        <div class=" image">
            <a href="/profile">
                <img class="profile_pic" style="margin-right:50px;" title="Go to your Profile" id="profile_pic" src="/storage/profiles/{{ Auth::user()->profile_pic}}" />
                
            </a>
        </div>
        <div class="info" style="font-family:Brush Script MT;">
            <a href="/profile" >
              <font size="5px"> {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}   </font>
                <p style="font-family:barabara"><br>
                    {{ Auth::user()->userType }}
           </a>
        </div>
         <!-- Status -->
         
      </div>
     </center>
  
      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group"  style="margin-top:-15px;">
          
         
        </div>
      </form>
      <!-- /.search form -->
  
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu"  style="font-family:Brush Script MT;font-size:30px;line-height:50%">
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="/home"> <span style="font-family: No.SevenRegular;">Home</span>
        <li><a href="/posts"><span>Posts</span></a></li>
        {{-- <li><a href="/posts/create"> <span >Create Posts</span></a></li></a></li> --}}
        <li><a href="/itineraries"> <span >Itineraries</span></a></li></a></li>
        <li><a href="/itineraries/create"> <span >Create Itinerary</span></a></li></a></li>
        <li><a href="/todoList"> <span >To-do List</span></a></li></a></li>
        {{-- @include('inc.info') --}}
      </ul><!-- /.sidebar-menu -->
     
    </section>
    
    <!-- /.sidebar -->
  </aside>
@endif
</body>
</html>