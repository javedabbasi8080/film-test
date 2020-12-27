<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    protected $guarded = ['id']; 

    public function Genre()
    {
    	return $this->belongsToMany('App\Film');
    }
}
