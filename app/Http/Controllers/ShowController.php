<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Presenter;
use App\User;
use App\Show;

class ShowController extends Controller
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
        $shows = Show::all();
        $users = User::all();

        // Return Index View
        return view('shows.index')->withShows($shows)->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get Category Data from DB
        $users = User::all();

        $categories = Category::all();

        $presenters = Presenter::all();

        // Return Index View
        return view('shows.create')->withCategories($categories)->withUsers($users)->withPresenters($presenters);
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
            'category_id' => 'required|integer',
            'presenter_id' => 'required|integer',
            'show_title' => 'required|string'
        ]);

        // dd($request);

        $show = new Show;

        $show->category_id = $request->input('category_id');
        $show->presenter_id = $request->input('presenter_id');
        // $show->profile_id = $request->input('profile_id');
        // $show->listen_status = $request->input('listen_status');
        $show->show_title = $request->input('show_title');

        $show->save();

        return back()->with('success', 'Show Created Successfully');
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
        $show = Show::find($id);

        // Return Show Page with DB Data
        return view('shows.show')->with('show', $show);
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
