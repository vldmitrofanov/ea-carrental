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
    Route::get('fleetavailability', 'Admin\FleetAvailabilityController@index');

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
        Route::post('find_location', 'Admin\OfficeLocationController@findOfficeLocation');
    });

    Route::group(['prefix' => 'discounts'], function(){
        Route::group(['prefix' => 'vouchers'], function(){
            Route::get('/', 'Admin\Discounts\VouchersController@index');
            Route::get('/create', 'Admin\Discounts\VouchersController@create');
            Route::post('store', 'Admin\Discounts\VouchersController@store');
            Route::get('{id}/edit', 'Admin\Discounts\VouchersController@edit');
            Route::get('{id}/show', 'Admin\Discounts\VouchersController@show');
            Route::patch('update/{id}', 'Admin\Discounts\VouchersController@update');
        });

        Route::group(['prefix' => 'volume'], function(){
            Route::get('/', 'Admin\Discounts\VolumeController@index');
            Route::get('/create', 'Admin\Discounts\VolumeController@create');
            Route::post('store', 'Admin\Discounts\VolumeController@store');
            Route::get('{id}/edit', 'Admin\Discounts\VolumeController@edit');
            Route::get('{id}/show', 'Admin\Discounts\VolumeController@show');
            Route::patch('update/{id}', 'Admin\Discounts\VolumeController@update');
        });

        Route::group(['prefix' => 'freebies'], function(){
            Route::get('/', 'Admin\Discounts\FreebiesController@index');
            Route::get('/create', 'Admin\Discounts\FreebiesController@create');
            Route::post('store', 'Admin\Discounts\FreebiesController@store');
            Route::get('{id}/edit', 'Admin\Discounts\FreebiesController@edit');
            Route::get('{id}/show', 'Admin\Discounts\FreebiesController@show');
            Route::patch('update/{id}', 'Admin\Discounts\FreebiesController@update');
        });
    });


    Route::group(['prefix' => 'fleet'], function(){
        Route::group(['prefix' => 'types'], function(){
            Route::get('/', 'Admin\FleetManagement\TypesController@index');
            Route::get('/create', 'Admin\FleetManagement\TypesController@create');
            Route::post('store', 'Admin\FleetManagement\TypesController@store');
            Route::get('{id}/edit', 'Admin\FleetManagement\TypesController@edit');
            Route::patch('update/{id}', 'Admin\FleetManagement\TypesController@update');
        });

        Route::group(['prefix' => 'models'], function(){
            Route::get('/', 'Admin\FleetManagement\CarModelsController@index');
            Route::get('/create', 'Admin\FleetManagement\CarModelsController@create');
            Route::post('store', 'Admin\FleetManagement\CarModelsController@store');
            Route::get('{id}/edit', 'Admin\FleetManagement\CarModelsController@edit');
            Route::patch('update/{id}', 'Admin\FleetManagement\CarModelsController@update');
            Route::post('add_customrate', 'Admin\FleetManagement\CarModelsController@addCarTypeCustomRate');
            Route::post('remove_customrate', 'Admin\FleetManagement\CarModelsController@removeCarTypeCustomRate');
        });

        Route::group(['prefix' => 'cars'], function(){
            Route::get('/', 'Admin\FleetManagement\CarsController@index');
            Route::get('/create', 'Admin\FleetManagement\CarsController@create');
            Route::post('store', 'Admin\FleetManagement\CarsController@store');
            Route::get('{id}/edit', 'Admin\FleetManagement\CarsController@edit');
            Route::patch('update/{id}', 'Admin\FleetManagement\CarsController@update');
            Route::get('featured/{id}', 'Admin\FleetManagement\CarsController@featured');
            Route::get('publish/{id}', 'Admin\FleetManagement\CarsController@publish');

        });

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

    Route::group(['prefix' => 'cars'], function(){
        Route::get('/', 'Admin\RentalCarsController@index');
        Route::get('/create', 'Admin\RentalCarsController@create');
        Route::post('store', 'Admin\RentalCarsController@store');
        Route::get('{id}/edit', 'Admin\RentalCarsController@edit');
        Route::patch('update/{id}', 'Admin\RentalCarsController@update');
    });

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', 'Admin\UsersController@index');
        Route::get('/create', 'Admin\UsersController@create');
        Route::post('store', 'Admin\UsersController@store');
        Route::get('{id}/edit', 'Admin\UsersController@edit');
        Route::patch('update/{id}', 'Admin\UsersController@update');
        Route::get('{id}/delete', 'Admin\UsersController@destroy');
    });

    Route::group(['prefix' => 'clients'], function(){
        Route::get('/', 'Admin\ClientsController@index');
        Route::get('/create', 'Admin\ClientsController@create');
        Route::post('store', 'Admin\ClientsController@store');
        Route::get('{id}/edit', 'Admin\ClientsController@edit');
        Route::patch('update/{id}', 'Admin\ClientsController@update');
        Route::get('{id}/delete', 'Admin\ClientsController@destroy');
    });


    Route::group(['prefix' => 'reservations'], function(){
        Route::get('/', 'Admin\ReservationsController@index');
        Route::get('/create', 'Admin\ReservationsController@create');
        Route::post('store', 'Admin\ReservationsController@store');
        Route::get('{id}/edit', 'Admin\ReservationsController@edit');
        Route::patch('update/{id}', 'Admin\ReservationsController@update');
        Route::post('load_car_prices', 'Admin\ReservationsController@loadCarPrices');
        Route::post('add_payment', 'Admin\ReservationsController@addPayment');
        Route::post('remove_payment', 'Admin\ReservationsController@removePayment');
        Route::post('upload', 'Admin\ReservationsController@uploadFile');
        Route::post('validate_voucher', 'Admin\ReservationsController@validateVoucher');
        Route::get('{id}/invoice', 'Admin\ReservationsController@invoicePDF');
        Route::get('{id}/delete', 'Admin\ReservationsController@destroy');
        Route::post('calculate_difference', function(){
            $from = \Carbon\Carbon::parse(Request::get('date_from'));
            $to = \Carbon\Carbon::parse(Request::get('date_to'));
            $datetime1 = new \DateTime($to); // Today's Date/Time
            $datetime2 = new \DateTime($from);
            $interval = $datetime1->diff($datetime2);
//        echo $interval->format('%D days %H hours');
            $data['days'] = $interval->format('%D');
            $data['hours'] = $interval->format('%H');
            return $data;
        });
    });

    Route::group(['prefix' => 'settings'], function(){
        Route::get('/', 'Admin\SettingsController@index');
        Route::get('/create', 'Admin\SettingsController@create');
        Route::post('store', 'Admin\SettingsController@store');
        Route::get('{id}/edit', 'Admin\SettingsController@edit');
        Route::patch('update/{id}', 'Admin\SettingsController@update');
    });

    Route::group(['prefix' => 'notifications'], function(){
        Route::get('/', 'Admin\NotificationsController@index');
        Route::get('/create', 'Admin\NotificationsController@create');
        Route::post('store', 'Admin\NotificationsController@store');
        Route::get('{id}/edit', 'Admin\NotificationsController@edit');
        Route::patch('update/{id}', 'Admin\NotificationsController@update');
    });

});

Route::get('api/load_car_models_list', function(){
    $data['data']['cars'] = \App\CarModel::where('type_id',Request::get('car_type_id'))->get();
    return $data;
});

Route::get('api/load_model_cars_list', function(){
    $data['data']['cars'] = \App\RentalCar::where('model_id',Request::get('model_id'))->get();
    return $data;
});

Route::get('api/email_tags', function(){
    $data['tags'] = config('settings.email_tags');
    return $data;
});

Route::get('api/load_car_list', function(){
    $data['data']['cars'] = \App\CarType::where('id',Request::get('car_type_id'))->first()->cars()->get();
//    $data['data']['extras'] = \App\CarType::where('id',Request::get('car_type_id'))->first()->extras()->get();
    return $data;
});
Route::get('api/load_extras', function(){
//    $data['data']['cars'] = \App\CarType::where('id',Request::get('car_type_id'))->first()->cars()->get();
    $data['data']['extras'] = \App\CarModel::where('id',Request::get('car_model_id'))->first()->extras()->get();
    $oSetting = \App\Setting::where('key', 'currency')->first();
    $data['data']['currency'] = ($oSetting)?$oSetting->value:'USD';
    return $data;
});

Route::get('/', 'IndexController@index');

Route::get('register', 'UsersController@getRegistration')->middleware('guest');
Route::post('register', 'Auth\RegisterController@register')->middleware('guest');
Route::get('login', 'UsersController@getLogin')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->middleware('guest');
Route::get('logout', 'Auth\LoginController@logout');


Route::group(['prefix' => 'fleet'], function(){
    Route::get('{token}', 'FleetController@detail');
    Route::post('load_car_prices', 'FleetController@loadCarPrices');
    Route::post('calculate_difference', function(){
        $from = \Carbon\Carbon::parse(Request::get('rdate_start'));
        $to = \Carbon\Carbon::parse(Request::get('rdate_end'));
        $datetime1 = new \DateTime($to); // Today's Date/Time
        $datetime2 = new \DateTime($from);
        $interval = $datetime1->diff($datetime2);
        $data['days'] = $interval->format('%D');
        $data['hours'] = $interval->format('%H');
        $data['start'] = $from->format('m/d/Y H:i');
        $data['end'] = $to->format('m/d/Y H:i');
        $data['start_date'] = $from->format('d F Y');
        $data['start_time'] = $from->format('l H:i');

        $data['end_date'] = $to->format('d F Y');
        $data['end_time'] = $to->format('l H:i');
        return $data;
    });
});

Route::group(['prefix' => 'cart'], function (){
    Route::post('add', 'CartController@add');
    Route::get('checkout', 'CartController@checkout');
});