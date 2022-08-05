@extends('layouts.app')
@section('content')
<style>
      #itineraryImage {
       height:200px;
       width:250px;
      }
      .image {
        flex-basis: 40%
      }
      .text {
        font-size: 20px;
        padding-left: 20px;
      }
</style>
<center><h1>Itineraries</h1> </center>
@php
@endphp
@if(count($var) > 0)
    @foreach ($var['places'] as $key => $place) 
        @php
        $location = implode(",",$var['array'][$key]);
        $image = [];
        $image = !empty($place->images)?explode(",",$place->images):"1.jpg";
        @endphp
        <div class="container col-md-6">
            <div class="well"> 
                <div class=''>
                    <div class="image">
                      <img src="/storage/itineraryImages/{{!empty($place->images)?$image[0]:"Final.png"}}"   id="itineraryImage" >
                    </div>
                    <div class="text">
                        <h3>{{$place->provinces_name}}</h3>
                        <i class="fa fa-map-marker"> {{$location}}</i><br>
                        <i class="fa fa-clock-o"> {{$place->days1}} Days - {{$place->nights}} Nights </i><br>
                        <i class="fa fa-money"> {{number_format($place->budget,2)}}</i>
                    </div>
                    <hr>
                    <a href="/itineraries/show/{{$place->id}}" class="btn btn-primary">View Details</a>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
<p>No Itineraries Found</p>
@endif
                
@endsection