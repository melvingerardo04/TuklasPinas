<?php

namespace TuklasPinas\Http\Controllers;
use TuklasPinas\Http\Requests;
use TuklasPinas\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TuklasPinas\Provinces;
use TuklasPinas\Itineraries;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' =>['index']]);
    }
    public function index(){
        $title = 'Viewtiful Pinas';
        //return view('pages/index', compact('title'));
        return view('pages/index')->with('title',$title);

    }
    public function home(){
        $itineraries= Itineraries::where('provinces_id', '=', 'provinces_id')->get();
        $provinces = Provinces::orderBy('provinces_name','asc')->paginate(10);
        return view('pages.home',compact('provinces'))-> with ('provinces', $provinces);  
        //$title = 'Viewtiful Pinas';
        //return view('pages/index', compact('title'));
        //return view('pages.home')->with('title',$title);

    }

    public function about(){
        $title = 'About sa Pinas';
        return view('pages/about')->with('title',$title);
    }
    public function services(){
        $data = array(
            'title' => 'Services sa Pinas',
            'services' => ['Traveller', 'Tourguide']

        );    
        return view('pages/services')-> with($data);

    }
    public function todoList(){
        $title = 'Your To-do List';
        return view('pages/todoList')->with('title',$title);
    }
    
    

    

}
