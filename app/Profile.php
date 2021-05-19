<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //

    public function user()
    {
        # code...
        return $this->belongsTo('App\User');
    }

    public function presenter()
    {
        return $this->hasOne('App\Presenter');
    }

    public function image()
    {
        # code...
        return $this->hasMany('App\Image');
    }

    public function show()
    {
        # code...
        $this->belongsTo('App\Show');
    }

    public function audio()
    {
        # code...
        return $this->belongsToMany('App\Audio');
    }
}
