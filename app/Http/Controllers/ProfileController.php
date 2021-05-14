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

        if ($request->file('image')) {
          $imagePath = $request->file('image');
          $imageName = $imagePath->getClientOriginalName();

          $path = $request->file('image')->storeAs('uploads/images', $imageName, 'public');
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
            'username' => 'required|string'
        ]);

        $profile = Profile::find($id);

        $profile->username = $request->input('username');

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
        //
    }
}
