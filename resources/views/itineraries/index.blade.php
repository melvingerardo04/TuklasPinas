@extends('layouts.app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block" style="margin-top:50px;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="col-md-4">
        {!! Form::open(['action' => 'ItineraryController@search', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}  
        <div class="input-group">
            <input type="search" name="search" id="search" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">Search</button>
            </span>
        </div>
         {!! Form::close() !!}
    </div>
            <div class="panel panel-footer">
                <table class="table table-bordered">
                 
                    <thead>
                       
                        <th> Days </th>
                        <th> Places </th>
                        <th> Time </th>
                        <th> Activities </th>
                        <th> Expenses</th>
                    </thead>
                    <tbody>  
                        @if(count($itineraries) > 0)
                            @foreach ($itineraries as $itinerary)
                                <tr>
                               
                                    <td>{{$itinerary->days}}</td>
                                    <td>{{$itinerary->places}}</td>
                                    <td>{{$itinerary->time}}</td>
                                    <td>{{$itinerary->activities}}</td>
                                    <td>{{$itinerary->expenses}}.00</td>
                                </tr>    
                            @endforeach 
                        @else
                            <p> No Itineraries Found
                        @endif                     
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                           
                            <td></td>
                            <td></td>
                            <td> {{$itineraries->links()}}</td>
                                  
                        
                        </tr>
                    </tfoot>
                </table>            
            </div>
              

                
@endsection