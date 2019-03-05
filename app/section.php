<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    protected $fillable = [
       'title','image'
    ];

    public function catg()
    {
        return $this->hasMany('App\catg');
    }
}
