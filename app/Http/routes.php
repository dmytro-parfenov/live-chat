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

Route::group(['prefix' => 'master', 'middleware' => 'auth.basic'], function(){

    Route::get('/', 'Admin\AdminSettingsController@index');

    Route::controllers([
        'settings' 				=> 'Admin\AdminSettingsController',
        'messages' 				=> 'Admin\AdminMessagesController',
        'messages-map' 			=> 'Admin\AdminMessagesMapController',
        'devices-statistics' 	=> 'Admin\AdminDevicesStatisticsController',
        'users'					=> 'Admin\AdminUsersController'
    ]);
});

Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::post('/send-user-name', 'Frontend\ChatController@sendUserName');
Route::post('/send-message', 'Frontend\ChatController@sendMessage');
Route::post('/show-more-messages', 'Frontend\ChatController@showMoreMessages');
Route::post('/send-location', 'Frontend\BaseController@sendLocation');
Route::post('/send-device-info', 'Frontend\BaseController@sendDeviceInfo');

Route::get('/', 'Frontend\ChatController@index');
