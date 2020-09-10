<?php

namespace TuklasPinas;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $fillable = ['provinces_name','days1','nights','budget'];

    public function itineraries(){
        return $this->belongsTo('TuklasPinas\Itineraries');
        return $this->belongsTo(Itineraries::class);
    }
    public function user(){
        return $this->belongsTo('TuklasPinas\User');
        return $this->belongsTo(User::class);
    } 
}
