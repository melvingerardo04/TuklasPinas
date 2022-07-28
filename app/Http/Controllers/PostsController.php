<?php

namespace TuklasPinas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TuklasPinas\Post;
use TuklasPinas\Like;
use TuklasPinas\Dislike;
use Auth;
use DB;

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
    public function savepost(Request $request)
    {

        $this->validate($request,[
            'title' => 'required',
            'provinces' => 'required',
            'body' => 'required',
            'cover_image' =>'image|nullable|max:1999'
        ]);
        $result = array("status"=>0,"message"=>""); 
        $var = $request->all();
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
        if (empty($var['postID'])) {
            //Create Post 
            $post = new Post;
            $post->title = $request->input('title');
            $post->provinces = $request->input('provinces');
            $post->body = $request->input('body');
            $post->user_id = auth()->user()->id;
            $post->cover_image =$fileNameToStore;
            $post->save();
            return redirect('/posts')->with('success', 'Post has been Saved.');
        }
        else {
            // Update Post
            $post = Post::find($var['postID']);
            $post->title = $var['title'];
            $post->provinces = $request->input('provinces');
            $post->body = $var['body'];
            if (!empty($post->cover_image)&& empty($request->hasFile('cover_image'))) {
                $post->cover_image = $post->cover_image;
            }
            else {
                $post->cover_image =$fileNameToStore;
            }
            $post->save();
            $result['status']  = 1;
            $result['message'] = "Post has been Updated.";
            return redirect('/posts')->with('success', 'Post has been Updated.');
        }
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function viewpost(Request $request)
    {
        $var = $request->input();
        $id = $var['id'];
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
    public function editpost(Request $request)
    {
        $var = (object) $request->all();

        $post = Post::where("id",$var->id)->first();

        if(auth()->user()->id != $post->user_id){
           
            return redirect ('/posts')->with('error','Unauthorize Page');
        }else{
            return  $post;
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatepost(Request $request)
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
        $post = Post::find($request->input('postID'));
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
    public function destroy(Request $request)
    {
        $result = array("status"=>0,"message"=>"");    
        $var = $request->input();
        $id = $var['id'];

        $post = Post::find($id);
        if(auth()->user()->id !==$post->user_id){
            $result['message'] = "This post can't be delete.";
            // return redirect ('/posts')->with('error','Unauthorize Page');
        }
        else {
            if($post->cover_image !='noimage.png'){
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
            $result['status']  = 1;
            $result['message'] = "Post has been deleted.";
            $post->delete();
        }
        return $result;

        // return redirect ('/posts')-> with('success', 'Post Remove'); 
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
           return back();
        }
        else{
            return back();
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
            return back();
        }
        else{
            return back();
        }
 
     }
    public function postTable(Request $request){
        $var = (object) $request->all();
        // dd($var);
        // $return['_token'] = $var->_token;
        $rsql   = Post::select("posts.id","title","provinces","body",DB::raw('CONCAT(u.lastName,", ", u.firstName, " ", u.middleName) AS FullName'))->leftjoin("users as u","u.id","=","posts.user_id");
        
        $return['iTotalRecords'] = 0;
        $return['iTotalDisplayRecords'] = 0;
        $return['iTotalRecords'] = $rsql->count();
        if($request['iDisplayLength'] > 0){
            $rsql = $rsql->skip(intval($request->iDisplayStart))->take(intval($request->iDisplayLength));
        }
        $return['iTotalDisplayRecords'] =  $return['iTotalRecords'];

        $rsql = $rsql->get();
        // dd($rsql);

        $post = [];
        foreach ($rsql as $row => $key) {
            $post[$row] = array(
                'row' => $key,
            );
        }

        $array = [];
        $title = [];
        $provinces = [];
        $fullName = [];
        $actions = [];
        $num = 0;
        foreach ($post as $list => $key) {
            $title = "<p>".$key['row']->title."</p>";
            $provinces = "<p>".$key['row']->provinces."</p>";
            $body = "<p>".$key['row']->body."</p>";
            $fullName = "<p>".$key['row']->FullName."</p>";
            $actions = "<a data-id='{$key['row']->id}' class='btn btn-warning'> <i class='fa fa-eye'> </i></a>   <button name='editPost' data-id='{$key['row']->id}' class='btn btn-success editPost'value= '{$key['row']->id}'> <i class='fa fa-edit'> </i></button>
                        <button data-id='{$key['row']->id}' class='btn btn-danger'> <i class='fa fa-trash'> </i></button> ";


            // $title = implode("",$title);
            // $provinces = implode("",$provinces);
            // $body = implode("",$body);
            // $fullName = implode("",$fullName);
            // $actions = implode("",$actions);
            $num++;
            $return['iTotalRecords'] = $num;
            if (!empty($title)) {
                $array[$list] = array(     
                    $title,
                    $provinces,
                    $body,
                    $fullName,
                    $actions,
                );
            }
        
        }
        $return['var']= $var;
        $return['aaData'] = array_slice($array,0,$num);
// dd($return);
        return $return;
    }
}
