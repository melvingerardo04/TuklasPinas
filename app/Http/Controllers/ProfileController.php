<?php

namespace TuklasPinas\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;   
use TuklasPinas\User;
use TuklasPinas\Post;
use TuklasPinas\Like;
use TuklasPinas\Dislike;
use TuklasPinas\Provinces;
use Auth;
use Helpers;
use DB;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        
        $user_id =auth()->user()->id;
        $user = User::find($user_id);
        $post = Post::where("user_id",$user->id)->get();
        $getLikes = [];
        $getDisLikes = [];
        $var = [];
        foreach ($post as $key) {
            $post = Helpers::post($key->id);
            $getLikes[$key->id] = Like::where(['post_id' => $key->id])->count();
            $getDisLikes[$key->id] = DisLike::where(['post_id' => $key->id])->count();
        }
        $provinces = DB::table("provinces as p")
        ->select("p.id","p.provinces_name","p.days1","p.nights","p.budget","i.places")
        ->leftjoin("itineraries as i","i.provinces_id","p.id")
        ->where("p.user_id",$user->id)
        ->get();
        if (!empty($provinces)) {
            foreach ($provinces as $key => $province) {
                $var['places'][$province->id] = $province;
                $var['array'][$province->id][] = $province->places;
            }
        }
        
        return view('users.profile',compact('user',$user),['getLikes' =>$getLikes, 'getDisLikes' =>$getDisLikes])->with('posts', $user->posts)->with('var',$var);
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $filenameWithExt = $request->file('profile_pic')->getClientOriginalName();

        $filename =pathInfo($filenameWithExt, PATHINFO_FILENAME);

        $extension = $request->file('profile_pic')->getClientOriginalExtension();

        $fileNameToStore=$filename.'_'.time().'.'.$extension;

        $path = $request->file('profile_pic')->storeAs('public/profiles/',$fileNameToStore);

        $user->profile_pic =$fileNameToStore;
        $user->save();
        
        return back()
            ->with('success','You have successfully upload image.');

    }
  

    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    { 
        $this->validate(request(), [
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'birthday' =>'max:1999',
            'gender' =>'max:1999',
            'userType' =>'max:1999',  
        ]);

        $user->firstName = request('firstName');
        $user->middleName = request('middleName');
        $user->lastName = request('lastName');
        $user->birthday = request('birthday');
        $user->gender = request('gender');
        $user->userType = request('userType');
        $user->save();

        return redirect('/profile')->with('success', 'Profile Updated');
    }
    
    public function itineraries($id){
        $itineraries= Itineraries::all();
    return view('users.itinerary',compact('itineraries'));
    }
    
    public function show($id){
        $profile = Auth::user();
        $user_id =auth()->user()->id;
        $profile = User::find($user_id);
        $profile = User::find($id);
        return view('users.show',compact('profile',$profile))->with('posts', $profile->posts);
        //return view('users.show')->with('posts', $profile->posts);
        

    }
}
