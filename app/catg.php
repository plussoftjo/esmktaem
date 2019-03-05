<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class catg extends Model
{
	public $with =  ['section'];
   protected $fillable = [
       'title','section_id','image'
    ];

    public function section() {
    	return $this->belongsTo('App\section');
    }
}
