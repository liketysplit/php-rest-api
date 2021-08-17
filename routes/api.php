<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\WatchersController;

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

//Resources
Route::resource('users', UsersController::class);
Route::resource('topics', TopicsController::class);
Route::resource('replies', RepliesController::class);
Route::resource('watchers', WatchersController::class);