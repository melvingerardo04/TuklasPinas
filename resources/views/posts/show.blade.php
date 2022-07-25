@extends('layouts.app')

@section('content')
    <div class="row ">    
      
            <div class="col-md-12" >
                <div class="panel panel-default">
                    <a href="/posts" class="btn btn-default"> Go Back</a>
                    <div class="panel-heading" >  <p><b>{{$post->user->firstName}} {{$post->user->lastName}}  <img style="width: 30px; height:30px;border-radius: 50%;"  align="left"src="/storage/profiles/{{$post->user->profile_pic}}"></b></p>
                        @if(Auth::user()-> id == $post->user_id) 
                       
                  
                        <ul class="dropdown tasks-menu pull-right" style="margin-top:-30px;">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i style="font-size:24px" class="fa">&#xf013;</i>      
                            </a>
                            <li class="dropdown-menu">
                               <button > <a href ="/posts/{{$post->id}}/edit" class="fa">Edit Post</a>   </button>                          
                                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' =>'btn btn-link']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete Post')}}
                                {!!Form::close()!!}
                            </li>
                        </ul>
                        @endif
                    </div>
                        <div class="panel-body">
                            <b>  {{$post->provinces}}</b>        
                            <p class="ArticleBody">
                                {!!$post->body!!}  
                            </p>
                            <img  style="width:200px; height:200px;"  src="/storage/cover_images/{{$post->cover_image}}"/>
                            <hr>  
                            <p>
                                <a href='{{url("/like/{$post->id}")}}'><span class="fa fa-thumbs-up">Like ({{$likeCtr}})</span></a> 
                                | <a href='{{url("/dislike/{$post->id}")}}'><span class="fa fa-thumbs-down">DisLike ({{$dislikeCtr}})</span></a>
                                
                            
                            <hr/>
                                <p>
                                    <h4>Display Comments</h4>
                                         @include('posts.comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
                                    <hr/>
                                    <h4>Add comment</h4>
                                    <form method="post" action="{{ route('comment.add') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="text" name="comment_body" class="form-control" placeholder="Write a comment..." />
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

     
   
   @endsection