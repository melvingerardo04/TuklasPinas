@extends('layouts.app')
    @section('content')
    <div class="row" >
            
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(count($posts) > 0)
                        @foreach ($posts as $post)
                            <div class="row">
                                <div class="col-md-12" >
                                    <div class="panel panel-default">
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
                                            <b> 
                                                {{$post->provinces}}
                                            </b>
                                                    
                                                   
                                            <p class="ArticleBody">
                                                {{ str_limit(strip_tags($post->body), 500) }}
                                                @if (strlen(strip_tags($post->body)) > 500)
                                                    <a href="{{ action('PostsController@show', $post) }}">Read More</a>
                                                @endif
                                            </p>
                                            
                                            <img id="myImg" style="width:200px; height:200px;" alt="{{$post->provinces}}" src="/storage/cover_images/{{$post->cover_image}}"/> 
                                            
                                            <div id="myModal" class="modal">
                                                <span class="close">&times;</span>
                                                <img class="modal-content" id="img01">
                                                
                                                <div id="caption"></div>
                                              </div>
                                              
                                            <hr>  
                                           
                                               
                                                @if (strlen(strip_tags($post->comments)) > 1)
                                                    <a href="{{ action('PostsController@show', $post) }}"class="fa btn btn-link">View Comments</a>
                                                @endif 
                                        </div>
                                    </div>
                                </div>
                            </div>     
                            
                        @endforeach
                        
                    @else
                        <p> No post found </p>
                    @endif
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
    
    @endsection

