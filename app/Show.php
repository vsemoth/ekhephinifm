<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    //
    public function profile()
    {
    	# code...
    	return $this->hasMany('App\Profile');
    }

    public function presenter()
    {
        # code...
        return $this->belongsTo('App\Presenter');
    }

    public function audio()
    {
        # code...
        return $this->hasMany('App\Audio');
    }
}
