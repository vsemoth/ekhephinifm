<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presenter extends Model
{
    //
    protected $fillable = ['presenter_id','show_name','time','day'];

    public function show()
    {
    	# code...
    	return $this->hasMany('App\Show');
    }

    public function profile()
    {
    	return $this->belongsTo('App\Profile');
    }
}
