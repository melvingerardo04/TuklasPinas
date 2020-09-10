<?php

namespace TuklasPinas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TuklasPinas\Post;
use TuklasPinas\Like;
use TuklasPinas\Dislike;
use Auth;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$post - Post::all();
        $posts = Post::orderBy('created_at','desc')->paginate(3);
        return view('posts.index',compact('itinerary'))-> with ('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'title' => 'required',
            'provinces' => 'required',
            'body' => 'required',
            'cover_image' =>'image|nullable|max:1999'
        ]);

            
        //handle file
        if($request->hasFile('cover_image')){
            //get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename =pathInfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext    
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

        }else{
             $fileNameToStore = "noimage.png";
        }
        //Create Post 
        $post = new Post;
        $post->title = $request->input('title');
        $post->provinces = $request->input('provinces');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image =$fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
        //return response()->json9(['uploaded'=>'/posts/'.$imageName]);
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $post = Post::find($id);
        $likePost = Post::find($id);
        $likeCtr = Like::where(['post_id' => $likePost->id])->count();
        
        $dislikePost = Post::find($id);
        $dislikeCtr = DisLike::where(['post_id' => $dislikePost->id])->count();
        return view('posts.show',['likeCtr' =>$likeCtr, 'dislikeCtr' =>$dislikeCtr])->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);


        if(auth()->user()->id !==$post->user_id){
            return redirect ('/posts')->with('error','Unauthorize Page');
        }


        return view('posts.edit')->with('post', $post);
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
        $this->validate($request,[
            'title' => 'required',
            'provinces' =>'required',
            'body' => 'required'
        ]);

         //handle file
         if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            $filename =pathInfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore=$filename.'_'.time().'.'.$extension;

            $path = $request->file('cover_image')->storeAs('public/cover_images ',$fileNameToStore);

        }  
        
        //Create Post 
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->provinces = $request->input('provinces');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image =$fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        if(auth()->user()->id !==$post->user_id){
            return redirect ('/posts')->with('error','Unauthorize Page');
        }

        if($post->cover_image !='noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        return redirect ('/posts')-> with('success', 'Post Remove'); 
    }

    public function like($id){
       $loggedin_user = Auth::user()->id;
       $like_user = Like::where(['user_id'=> $loggedin_user, 'post_id'=> $id])->first();
       if(empty($like_user->user_id)){
           $user_id = Auth::user()->id;
           $email = Auth::user()->email;
           $post_id =$id;
           $like = new Like;
           $like->user_id= $user_id;
           $like->email= $email;
           $like->post_id = $post_id;
           $like->save();
           return redirect ("/posts/{$id}");
        }
        else{
            return redirect ("/posts");
        }

    }

    public function dislike($id){
        $loggedin_user = Auth::user()->id;
        $dislike_user = Dislike::where(['user_id'=> $loggedin_user, 'post_id'=> $id])->first();
        if(empty($dislike_user->user_id)){
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
            $dislike = new Dislike;
            $dislike->user_id= $user_id;
            $dislike->email= $email;
            $dislike->post_id = $post_id;
            $dislike->save();
            return redirect ("/posts/{$id}");
        }
        else{
            return redirect ("/posts");
        }
 
     }
}
