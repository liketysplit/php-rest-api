<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Users;
use App\Models\Topics;
use App\Models\Replies;
use App\Models\Watchers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users', function() {
    return Users::all();
});

Route::get('/topics', function() {
    return Topics::all();
});

Route::get('/replies', function() {
    return Replies::all();
});

Route::get('/watchers', function() {
    return Watchers::all();
});

Route::post('/users', function() {
    return Users::create([
        'username' => 'myUsername',
        'email' => 'myEmail@gmail.com'
    ]);
});

Route::post('/topics', function() {
    return Topics::create([
        'user_id' => 1,
        'post_body' => 'my first post',
        'title' => 'my first post\'s title',
    ]);
});

Route::post('/replies', function() {
    return Replies::create([
        'user_id' => 1,
        'post_body' => 'replying to my first post',
        'topic_id' =>  1,
    ]);
});

Route::post('/watchers', function() {
    return Watchers::create([
        'user_id' => 1,
        'topic_id' => 1
    ]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
