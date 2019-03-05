<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class favmarket extends Model
{
	public $with = ['market'];
    protected $fillable = ['user_id','market_id'];
    public function market() 
    {
    	return $this->belongsTo('App\market');
    }
}
