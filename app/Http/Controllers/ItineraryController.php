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
        $var =[];
        $provinces = DB::table("provinces as p")
        ->select("p.id","p.provinces_name","p.days1","p.nights","p.budget","i.places","i.images")
        ->leftjoin("itineraries as i","i.provinces_id","p.id")
        ->get();
        $places = [];
        // dd($provinces);
        $id= "";
        $array = [];
        foreach ($provinces as $key => $province) {
            $var['places'][$province->id] = $province;
            $var['array'][$province->id][] = $province->places;
        }
        // ->paginate(10);
// dd($var);
        
    return view('itineraries.index',compact('itineraries'))->with('var', $var);  
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
            // dd($request->all());
        $data = new Provinces;
        $data->user_id = auth()->user()->id;
        $data->provinces_name = $request->input('provinces_name');
        $data->days1 = $request->input('noOfDays');
        $data->nights = $request->input('nights');
        $data->budget = $request->input('budget');
        // $data->save();
       
        $lastid=$data->id;
        if(count($request->days)>0){
            $fileNameToStore = [];
            dd($request->all());
            foreach($request->days as $itinerary=>$v){
                $days = $itinerary + 1;
                $requestTime =  $request->input('daystime'.$days);
                $implodeTime[$itinerary] = implode(",",$requestTime);
            
                $requestActivities =  $request->input('daysactivities'.$days);
                $implodeActivities[$itinerary] = implode(",",$requestActivities);

                if($request->hasFile('images')){
                    $images = $request->images;
                    foreach ($images as $key => $value) {
                    //get filename with the extension
                    $filenameWithExt = $value->getClientOriginalName();
                    //get just filename
                    $filename =pathInfo($filenameWithExt, PATHINFO_FILENAME);
                    //get just ext    
                    $extension = $value->getClientOriginalExtension();
                    //filename to store
                    $fileNameToStore[$key]=$filename.'_'.time().'.'.$extension;
                    //upload image
                    $path = $value->storeAs('public/itineraryImages',$fileNameToStore[$key]);
                    
                }
                $saveImage[$itinerary] = implode(",",$fileNameToStore[$key]);
                dd($saveImage);
                }
            $data2=array(
                'provinces_id'=>$lastid,
                'days'=>$request->days[$itinerary],
                'places'=>$request->places[$itinerary],
                'time'=>$request->time[$itinerary],
                'activities'=>$request->activities[$itinerary],
                'expenses'=>$request->expenses[$itinerary],
                'images'=>$saveImage[$itinerary],
                
            );
           
            // Itineraries::insert($data2);
           
        }
        dd($data);
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
        $itineraries= Itineraries::where('p.id', '=', $id)
        ->leftjoin("provinces as p","p.id","itineraries.provinces_id")
        ->get();

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
