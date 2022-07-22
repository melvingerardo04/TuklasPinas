@extends('layouts.app')

@section('content')
<style>
    body{
        font-size: 15px;
    }
</style>
<div class="row">
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $message }}</strong>

        </div>

    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="col-md-6">
            <h1>Todo List</h1>
            
            {!! Form::open(['action' => 'TaskController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{csrf_field()}}

                <div class="form-group">
                <input type="text" class="form-control" name="task" placeholder="Enter Task" required><p></div>
                    <div class="form-group">   
                <!--<input type="date" class="form-control" name="date" placeholder="Enter Date" required> -->
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
            <hr>
            @if(count($tasks) > 0)
                @foreach ($tasks as $task)
                    <h4>Wait Lists</h4>
                        <ol>
                           @foreach($tasks as $task)
                        <li>{{ $task->task }}<a href ={{url('/'.$task->id.'/complete')}} class="btn btn-link"> Done </a></li>
                            @endforeach
                        </ol>
                        
                        <h4>Todo List Completed</h4>

                        <ol>
                            @foreach($completed_tasks as $c_task)
                                <li>{{ $c_task->task }}
                                    <a href ={{url('/'.$c_task->id.'/delete')}} class="btn btn-link">    Delete </a></li>
                            @endforeach
                        </ol>

                @endforeach
                          
                @else
                    <p> You have no Todo List </p>
            @endif
        </div>
    
</div>
@endsection
       
  
  