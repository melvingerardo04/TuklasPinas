@extends('layouts.app')

@section('content')
   
<h1> {{$title}}</h1>    

        <a href="/posts" class="btn btn-default"> Go Back</a>
        <div class="row">
                <div class="col-md-8 col-md-offset-2"> 
<div class="panel panel-default">
    <div class="panel-heading">

        <link href="{{ asset("css/createpostbackground.css")}}" rel="stylesheet" type="text/css" />
        <h1> Create Itinerary</h1>
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
            <div class="form-group inline"> 
                <div class="col-md-3 col-md-offset-1">
                    {{Form::label('days' , 'Days')}}
                    {{Form::number('days', '' , ['class' => 'form-control' , 'required'])}}
                   
                </div>
                <div class="form-group col-md-3 col-md-offset-4">
                    {{Form::label('nights' , 'Nights')}}
                    {{Form::number('nights', '' , ['class' => 'form-control' , 'required'])}}
                </div>
            </div>
            
             
                <div class="input_fields_wrap form-group col-md-10 col-md-offset-1">
                    <button class="add_field_button">Add Day</button>  <button class="add_field_button1">Add Time</button> 
                   
                </div>    
            <div class="form-group col-md-10 col-md-offset-1">
                {{Form::textarea('body', '' , ['id'=> 'article-ckeditor','class' => 'form-control1' ,'required', 'value' => ''])}}
                {{Form::label('body' , 'Body',['class' =>'body'])}}
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
@endsection
       
  
  