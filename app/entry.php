<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entry extends Model
{
	public $with = ['user'];
    protected $fillable =['user_id','msg','name','phone','email','snap','insta','address'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
