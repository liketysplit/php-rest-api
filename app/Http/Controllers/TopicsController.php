<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topics;
use App\Models\Replies;
use App\Models\Watchers;
use App\Models\Users;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //simple get of topics
        return Topics::all();
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
            'title' => 'required|string',
            'post_body' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        //find a user to ensure they exist
        $user = Users::where('id', '=', $request->user_id)->first();

        if ($user === null) {
            return ['error'=> 'No such user id exists.'];
        }

        //create a topic if user exists
        $topic = Topics::create($request->all());

        //create a watcher for the new topic for the requested user
        Watchers::create([
            'topic_id' => $topic->id,
            'user_id' => $topic->user_id,
        ]);

        return $topic;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find a singular topic
        $topic = Topics::find($id);

        //null proctection for adding replies
        if($topic === null) return '';

        //add replies to topic before retrieval
        $topic['replies'] = Replies::where('topic_id','=', $topic->id)->get();

        //return topic
        return $topic;
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
        $topic = Topics::find($id);
        $topic-> update($request->all());
        return $topic;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $replies = Replies::where('topic_id','=', $id)->get();
        $watchers = Watchers::where('topic_id','=', $id)->get();
        
        //Delete each associated reply
        foreach ($replies as &$value) {
            Replies::destroy($value->id);
        }

        //Delete each associated watcher
        foreach ($watchers as &$value) {
            Watchers::destroy($value->id);
        }

        //Delete Topic
        return Topics::destroy($id);
    }
}
