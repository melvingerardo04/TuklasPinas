@extends('layouts.app')
@extends('inc.map')
    @section('content')
        <div class="panel panel-footer" style="margin-top:50px;margin-left:400px;">
            
           
            @if(count($provinces) > 0)
            @foreach ($provinces as $key=>$province)
        <h1>
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th> SL</th>
                        <th>Author</th>
                        <th>Provinces</th>
                        <th>Range </th>
                        <th>Budget </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                   
                        <tr>
                            <td> {{++$key}}</td>
                            <td><a href="/users/{{$province->user->id}}"><font color="cornflowerblue">{{$province->user->firstName}} {{$province->user->lastName}}</font></td>
                            <td>{{$province->provinces_name}}</td>
                            <td>{{$province->days1}}day(s) {{$province->nights}}night(s)</td>
                            <th>{{$province->budget}}.00</th> 
                            <td><a href="/itineraries/show/{{$province->id}}" style="color:cadetblue;">View</td>
                        </tr>  
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td style="border: none"></td>
                        <td style="border: none"></td>
                        <td style="border: none"></td>
                        <td style="border: none"></td>
                        <td> <b class="total"></b></td>    
                    </tr>
                </tfoot>
            </table>
            @else
                <p> No Itinerary found </p>
            @endif
        </div>
    @endsection