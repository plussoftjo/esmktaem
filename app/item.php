<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
	public $with = ['options'];
    protected $fillable = [
       'market_id','title','price','des','catg','image'
    ];

     public function market() {
    	return $this->belongsTo('App\market');
    }

    public function options() {
    	return $this->hasMany('App\option');
    }

    public function bags() {
        return $this->belongsTo('App\bag');
    } 

    public function meals() {
        return $this->hasMany('App\meal');
    }
}
