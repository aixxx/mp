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
Route::get('/', function () {
    return view('welcome');
});

Route::any('/api', 'ServerController@server');

/*
    * Admin
 */
$admin = [
            'prefix' => 'admin',
            'namespace' => 'Admin',
            'middleware' => 'admin',
         ];

Route::group($admin, function () {
    Route::get('/', 'AccountController@getManage');
    Route::controller('account', 'AccountController');
    Route::controller('auth', 'AuthController');

    Route::group(['middleware' => 'account'], function () {
        Route::controllers([
            'user' => 'UserController',
            'fan' => 'FanController',
            'fan-group' => 'FanGroupController',
            'menu' => 'MenuController',
            'material' => 'MaterialController',
            'staff' => 'StaffController',
            'message' => 'MessageController',
            'reply' => 'ReplyController',
            'upload' => 'UploadController',
        ]);
    });
});
