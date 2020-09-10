@extends('layouts.app')
@include('inc.map')
@section('content')
    <div class="panel panel-footer" style="margin-top:50px;margin-left:400px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> SL</th>
                    <th>Place </th>
                    <th>Days </th>
                    <th>Time </th>
                    <th>Activities </th>
                    <th>Expenses </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itineraries as $key=>$itinerary)
                    <tr>
                        <td> {{++$key}}</td>
                        
                        <td>{{$itinerary->places}}</td>
                        <td>{{$itinerary->days}}</td>
                        <td>{{$itinerary->time}}</td> 
                        <td>{{$itinerary->activities}}</td> 
                        <td>{{$itinerary->expenses}}.00</td> 
                    </tr>  
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td> Total</td>
                    <td> <b class="total"></b></td>    
                </tr>
            </tfoot>
        </table>
    </div> 
@endsection