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

    Route::group(['prefix' => 'offeritem'],function (){
        Route::get('/',[
            'uses' => 'OfferitemController@index',
            'as' => 'offeritem.index'
        ]);
        Route::get('/add',[
            'uses' => 'OfferitemController@create',
            'as' => 'offeritem.add'
        ]);
        Route::post('/add',[
            'uses' => 'OfferitemController@store',
            'as' => 'offeritem.store'
        ]);

        Route::get('/edit/{id}',[
            'uses' => 'OfferitemController@edit',
            'as' => 'offeritem.edit'
        ]);

        Route::post('/edit/{id}',[
            'uses' => 'OfferitemController@update',
            'as' => 'offeritem.update'
        ]);

        Route::post('/delete/{id}',[
            'uses' => 'OfferitemController@destroy',
            'as' => 'offeritem.delete'
        ]);

    });
    Route::group(['prefix' => 'specialoffer'],function(){
        Route::get('/',[
            'uses' => 'SpecialofferController@create',
            'as' => 'special.create'
        ]);
        Route::post('/',[
            'uses' => 'SpecialofferController@store',
            'as' => 'special.store'
        ]);
        Route::post('/{id}',[
            'uses' => 'SpecialofferController@update',
            'as' => 'special.update'
        ]);
    });

    Route::group(['prefix' => 'location'],function (){

           Route::get('country/list',[
               'uses' => 'CountryController@index',
               'as' => 'country.list'
           ]);
           Route::get('country/add',[
               'uses' => 'CountryController@create',
               'as' => 'country.create'
           ]);
           Route::post('country/add',[
               'uses' => 'CountryController@store',
               'as' => 'country.store'
           ]);
           Route::get('country/edit/{id}',[
               'uses' => 'CountryController@edit',
               'as' => 'country.edit'
           ]);
        Route::post('country/edit/{id}',[
            'uses' => 'CountryController@update',
            'as' => 'country.update'
        ]);
           Route::post('country/delete/{id}',[
               'uses' => 'CountryController@destroy',
               'as' => 'country.delete'
           ]);


        Route::get('state/list',[
            'uses' => 'StateController@index',
            'as' => 'state.list'
        ]);
        Route::get('state/add',[
            'uses' => 'StateController@create',
            'as' => 'state.create'
        ]);
        Route::post('state/add',[
            'uses' => 'StateController@store',
            'as' => 'state.store'
        ]);
        Route::get('state/edit/{id}',[
            'uses' => 'StateController@edit',
            'as' => 'state.edit'
        ]);
        Route::post('state/edit/{id}',[
            'uses' => 'StateController@update',
            'as' => 'state.update'
        ]);
        Route::post('state/delete/{id}',[
            'uses' => 'StateController@destroy',
            'as' => 'state.delete'
        ]);

    });

});
