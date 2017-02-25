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

    Route::group(['prefix' => 'locations'], function(){
        Route::get('/', 'Admin\OfficeLocationController@index');
        Route::get('/create', 'Admin\OfficeLocationController@create');
        Route::post('store', 'Admin\OfficeLocationController@store');
        Route::get('{id}/edit', 'Admin\OfficeLocationController@edit');
        Route::get('{id}/delete', 'Admin\OfficeLocationController@destroy');
        Route::patch('update/{id}', 'Admin\OfficeLocationController@update');
        Route::post('location_customtime', 'Admin\OfficeLocationController@locationCustomTime');
        Route::post('remove_customtime', 'Admin\OfficeLocationController@removeLocationCustomTime');
        Route::post('load_customtime', 'Admin\OfficeLocationController@loadLocationCustomTime');
    });

    Route::group(['prefix' => 'types'], function(){
        Route::get('/', 'Admin\CarTypes\TypesController@index');
        Route::get('/create', 'Admin\CarTypes\TypesController@create');
        Route::post('store', 'Admin\CarTypes\TypesController@store');
        Route::get('{id}/edit', 'Admin\CarTypes\TypesController@edit');
        Route::patch('update/{id}', 'Admin\CarTypes\TypesController@update');
        Route::post('add_customrate', 'Admin\CarTypes\TypesController@addCarTypeCustomRate');
        Route::post('remove_customrate', 'Admin\CarTypes\TypesController@removeCarTypeCustomRate');
    });

    Route::group(['prefix' => 'extras'], function(){
        Route::get('/', 'Admin\CarExtrasController@index');
        Route::get('/create', 'Admin\CarExtrasController@create');
        Route::post('store', 'Admin\CarExtrasController@store');
        Route::get('{id}/edit', 'Admin\CarExtrasController@edit');
        Route::patch('update/{id}', 'Admin\CarExtrasController@update');
    });

});

Route::get('/', function () {
    return view('welcome');
});
