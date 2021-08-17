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
        //Get associated user and topic
        $user = Users::where('id', '=', $request->user_id)->first();
        $topic = Topics::where('id', '=', $request->topic_id)->first();
        

        //route protection for errors on bad user and topic
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

        //create the reply
        $reply = Replies::create($request->all());

        //collect watcher if exist to keep from duplication
        $watcher = Watchers::where('topic_id', '=', $request->topic_id)->where('user_id', '=', $request->user_id)->first();

        //collect the topic and watchers for alerts
        $topic = Topics::where('id', '=', $request->topic_id)->first();
        $watchers = Watchers::where('topic_id', '=', $request->topic_id)->get();

        //alert each user printing out to line right now
        foreach ($watchers as &$value) {
            $user = Users::where('id', '=', $value->user_id)->first();
            // $topic = Topics::where('topic_id', '=', $value->topic_id)->first();
            file_put_contents('php://stderr', print_r("Notifying User: " .$user->username. " at: " .$user->email. " for change on topic id: " .$topic->id. " - " .$topic->title. "\n", TRUE));
        }

        //Add the user to the watch so that they can get future updates on change
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
        //simple update
        $reply = Replies::find($id);
        $reply-> update($request->all());
        return $reply;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //simple delete
        return Replies::destroy($id);
    }
}
