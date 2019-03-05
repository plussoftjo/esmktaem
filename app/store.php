<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class store extends Model
{
	public $with = ['user'];
    protected $fillable =['user_id','item_id','image','content','type'];

     public function user() {
    	return $this->belongsTo('App\User');
    }
}
