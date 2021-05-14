<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    //
	public function show()
	{
		# code...
		return $this->belongsTo('App\Show');
	}
}
