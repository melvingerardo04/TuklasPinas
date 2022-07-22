@extends('layouts.app')
@include('inc.map')
@section('content')
@if (Auth::guest())
    
@else
    

<div class="panel panel-footer" style="margin-top:50px;margin-left:400px;">
    <table class="table table-bordered" >
        <thead>
            <tr>
                <th>Lists</th>
                <th>Author</th>
                <th>Provinces Name</th>
                <th>Range</th>
                <th>Budget</th>
                <th>Action </th>
          </tr>
      </thead>
      <tbody>
            @foreach ($provinces as $key=>$province)
                <tr>
                    <td> {{++$key}}</td>
                <td><a href="/users/{{$province->user->id}}"><font color="cornflowerblue">{{$province->user->firstName}} {{$province->user->lastName}}</font></a>({{$province->user->userType}})</td>
                    <td>{{$province->provinces_name}}</td>
                    <th>{{$province->days1}}days {{$province->nights}}nights</th>
                    <td>{{$province->budget}}.00</td>
                    
                    <td><a href="/itineraries/show/{{$province->id}}" style="color:cadetblue;">View</td>
                </tr>  
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="border: none"></td>
                <td style="border: none"></td>
                <td style="border: none"></td>  
          </tr>
        </tfoot>
    </table>
</div>
@endif
@endsection

