@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                            <img class="profile_pic" src="/storage/profiles/{{ $user->profile_pic }}"  style="width:150px; height:150px; float:left; border-radius:50$; margin-right:25px; border: 2px solid black;"/>
                            <h2>{{$user->firstName}}'s Profile</h2>
                            <form action="/profile" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" class="form-control-file" name="profile_pic" id="profile_pic" aria-describedby="fileHelp">
                                <button type="submit" class=" btn btn-primary" style="margin-top:10px;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default"> 
                <div class="panel-body">
                    <h3> Your Post</h3>
                    @if(count($posts) > 0)
                        @foreach ($posts as $post)
                            <div class="row">
                                <div class="col-md-12" >
                                    <div class="panel panel-default">      
                                        <div class="panel-heading" >  <p><b>{{$post->user->firstName}} {{$post->user->lastName}}  <img style="width: 30px; height:30px;border-radius: 50%;"  align="left"src="/storage/profiles/{{$post->user->profile_pic}}"></b></p></div>
                                            <div class="panel-body">
                                                <b> 
                                                {{$post->provinces}}</b>
                                                
                                                {!!$post->body!!}
                                                <img  style="width:200px; height:200px;"  src="/storage/cover_images/{{$post->cover_image}}"/>    
                                                <hr>  
                                                <p>
                                                <a href='{{url("/like/{$post->id}")}}'><span class="fa fa-thumbs-up">Like ()</span></a> 
                                                | <a href='{{url("/dislike/{$post->id}")}}'><span class="fa fa-thumbs-down">DisLike ()</span></a>
                                                | <a href ="/posts/{{$post->id}}/edit" >Edit Post</a> 
                                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST','style' => 'margin-top:-35px;margin-left:220px;' ]) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Delete Post')}}
                                                    {!!Form::close()!!}     
                                                </p>
                                                <hr/>
                                                <p>
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
                          
                        @else
                            <p> You have no post </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

@endsection
