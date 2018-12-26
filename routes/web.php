<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[
    'uses' => 'HomeController@index',
    'as' => 'home.index'
]);


Route::group(['prefix' => 'admin'],function (){

    Route::get('/dashboard',[
        'uses' => 'AdminController@index',
        'as' => 'admin.index'
    ]);

    Route::group(['prefix' => 'menu'],function (){
        Route::get('/',[
            'uses' => 'MenuController@index',
            'as' => 'menu.index'
        ]);

        Route::get('/add',[
            'uses' => 'MenuController@create',
            'as' => 'menu.add'
        ]);
        Route::post('/add',[
            'uses' => 'MenuController@store',
            'as' => 'menu.store'
        ]);
        Route::get('/list',[
            'uses' => 'MenuController@list',
            'as' => 'menu.list'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'MenuController@edit',
            'as' => 'menu.edit'
        ]);
        Route::post('/edit/{id}',[
            'uses' => 'MenuController@update',
            'as' => 'menu.update'
        ]);
        Route::post('/delete/{id}',[
            'uses' => 'MenuController@destroy',
            'as' => 'menu.delete'
        ]);
    });

    Route::group(['prefix' => 'category'],function (){
       Route::get('/',[
           'uses' => 'CategoryController@index',
           'as' => 'category.index'
       ]);

        Route::get('/add',[
            'uses' => 'CategoryController@create',
            'as' => 'category.add'
        ]);

        Route::post('/add',[
            'uses' => 'CategoryController@store',
            'as' => 'category.store'
        ]);

        Route::get('/list',[
            'uses' => 'CategoryController@list',
            'as' => 'category.list'
        ]);

        Route::get('/edit/{id}',[
            'uses' => 'CategoryController@edit',
            'as' => 'category.edit'
        ]);

        Route::post('/edit/{id}',[
            'uses' => 'CategoryController@update',
            'as' => 'category.update'
        ]);

        Route::post('/delete/{id}',[
            'uses' => 'CategoryController@destroy',
            'as' => 'category.delete'
        ]);

    });

    Route::group(['prefix' => 'slider'],function (){
       Route::get('/',[
           'uses' => 'SliderController@index',
           'as' => 'slider.index'
       ]);

        Route::get('/add',[
            'uses' => 'SliderController@create',
            'as' => 'slider.add'
        ]);

        Route::post('/add',[
            'uses' => 'SliderController@store',
            'as' => 'slider.store'
        ]);

        Route::get('/edit/{id}',[
            'uses' => 'SliderController@edit',
            'as' => 'slider.edit'
        ]);

        Route::post('/edit/{id}',[
            'uses' => 'SliderController@update',
            'as' => 'slider.update'
        ]);

        Route::post('/delete/{id}',[
            'uses' => 'SliderController@destroy',
            'as' => 'slider.delete'
        ]);
    });

});
