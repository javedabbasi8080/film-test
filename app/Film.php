<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $guarded = ['id']; 

    //
    public function genre()
    {
    	return $this->belongsToMany('App\Genre','genre_film');
    }

    public function gallery()
    {
    	return $this->hasOne('App\Gallery','source_id');
    }

    public function ratting()
    {
    	return $this->hasMany('App\Rating');
    }
}
