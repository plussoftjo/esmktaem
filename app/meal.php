<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meal extends Model
{
	public $with = ['item'];
    protected $fillable= ['user_id','item_id','type'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function item() {
    	return $this->belongsTo('App\item');
    }
}
