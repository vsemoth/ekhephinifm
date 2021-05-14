<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Profile;
use Auth;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get DB Data from Image Model
        $images = Image::orderBy('created_at', 'desc')->get();

        // Return Index view
        return view('images.index')->withImages($images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Validate Data Request
        $this->validate($request, [
            'image' => 'image'
        ]);

        $image = new Image;

        if ($request->file('image')) {
          $imagePath = $request->file('image');
          $imageName = $imagePath->getClientOriginalName();

          $path = $request->file('image')->storeAs('uploads/images', $imageName, 'public');
        }
        dd($request->image);
        // Write to Image
        $image->image = $imageName;
        $image->image_path = '/storage/'.$path;
        $image->profile_id = Auth::user()->profile->id;

        $image->save();

        // Return redirect
        return back()->with('success', 'Profile updated successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
