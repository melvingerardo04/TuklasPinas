@extends('layouts.app')
<style>
  html{
    scroll-behavior: smooth;
  }
  #Dream{
    margin-top: 50%;
    /* background-color: green; */
    height:700px;
  }
  #Explore
  {
    /* background-color: brown; */
    height:700px;
  }
  #Discover{
    /* background-color: aqua; */
    height:700px;
  }
  label{
    margin-top: 50px;
  }
  body{
    background-image:url( 'storage/img/background.png');
    background-size:cover;
    /* position:fixed; */
    width:100%;
    height:92%;
    margin-left:-90x;
    margin-top:50px;
  }
  
</style>

<script src="js/modernizr.js"></script> <!-- Modernizr -->
@section('content')
{{-- <img src={{asset('storage/img/background.png')}} title="bg"   style="background-size:cover;position:fixed;width:100%;height:92%;margin-left:-90x;margin-top:50px;"> --}}
<div class="cd-intro-content bouncy">
 
    <p><img src="img/Final.png" height="180px" width="550px;" style="margin-top:180px;"></p>
    
    
    <div class="action-wrapper" >
      <a href="#Dream" data-targer="#Dream" class="cd-btn ">Dream</a>
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

@endsection

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
