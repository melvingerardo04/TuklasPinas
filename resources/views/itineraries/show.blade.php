@extends('layouts.app')
{{-- @include('inc.map') --}}
@section('content')
<style>
    #itineraryImages{
        height:150px;
       width:200px;
    }
</style>
<div class="pull-right">
    <a href="/itineraries" class="btn btn-danger "> Go Back</a>
</div>
    @foreach ($itineraries as $itinerary)
        @php
            // dd($itinerary->images);
            $arrayImages = explode(",",$itinerary->images);
        @endphp
    <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
              <span class="bg-red">
                {{$itinerary->places}}
              </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa  bg-blue">{{$itinerary->days}}</i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{$itinerary->time}}</span>
                <h3 class="timeline-header"><i class="fa fa-money">{{$itinerary->expenses}}</i></h3>
                <div class="timeline-body">
                  <p>{{$itinerary->activities}}</p>
                </div>
                <div class='timeline-footer'>
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-picture-o bg-aqua"></i>
              <div class="timeline-item" >
                @foreach ($arrayImages as $item)
                    <img id="itineraryImages" src="/storage/itineraryImages/{{!empty($item)?$item:"Final.png"}}" >
                @endforeach
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
          </ul>
        </div><!-- /.col -->
      </div><!-- /.row -->
    @endforeach


    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection