@extends('layouts.app')

@section('content')
<link href="{{ asset("css/editprofile.css")}}" rel="stylesheet" type="text/css" /> 
<div class="row">

<div class="box">
        <h1>Edit your Profile</h1>
                <center>
                {!! Form::open(['action' => ['ProfileController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                     <div class="inputBox">
                        <div class="form-group">
                                <div class="col-md-3">     
                                        {{Form::text('firstName', $user->firstName , ['class' => 'form-control ' , 'placeholder' => 'First Name'])}}
                                        {{Form::label('firstName' , 'First Name')}}
                                </div>
                        </div>
                
                        <div class="form-group">
                                <div class="col-md-3 col-md-offset-1">
                                        {{Form::text('middleName', $user->middleName , ['id'=> 'article-ckeditor','class' => 'form-control' , 'placeholder' => 'Middle Name'] )}}
                                        {{Form::label('middleName' , 'Middle Name')}}
                                </div>
                        </div>
                
                        <div class="form-group">
                                <div class="col-md-3 col-md-offset-1">
                                        {{Form::text('lastName', $user->lastName , ['class' => 'form-control' , 'placeholder' => 'Last Name'])}}
                                        {{Form::label('lastName' , 'Last Name')}}
                                </div>
                        </div>
                
                        <div class="form-group">
                                <div class="col-md-4">
                                        {{Form::date('birthday', $user->birthday , ['class' => 'form-control' , 'placeholder' => 'Birthday'] )}}
                                        {{Form::label('birthday' , 'Birthday')}}
                                </div>
                        </div>
                
                        <div class="form-group">
                                <div class="col-md-3 ">
                                        {!! Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), $user->gender,['class' => 'form-control','value' => $user->gender]  ); !!}
                                        {{Form::label('gender' , 'Gender')}}
                                </div>
                        </div>
                
                        <div class="form-group">
                                <div class="col-md-3 col-md-offset-1">
                                                {!! Form::select('userType', array('Traveler' => 'Traveler', 'Tourguide' => 'Tourguide'), $user->userType,['class' => 'form-control','value' => $user->userType]  ); !!}
                                      
                                        {{Form::label('userType' , 'User type')}}
                                </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-10 col-md-offset-1">
                        {{Form::hidden('_method' , 'PUT')}}
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                        </div>
                        </div>
                    {!! Form::close() !!}
                </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
</div>
    @endsection