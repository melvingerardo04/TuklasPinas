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

            
                <h1> Create Post</h1>
            </div>
            <div class="panel-body">
            {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}            
                <div class="form-group col-md-10 col-md-offset-1">
                    {{Form::label('title' , 'Title')}}            
                    {{Form::text('title', '' , ['class' => 'form-control' ,'name' => 'title', 'required','value'=> ''])}}
            </div>
                <div class="form-group col-md-10 col-md-offset-1">
                    {{Form::label('provinces' , 'Provinces')}}
                    {{Form::text('provinces', '' , ['class' => 'form-control' ,'required'])}}
                </div>  
               
                
                <div class="form-group col-md-10 col-md-offset-1"></div>
                <div class="form-group col-md-10 col-md-offset-1">
                    {{Form::label('body' , 'Itinerary',['class' =>'body'])}}
                    {{Form::textarea('body', '' , ['id'=> 'body','class' => 'form-control' ,'required', 'value' => 'Body', 'name' => 'body'])}}        
                </div>    
                <div class="form-group col-md-10 col-md-offset-1">
                    {{Form::label('uploadPhoto' , 'Upload Photo')}}
                    {{Form::file('cover_image' )}}
                </div>
                <div class="form-group col-md-10 col-md-offset-1">  
                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                </div>
            
            {!! Form::close() !!}
        </div>

    </div>
</div>
</body>
</html>
@endsection


       
  
  