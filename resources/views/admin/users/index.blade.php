@include('inc.navbar')
@include('inc.sidebar')
@include('layouts.app')

@section('content')
    
    <div class="col-md-4">
 
        
            <div class="panel panel-footer">
                <table class="table table-bordered">
                 
                    <thead>
                       
                        <th> First Name </th>
                        <th> Places </th>
                        <th> Time </th>
                        <th> Activities </th>
                        <th> Expenses</th>
                    </thead>
                    <tbody>  
                        @if(count($users) > 0)
                            @foreach ($users as $user)
                                <tr>
                               
                                    <td>{{$user->firstName}}</td>
                                    <td>{{$user->LasName}}</td>
                                    <td>{{$user->birthday}}</td>
                                    <td>{{$user->activities}}</td>
                                    <td>{{$user->expenses}}.00</td>
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