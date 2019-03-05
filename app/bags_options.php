<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bags_options extends Model
{
    protected $fillable = [
       'bags_id','option_id','title','value'
    ];

    public function bags() {
    	return $this->belongsTo('bags');
    }
}
