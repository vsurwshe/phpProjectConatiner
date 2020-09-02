<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Users extends Model 
{
	protected $fillable = ['username','password','email'];
 	// public function questions(){
 	// 	return $this->hasMany('App\Question');
 	// }   
}