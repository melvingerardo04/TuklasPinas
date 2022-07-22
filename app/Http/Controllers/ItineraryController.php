<?php

namespace TuklasPinas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use TuklasPinas\Itineraries;
use TuklasPinas\User;
use TuklasPinas\Provinces;
use Auth;
use DB;
class ItineraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itineraries = Itineraries::orderBy('provinces_id','asc')->paginate(10);
    return view('itineraries.index',compact('itineraries'))-> with ('itineraries', $itineraries);  
        // $provinces=Provinces::all();
        //return view('itineraries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('itineraries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Provinces;
        $data->user_id = auth()->user()->id;
        $data->provinces_name = $request->input('provinces_name');
        $data->days1 = $request->input('days1');
        $data->nights = $request->input('nights');
        $data->budget = $request->input('budget');
        $data->save();
       
        
        $lastid=$data->id;
        if(count($request->days)>0){
            foreach($request->days as $itinerary=>$v){
            $data2=array(
                'provinces_id'=>$lastid,
                'days'=>$request->days[$itinerary],
                'places'=>$request->places[$itinerary],
                'time'=>$request->time[$itinerary],
                'activities'=>$request->activities[$itinerary],
                'expenses'=>$request->expenses[$itinerary],
                
            );
            
            Itineraries::insert($data2);
           
        }
        }
        return redirect('/itineraries')->with('success', 'Itineraries Created');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itineraries= Itineraries::where('provinces_id', '=', $id)->get();
        return view('itineraries.show',compact('itineraries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function provinces($provinces_name)
    {
    $provinces= Provinces::where('provinces_name', '=', $provinces_name)->get();
    return view('itineraries.provinces',compact('provinces'));
    }

    function search(Request $request)
    {
        $search = $request->get('search');
        $itineraries= DB::table('itineraries')

        ->where('days', 'like', '%' .$search. '%')
        ->orWhere('places', 'like', '%' .$search. '%')
        ->orWhere('time', 'like', '%' .$search. '%')
        ->orWhere('activities', 'like', '%' .$search. '%')
        ->orWhere('expenses', 'like', '%' .$search. '%')
        
        ->paginate(5);
        
       
        return view('itineraries.index', ['itineraries' =>$itineraries]);





        /*
            from index.blade.php
        <td><u><a href="/users/{{$itinerary->user_id}}" style="color:cornflowerblue;font:underline;">{{$itinerary->user->firstName}} {{$itinerary->user->lastName}}</a></td>
            <td>{{$itinerary->provinces->provinces_name}}</td> 
        */
    }
}
