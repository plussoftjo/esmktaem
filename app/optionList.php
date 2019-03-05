<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class optionList extends Model
{
    protected $fillable = [
       'title','option_id','price'
    ];

     public function option() {
    	return $this->belongsTo('App\option');
    }
}
