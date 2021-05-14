<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //

    public function category()
    {
        # code...
        return $this->belongsTo('App\Category');
    }

    public function profile()
    {
        # code...
        return $this->belongsTo('App\Profile');
    }
}
