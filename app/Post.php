<?php

namespace TuklasPinas;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table = 'posts';
    //Primary Key
    public $primaryKey ='id';
    //Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('TuklasPinas\User');
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
    public function likes(){
        return $this->hasMany('TuklasPinas\Like');
    }
    public function dislikes(){
        return $this->hasMany('TuklasPinas\Dislike');
    }
    
}
