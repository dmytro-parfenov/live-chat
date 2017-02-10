<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('/send-user-name', 'Frontend\ChatController@sendUserName');
Route::post('/send-message', 'Frontend\ChatController@sendMessage');

Route::get('/', 'Frontend\ChatController@index');
Route::get('/subscribe-message', 'Frontend\ChatController@subscribeMessage');
