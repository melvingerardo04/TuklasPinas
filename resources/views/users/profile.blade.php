@extends('layouts.app')
@section('content')
<style>
     html{
     scroll-behavior: smooth;
   }
     .container {
        display: flex;
        align-items: center;
        justify-content: center
      }
      #itineraryImage {
       height:200px;
       width:350px;
      }
      .image {
        flex-basis: 50%
      }
      /* .text {
        font-size: 10px;
        padding-left: 20px;
      } */
      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }
      .example-modal .modal {
        background: transparent!important;
      }
</style>

<div class="panel panel-default">
    <div class="panel-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button style="margin-top:30px;margin-right:15px;" type="button" class="close" data-dismiss="alert">×</button>
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center" style="margin-bottom:50px;">    
            <ul class="dropdown tasks-menu pull-right" style="margin-right:50px;">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i style="font-size:24px" class="fa">&#xf013;</i>      
                </a>
                <li class="dropdown-menu">
                    <a href ="users/edit" class="btn btn-default">Update Profile</a><p>
                </li>
            </ul>
            <div class="col-md-10" >
                <img class="profile_pic" id="profile" src="/storage/profiles/{{ $user->profile_pic }}"  style="width:150px; height:150px; float:left; border-radius:50$; margin-right:25px; border: 2px solid black;"/>
                <h2>{{$user->firstName}}'s Profile</h2>
                <form action="/profile" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" class="form-control-file" name="profile_pic" id="profile_pic" aria-describedby="fileHelp" onchange="previewFile()">
                    <button type="submit" class=" btn btn-primary" style="margin-top:10px;">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#post" data-toggle="tab">Post</a></li>
        <li><a href="#itineraries" data-toggle="tab">Itineraries</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="post">
            @if(count($posts) > 0)
            @foreach ($posts as $post)
            <div class="row">
                <div class="col-md-5">
                    <img id="itineraryImage"    src="/storage/cover_images/{{$post->cover_image}}"/>  
                </div>
                <div class="text">
                    <h3>{{$post->title}}</h3>
                    <i class="fa fa-map-marker"> {{$post->provinces}}</i><br> 
                    <i class="fa fa-clock-o"> {{$post->body}} </i><br>
                    <a href='{{url("/like/{$post->id}")}}'><span class="fa fa-thumbs-up"@if($getLikes[$post->id]>0)style="color:#4080FF" @endif>Like ({{$getLikes[$post->id]}})</span></a> 
                    | <a href='{{url("/dislike/{$post->id}")}}'><span class="fa fa-thumbs-down">DisLike ({{$getDisLikes[$post->id]}})</span></a>
                </div>
                <div class="">
                    <hr>
                    <button class="btn btn-warning butComment" data-toggle="modal" data-target="#comment{{$post->id}}"  data-id="{{$post->id}}">Comments </button>
                    <div class="hidecomments" id="hidecomments" ></div>
                </div>
            </div>
            <hr>
                <div class="modal fade modal-info" id="comment{{$post->id}}"  >
                    <div class="row">
                        <button style="margin-top:30px;margin-right:35px;" type="button" class="close" data-dismiss="modal">×</button>
                        <div class="col-md-8 col-md-offset-3"> 
                            <div class="panel panel-default">
                                <div class="comments" >
                                    <h4>Display Comments</h4>
                                    @include('posts.comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
                                    <hr/>
                                    <h4>Add comment</h4>
                                    <form method="post" action="{{ route('comment.add') }}">
                                            {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="text" name="comment_body" class="form-control" />
                                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-warning" value="Add Comment" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="itineraries">
        @if(count($var) > 0 && !empty($var['places']))
            @foreach ($var['places'] as $key => $place) 
                @php
                $location = implode(",",$var['array'][$key]);
                // $location = $var['array'][$key];
                @endphp
                <div class="row"> 
                    <div class="image col-md-5">
                        <img src="/img/1.jpg" id="itineraryImage"    >
                    </div>
                   
                    <div class="text  col-md-3">
                        <h3><i class="fa fa-country">{{$place->provinces_name}}</i> </h3>
                        <i class="fa fa-map-marker"> {{$location}}</i><br>
                        <i class="fa fa-clock-o"> {{$place->days1}} Days - {{$place->nights}} Nights </i>
                        
                        <hr>
                        <a href="/itineraries/show/{{$place->id}}" class="btn btn-primary">View Details</a>
                    </div>
                    <div class=''>
                        <br>
                        <h3><i class="fa fa-money"> {{number_format($place->budget,2)}}</i></h3>
                    </div>
                </div>
                <hr>
            @endforeach
        @else
                <div class="row">
                    <div class="col-md-12">
                        <p>No Itineraries</p>

                    </div>
                </div>
        @endif
        </div><!-- /.tab-pane -->
      </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
  </div><!-- /.col -->



<script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
<script>
function previewFile() {
    var preview = document.querySelector('#profile');
    var file    = document.querySelector('input[type=file]').files[0];
    var reader  = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}
</script>  
@endsection
         
