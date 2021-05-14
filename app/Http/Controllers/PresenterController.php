<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presenter;
use App\Profile;
use Auth;

class PresenterController extends Controller
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
        $presenters = Presenter::all();
        $profiles = Profile::all();

        // Retun index page
        return view('admin.presenters.index')->withPresenters($presenters)->withProfiles($profiles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Request
        $this->validate($request, [
            'profile_id' => 'required|integer',
            'username' => 'required|string',
            'presenter_status' => 'required|integer'
        ]);

        // dd($request);

        $presenter = new Presenter;

        $presenter->profile_id = $request->input('profile_id');
        $presenter->username = $request->input('username');
        $presenter->presenter_status = $request->input('presenter_status');

        $presenter->save();

        // Return redirect
        return back()->with('success', 'Presenter status created successfully');
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
            'profile_id' => 'required|integer',
            'presenter_status' => 'required|integer'
        ]);

        // dd($request);

        $presenter = Presenter::find($id);

        $presenter->profile_id = $request->input('profile_id');
        $presenter->presenter_status = $request->input('presenter_status');

        $presenter->save();

        // Return redirect
        return back()->with('success', 'Presenter status updated successfully');
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
