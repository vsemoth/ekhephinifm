<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Audio;

class PlayController extends Controller
{
    //
    public function getSingle($audio_slug)
    {
    	# Fetch from DB based on slug
    	$audio = Audio::where('audio_slug', '=', $audio_slug)->first();

    	# Return the view and pass in the post object
    	return view('play.single')->with('audio', $audio);
    }
}
