<?php

namespace TuklasPinas;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
 //Table Name
 protected $table = 'tasks';
 //Primary Key
 public $primaryKey ='id';
 //Timestamps
 public $timestamps = true;

 public function user(){
    return $this->belongsTo('TuklasPinas\User');
    return $this->belongsTo(User::class);
}

}
