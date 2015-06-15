<?php

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::group(['namespace'=>'Auth'],function()
{
	Route::controllers([
		'auth' => 'AuthController',
		'password' => 'PasswordController'
	]);
});

Route::get('captcha/{ide}/{random?}','CaptchaController@index');

//系统模块
Route::group(['namespace'=>'System'],function(){
    Route::group(['prefix'=>'group'],function(){
        Route::get('/','GroupController@index');
        Route::post('store','GroupController@store');
        Route::get('destroy/{id}','GroupController@destroy');
        Route::get('update/{id}','GroupController@update');
    });

    Route::group(['prefix'=>'menu'],function(){
        Route::get('/{parent_id?}','MenuController@index')->where('parent_id', '[0-9]+');
        Route::get('create/{id?}','MenuController@create');
        Route::post('create','MenuController@store');
        Route::get('update/{id}','MenuController@update');
    });

    Route::group(['prefix'=>'module'],function(){
        Route::get('/','ModuleController@index');
        Route::post('store','ModuleController@store');
        Route::any('update/{id}','ModuleController@update');
    });

    Route::group(['prefix'=>'action'],function(){
        Route::get('/','ActionController@index');
        Route::post('store','ActionController@store');
        Route::any('update/{id}','ActionController@update');
    });

    Route::group(['prefix'=>'foundation'],function(){
        Route::get('/','FoundationController@index');
        Route::get('create','FoundationController@create');
        Route::post('create','FoundationController@store');
        Route::any('update/{id}','FoundationController@update');
    });

    Route::group(['prefix'=>'user'],function(){
        Route::get('/','UserController@index');
        Route::get('show/{id}','UserController@show');
        Route::get('create','UserController@create');
        Route::post('create','UserController@store');
        Route::get('edit/{id}','UserController@edit');
        Route::post('edit/{id}','UserController@update');
        Route::get('destroy/{id}','UserController@destroy');
    });
});

//商品模块
Route::group(['namespace'=>'Goods'],function(){
    Route::group(['prefix'=>'goods'],function(){
        Route::get('/','GoodsController@index');
        Route::post('cover','GoodsController@cover');
        Route::post('store','GoodsController@store');
        Route::get('show/{id}','GoodsController@show');
        Route::post('cover-store/{id}','GoodsController@coverStore');
        Route::post('update/{id}','GoodsController@update');
        Route::get('shelve/{id}/{shelved_at}','GoodsController@shelve');
        Route::get('remove/{id}','GoodsController@remove');
    });
    Route::controller("trucks","TruckController");
});