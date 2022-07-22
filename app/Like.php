<?php

namespace TuklasPinas;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function posts(){
        return $this->hasMany('TuklasPinas\Post');
    }

    public function like($id){
     $posts = Post::orderBy('created_at', 'desc')->get();
     $countlike = Like::where(['like' => '1']);
     $countdislike = DisLike::where(['dislike' => '0']);
     return view('posts')->with(['posts' => $posts])->with(['countlike' =>   $countlike])->with(['countdislike' => $countdislike]);

    }
}
