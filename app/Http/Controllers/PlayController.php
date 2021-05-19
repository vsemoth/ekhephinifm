<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Audio;
use App\Show;

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

    public function getIndex()
    {
        // Get DB Data
        $multipleaudio = Audio::orderBy('id', 'desc')->paginate(10);
        $shows = Show::all();

        // Return Index View
        return view('play.index')->withMultipleaudio($multipleaudio)->withShows($shows);
    }
}
