@extends('layouts.app')

@section('content')
<html>
<head>

</head>
<body>
<a href="/posts" class="btn btn-default"> Go Back</a>
<div class="row">
    <div class="col-md-8 col-md-offset-2"> 
        <div class="panel panel-default">
                <div class="panel-heading">
    
                <h1> Edit Posts</h1>
                </div>
            <div class="panel-body">
                {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
                <div class="form-group">
                        <div class="col-md-10 col-md-offset-1">
                            {{Form::label('title' , 'Title')}}
                    {{Form::text('title', $post->title , ['class' => 'form-control' , 'placeholder' => 'Title'])}}
                        </div>
                </div>
    
                
                
                <div class="form-group col-md-10 col-md-offset-1">
                    {{Form::label('provinces' , 'Provinces')}}
                    {{Form::text('provinces', $post->provinces , ['class' => 'form-control' , 'placeholder' => 'Provinces'])}}  
                </div> 
                
                <div class="form-group col-md-10 col-md-offset-1">           
                    {{Form::label('body' , 'Body', ['class' => 'body'])}}
                    {{Form::textarea('body', $post->body , ['id'=> 'article-ckeditor','class' => 'form-control1' , 'placeholder' => 'Body Text'])}}
                </div>
                    
                <div class="form-group col-md-10 col-md-offset-1">
                    {{Form::file('cover_image')}}
                </div>
                <div class="form-group col-md-10 col-md-offset-1">  
                        {{Form::hidden('_method' , 'PUT')}}
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection