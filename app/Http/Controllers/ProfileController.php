<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Image;
use Auth;

class ProfileController extends Controller
{    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get DB Data
        $profiles = Profile::all();

        // Return Form
        return view('profiles.index')->withProfiles($profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get DB Data
        $img = Profile::orderBy('created_at', 'desc')->take(1)->first();

        // Return Form
        return view('profiles.create')->withImg($img);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Request Data
        // dd($request);

        $this->validate($request, [
            'image' => 'required|image',
            'username' => 'required|email',
            'user_id' => 'required|integer'
        ]);

        // Initialize affected Models
        $image = new Image;

        $profile = new Profile;

          $imagePath = $request->file('image');
          $name = $imagePath->getClientOriginalName();
          $ext = $imagePath->getClientOriginalExtension();
          dd($ext);
        if ($request->file('image')) {

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
          $imageName = strtolower($name);

          if (empty($imageName)) {
            return 'n-a';
          }

          /*return $name;*/

          $path = $request->file('image')->storeAs('uploads/images', $imageName . '.' . $ext, 'public');
        }

        // Write to Profile
        $profile->user_id = $request->input('user_id');
        $profile->username = $request->input('username');

        $profile->save();

        // Write to Image
        $image->image = $imageName;
        $image->image_path = '/storage/'.$path;
        $image->profile_id = Auth::user()->profile->id;

        $image->save();

        // Return redirect
        return back()->with('success', 'Profile updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get DB Data
        $profile = Profile::find($id);

        // Return Form
        return view('profiles.edit')->withProfile($profile);
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
        // Validate Request
        $this->validate($request, [
            'username' => 'required|string',
            'show_id' => 'integer|max:10'
        ]);

        $profile = Profile::find($id);

        $profile->username = $request->input('username');
        $profile->show_id = $request->input('show_id');

        $profile->save();

        return back()->with('success', 'Username updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find Profile by ID
        $profile = Profile::find($id);

        // / Find Image by ID
        $image = Image::find($id);
    }
}
