<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitor;
use JavaScript;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get DB Items
        $visitors = Visitor::all();

        JavaScript::put([

            'visitors' => $visitors

        ]);

        // Return view with DB data
        // return view('welcome')->with('visitors', $visitors);
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
            'ip' => 'required|ipv4'
        ]);

        // dd($request);

        $visitor = new Visitor;

        $visitor->ip = $request->input('ip');

        $visitor->save();

        return back();
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
