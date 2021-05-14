<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Audio;
use App\Show;
use App\User;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get DB Data
        $audiofiles = Audio::orderBy('id', 'desc')->paginate(10);
        $shows = Show::all();

        // Return Index View
        return view('audio.index')->withAudiofiles($audiofiles)->withShows($shows);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get DB Data
        $users = User::all();
        $shows = Show::all();

        // Return Create View
        return view('audio.create')->withUsers($users)->withShows($shows);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $name, string $divider = '-')
    {
        // Validate Request
        $this->validate($request, [
            'presenter_id' => 'required|integer',
            'show_id' => 'required|integer',
            /*'audio_slug' => 'required|alpha_dash|min:5|max:255',*/
            'audio_title' => 'required|file'
        ]);

        // dd($request);

        $audio = new Audio;

          $audioPath = $request->file('audio_title');
          $name = $audioPath->getClientOriginalName();

        if ($request->file('audio_title')) {
          // replace non letter or digits by divider
          $name = preg_replace('~[^\pL\d]+~u', $divider, $name);

          // transliterate
          $name = iconv('utf-8', 'us-ascii//TRANSLIT', $name);

          // remove unwanted characters
          $name = preg_replace('~[^-\w]+~', '', $name);

          // trim
          $name = trim($name, $divider);

          // remove duplicate divider
          $name = preg_replace('~-+~', $divider, $name);

          // lowercase
          $audioName = strtolower($name);

          if (empty($audioName)) {
            return 'n-a';
          }

          /*return $name;*/

          $path = $request->file('audio_title')->move('audio', $audioName.'.mp3');
        }

        $audio->presenter_id = $request->input('presenter_id');
        $audio->show_id = $request->input('show_id');
        $audio->audio_title = $audioName;
        $audio->audio_slug = $audioName;

        $audio->save();

        // Return Redirect
        return redirect()->route('audiofiles.index')->with('success', 'Show Audio uploaded successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get DB Data for single item using item id
        $audio = Audio::find($id);

        // Return Audio Player with Audio Data
        return view('audio.show')->withAudiofile($audio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find audio item
        $audio = Audio::find($id);

        // Process Destroy Function
        $audio->delete();

        // Return Redirect
        return back()->with('success', 'Show audio deleted!');
    }
}
