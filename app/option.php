<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class option extends Model
{
	public $with = ['option_Lists'];
    protected $fillable = [
       'title','type','item_id','price'
    ];

     public function item() {
    	return $this->belongsTo('App\item');
    }
    public function option_Lists() {
    	return $this->hasMany('App\optionList');
    }
}
