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
<div class="panel panel-tabs panel-tabs-responsive">
    <div class="widget-head tabprocess">
		<ul>
			<li class="active"><a href="#appform" data-toggle="tab">Application Form</a></li>
			<li><a href="#docsubmitted" data-toggle="tab"><span>Document Submitted</span></a></li>
			<li><a href="#test" data-toggle="tab"><span>Aptitude Test</span></a></li>
			{{-- <li><a href="#medical" data-toggle="tab"><span>Medical Clearance</span></a></li> --}}
			<li><a href="#interview" data-toggle="tab"><span>Interview</span></a></li>
			<li><a href="#approval" data-toggle="tab"><span>Approval</span></a></li>
			{{-- <li><a href="#appstatus" data-toggle="tab"><span>Applicant Status</span></a></li> --}}
			<li><a class="glyphicons undo text-primary" href="#backlist" data-toggle="tab"><i></i> Back to list</a></li>
		</ul>
	</div>
</div>

@if(count($posts) > 0)
    @foreach ($posts as $post) 
        <div class="container col-md-4">
            <div class="well"> 
                <div class=''>
                    <div class="image">
                        <img id="itineraryImage"  style="width:200px; height:200px;"  src="/storage/cover_images/{{$post->cover_image}}"/> 
                    </div>
                    <div class="text">
                        <hr>
                        <a href='{{url("/like/{$post->id}")}}'><span class="fa fa-thumbs-up"@if($getLikes[$post->id]>0)style="color:#4080FF" @endif>Like ({{$getLikes[$post->id]}})</span></a> 
                        | <a href='{{url("/dislike/{$post->id}")}}'><span class="fa fa-thumbs-down">DisLike ({{$getDisLikes[$post->id]}})</span></a>
                        <h3>{{$post->title}}</h3>
                       <i class="fa fa-map-marker"> {{$post->provinces}}</i><br> 
                        <i class="fa fa-clock-o"> {{$post->body}} </i><br>
                        {{-- <i class="fa fa-money"> {{number_format($place->budget,2)}}</i> --}}
                    </div>
                    <hr>
                    <button class="btn btn-warning butComment" data-toggle="modal" data-target="#comment{{$post->id}}"  data-id="{{$post->id}}">Comments </button>
                    <div class="hidecomments" id="hidecomments" ></div>
                </div>
            </div>
        </div>
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
         
