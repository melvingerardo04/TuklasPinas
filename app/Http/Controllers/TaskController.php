<?php

namespace TuklasPinas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL; 
use TuklasPinas\Task;
use TuklasPinas\User;
use Auth;
class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $user_id =auth()->user()->id;
        $user = User::find($user_id);
        $tasks = Task::where("iscompleted", 0)->orderBy("id", "desc")->get();
        $completed_tasks = Task::where("iscompleted", true)->get();
        // dd($user->tasks);
    
        $var['user'] = User::find($user_id);
        $var['waitList'] = Task::where("iscompleted", 0)->orderBy("id", "desc")->get();
        $var['completeList'] = Task::where("iscompleted", 1)->get();

        // dd($var);

        return view('pages.todoList',compact('var',$var))->with('var',$var);
        }
        
        public function store(Request $request)
        {
            $input = $request->all();
            $task = new Task();
            $task->user_id = auth()->user()->id;
            $task->task = request("task");
            $task->iscompleted = 0;
            $task->save();
            return Redirect::back()->with("message", "Task has been added");
        
        }

        public function complete($id)
        {
        $task = Task::find($id);
        $task->iscompleted = true;
        $task->save();
        return Redirect::back()->with("message", "Task has been added to completed list");
        }

        public function destroy($id)
        {
        $task = Task::find($id);
        $task->delete();
        return Redirect::back()->with('message', "Task has been deleted");
        }
}
