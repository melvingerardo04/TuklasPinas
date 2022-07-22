<?php

namespace TuklasPinas;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;



class User extends Authenticatable
{
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName','middleName','lastName','birthday','gender','userType','email', 'password',
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function home(){
        return $this->hasMany('TuklasPinas\Home');
    }
    public function posts(){
        return $this->hasMany('TuklasPinas\Post');
    }
    public function tasks(){
        return $this->hasMany('TuklasPinas\Task');
    }
    public function likes(){
        return $this->hasMany('TuklasPinas\Like');
    }
    public function dislikes(){
        return $this->hasMany('TuklasPinas\Dislike');
    }
    public function itineraries(){
        return $this->hasMany('TuklasPinas\Itineraries');
    }
    public function provinces(){
        return $this->hasMany('TuklasPinas\Provinces');
    }
    public function addNew($input)
    {
        $check = static::where('facebook_id',$input['facebook_id'])->first();


        if(is_null($check)){
            return static::create($input);
        }


        return $check;
    }

    
}
