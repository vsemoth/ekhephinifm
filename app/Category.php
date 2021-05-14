<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    // Category ProfileImage Relationship
    public function images()
    {
    	# code...
    	return $this->hasMany('App\Image');
    }

    // Category ProfileImage Relationship
    public function shows()
    {
    	# code...
    	return $this->hasMany('App\Show');
    }

    // Category Posts Relationship
    public function posts()
    {
    	# code...
    	return $this->hasMany('App\Post');
    }
}
