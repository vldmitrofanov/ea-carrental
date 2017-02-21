<?php

Route::group(['prefix'=>'admin'],function(){
    Route::get('', 'Admin\Auth\AuthController@getLogin');
    Route::post('login', 'Admin\Auth\AuthController@login');
    Route::get('logout', 'Admin\Auth\AuthController@logout');
});

Route::group(['prefix' => 'admin', 'middleware' => ['authadmin','role:admin']], function () {
    Route::get('404', function () {
        return view('admin.errors.404');
    });
    Route::get('dashboard', 'Admin\DashboardController@index');

});

Route::get('/', function () {
    return view('welcome');
});
