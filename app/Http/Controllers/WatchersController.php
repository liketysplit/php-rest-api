<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchers;

class WatchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Return List of watchers
        return Watchers::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'topic_id' => 'required|string'
        ]);

        //Check for exists and return empty if already set
        $watcher = Watchers::where('topic_id', '=', $request->topic_id)->where('user_id', '=', $request->user_id)->first();

        if ($watcher != null) return '';
        
        //Return value if stored
        return Watchers::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find a specific watcher
        return Watchers::find($id);
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
        //unused
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a watch
        return Watchers::destroy($id);
    }
}
