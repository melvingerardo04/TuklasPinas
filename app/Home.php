<?php

namespace TuklasPinas;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Home extends Authenticatable{
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function posts(){
        return $this->hasMany('TuklasPinas\Post');
    }
    public function likes(){
        return $this->hasMany('TuklasPinas\Like');
    }
    public function dislikes(){
        return $this->hasMany('TuklasPinas\Dislike');
    }
    public function user(){
        return $this->belongsTo('TuklasPinas\User');
        return $this->belongsTo(User::class);
    } 



}