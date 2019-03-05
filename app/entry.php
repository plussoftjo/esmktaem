<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entry extends Model
{
	public $with = ['user'];
    protected $fillable =['user_id','msg'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
