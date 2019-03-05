<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class market extends Model
{

	public $with =  ['User','items'];
    protected $fillable = [
       'user_id','country','section_id','logo','des','city','catgs','rate','color','title'
    ];

     public function User() {
    	return $this->belongsTo('App\User');
    }
    public function items() {
    	return $this->hasMany('App\item');
    }

    public function favmarkets() {
        return $this->hasMany('App\favmarkets');
    }
    
}
