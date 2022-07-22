<?php

namespace TuklasPinas;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    public function dislike($id){
    $posts = Post::orderBy('created_at', 'desc')->get();
    $countlike = Like::where(['like' => '1']);
    $countdislike = Dislike::where(['dislike' => '0']);
    return view('dashboard')->with(['posts' => $posts])->with(['countdislike' =>   $countlike])->with(['countdislike' => $countdislike]);

    }
}
