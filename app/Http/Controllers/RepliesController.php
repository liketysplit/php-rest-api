<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Replies;
use App\Models\Topics;
use App\Models\Watchers;
use App\Models\Users;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Replies::all();
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
            'post_body' => 'required|string',
            'user_id' => 'required|integer',
            'topic_id' => 'required|integer'
        ]);

        $user = Users::where('id', '=', $request->user_id)->first();
        $topic = Topics::where('id', '=', $request->topic_id)->first();
        

        $errors = [];
        if ($user === null) {
            array_push($errors, 'No such user id exists.');
        }

        if ($topic === null) {
            array_push($errors, 'No such topic id exists.');
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $reply = Replies::create($request->all());

        $watcher = Watchers::where('topic_id', '=', $request->topic_id)->where('user_id', '=', $request->user_id)->first();

        if ($watcher === null) {

            Watchers::create([
                'topic_id' => $reply->topic_id,
                'user_id' => $reply->user_id,
            ]);
        }

        return $reply;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Replies::find($id);
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
        $user = Replies::find($id);
        $user-> update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Replies::destroy($id);
    }
}
