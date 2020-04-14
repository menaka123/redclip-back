<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', 'PostController@index');

Route::get('post/{id}', 'PostController@show');

Route::get('post/up-vote/{id}', 'PostController@upVote');

Route::post('post', 'PostController@store');

Route::post('comment', 'CommentController@store');

Route::get('comment/up-vote/{id}', 'CommentController@upVote');