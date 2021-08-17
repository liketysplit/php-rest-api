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

        $user = Users::where('id', '=', $request->user_id)->first();

        if ($user === null) {
            return ['error'=> 'No such user id exists.'];
        }

        $topic = Topics::create($request->all());

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
        $topic = Topics::find($id);
        if($topic === null) return '';
        
        $topic['replies'] = Replies::where('topic_id','=', $topic->id)->get();
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
        $user = Topics::find($id);
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
        $replies = Replies::where('topic_id','=', $id)->get();
        $watchers = Watchers::where('topic_id','=', $id)->get();
        

        foreach ($replies as &$value) {
            Replies::destroy($value->id);
        }

        foreach ($watchers as &$value) {
            Watchers::destroy($value->id);
        }

        return Topics::destroy($id);;//TODO: Delete related data to topic on delete
    }
}
