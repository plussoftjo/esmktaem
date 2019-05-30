<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bags extends Model
{

	public $with = ['user','item','bags_options'];
    protected $fillable = [
       'user_id','qty','item_id','specal'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    } 
     public function item() {
    	return $this->belongsTo('App\item');
    } 

    public function bags_options() {
        return $this->hasMany('App\bags_options');
    }
}
