<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class starfav extends Model
{
	public $with =['user'];
    protected $fillable= ['user_id','auth'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
