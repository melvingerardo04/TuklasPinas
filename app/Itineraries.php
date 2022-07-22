<?php

namespace TuklasPinas;

use Illuminate\Database\Eloquent\Model;

class Itineraries extends Model
{
    protected $fillable = ['provinces_id', 'days', 'places','time', 'activities', 'expenses'];
 
    public function user(){
        return $this->belongsTo('TuklasPinas\User');
        return $this->belongsTo(User::class);
    } 
    public function provinces(){
        return $this->belongsTo('TuklasPinas\Provinces');
        return $this->belongsTo(Provinces::class);
    }

}
