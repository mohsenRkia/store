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

Route::post('/register/create',[
    'uses' => 'RegisterController@store',
    'as' => 'register.store'
]);

Route::get('/product/{id}/{slug}',[
    'uses' => 'ProductController@show',
    'as' => 'site.product.show'
]);
Route::post('/basket/add/{id}',[
    'uses' => 'BasketController@addtobasket',
    'as' => 'site.product.addtobasket'
]);
Route::post('/basket/deleteitem/{id}',[
   'uses' => 'BasketController@destroy',
   'as' => 'site.product.deleteitemfrombasket'
]);
Route::get('/baskets',[
    'uses' => 'BasketController@show',
    'as' => 'site.cart'
])->middleware('auth');

Route::post('/cart/check',[
    'uses' => 'CartController@check',
    'as' => 'site.cart.check'
])->middleware('auth');


Route::get('/payment/verify',[
    'uses' => 'PaymentController@verify',
    'as' => 'payment.verify'
]);
Route::get('/payment/unverified',[
    'uses' => 'PaymentController@unverified',
    'as' => 'payment.unverified'
]);
Route::get('/blog/{id}/{slug}',[
    'as' => 'site.blog.show',
    'uses' => 'BlogController@show'
]);
Route::get('/category/{name}',[
    'as' => 'site.category.show',
    'uses' => 'CategoryController@show'
]);
Route::get('/about',[
    'as' => 'site.about.show',
    'uses' => 'AboutController@show'
]);
Route::get('/category/{first}/{second}',[
    'as' => 'site.category.showSubs',
    'uses' => 'CategoryController@showSubs'
]);
Route::group(['prefix' => 'contactus'],function (){
   Route::get('/',[
       'as' => 'site.contactus.index',
       'uses' => 'MessageController@show'
   ]);

    Route::post('/send',[
        'as' => 'site.contactus.send',
        'uses' => 'MessageController@send'
    ]);

});

Route::get('/cart/apply','CartController@applyOrders');

Route::group(['prefix' => 'comment'],function (){

    Route::post('/store/{id}',[
        'as' => 'site.comment.store',
        'uses' => 'CommentController@store'
    ]);

});

Route::group(['prefix' => 'admin','middleware' => ['verified','isAdmin']],function (){

    Route::get('/dashboard',[
        'uses' => 'AdminController@index',
        'as' => 'admin.index'
    ]);

    Route::group(['prefix' => 'setting'],function(){
       Route::get('/',[
           'uses' => 'SettingController@index',
           'as' => 'admin.setting.index'
       ]);

        Route::post('/store',[
            'uses' => 'SettingController@store',
            'as' => 'admin.setting.store'
        ]);
        Route::post('/update/{id}',[
            'uses' => 'SettingController@update',
            'as' => 'admin.setting.update'
        ]);


    });

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

    Route::group(['prefix' => 'subcategory'],function (){
        Route::get('/add',[
            'uses' => 'SubcategoryController@create',
            'as' => 'subcategory.add'
        ]);
        Route::post('/add',[
            'uses' => 'SubcategoryController@store',
            'as' => 'subcategory.store'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'SubcategoryController@edit',
            'as' => 'subcategory.edit'
        ]);
        Route::post('/edit/{id}',[
            'uses' => 'SubcategoryController@update',
            'as' => 'subcategory.update'
        ]);
        Route::post('/delete/{id}',[
            'uses' => 'SubcategoryController@destroy',
            'as' => 'subcategory.delete'
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

    Route::group(['prefix' => 'level'],function (){
        Route::get('/',[
            'uses' => 'LevelController@index',
            'as' => 'level.index'
        ]);
        Route::get('/add',[
            'uses' => 'LevelController@create',
            'as' => 'level.create'
        ]);
        Route::post('/add',[
            'uses' => 'LevelController@store',
            'as' => 'level.store'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'LevelController@edit',
            'as' => 'level.edit'
        ]);
        Route::post('/edit/{id}',[
            'uses' => 'LevelController@update',
            'as' => 'level.update'
        ]);
        Route::post('/delete/{id}',[
            'uses' => 'LevelController@destroy',
            'as' => 'level.delete'
        ]);

    });

    Route::group(['prefix' => 'cart'],function (){
        Route::get('/',[
            'uses' => 'CartController@index',
            'as' => 'cart.index'
        ]);

        Route::get('/indexsent',[
            'uses' => 'CartController@indexSent',
            'as' => 'cart.indexsent'
        ]);



        Route::get('/show/{id}',[
            'uses' => 'CartController@show',
            'as' => 'cart.show'
        ]);

        Route::post('/store',[
            'uses' => 'CartController@store',
            'as' => 'cart.store'
        ]);

        Route::get('/edit/{id}',[
            'uses' => 'CartController@edit',
            'as' => 'cart.edit'
        ]);

        Route::post('/edit/{id}',[
            'uses' => 'CartController@update',
            'as' => 'cart.update'
        ]);

        Route::post('/delete/{id}',[
            'uses' => 'CartController@destroy',
            'as' => 'cart.delete'
        ]);
    });

    Route::group(['prefix' => 'factor'],function (){
       Route::post('/approve/{id}',[
           'uses' => 'FactorController@approve',
           'as' => 'factor.approve'
       ]) ;
    });

    Route::group(['prefix' => 'profile'],function (){
       Route::get('/edit/{id}',[
           'uses' => 'ProfileController@edit',
           'as' => 'profile.index'
       ]);
        Route::post('/edit/{id}',[
            'uses' => 'ProfileController@update',
            'as' => 'profile.update'
        ]);
        Route::post('/getstate',[
            'uses' => 'ProfileController@getstate',
            'as' => 'profile.getstate'
        ]);
        Route::post('/changepassword/{id}',[
            'uses' => 'ProfileController@changepassword',
            'as' => 'profile.changepassword'
        ]);
    });

    Route::group(['prefix' => 'user'],function (){
       Route::get('/',[
           'uses' => 'UserController@list',
           'as' => 'admin.users.list'
       ]);

       Route::get('/edit/{id}',[
           'uses' => 'UserController@showuser',
           'as' => 'admin.user.showuser'
       ]);

        Route::post('/update/{id}',[
            'uses' => 'UserController@updateuser',
            'as' => 'admin.user.updateuser'
        ]);


       Route::post('/delete/{id}', 'UserController@destroy');
    });

    Route::group(['prefix' => 'product'],function (){
        Route::get('/index',[
            'uses' => 'ProductController@index',
            'as' => 'product.index'
        ]);
        Route::get('/add',[
            'uses' => 'ProductController@create',
            'as' => 'product.create'
        ]);
        Route::post('/add',[
            'uses' => 'ProductController@store',
            'as' => 'product.store'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'ProductController@edit',
            'as' => 'product.edit'
        ]);
        Route::post('/edit/{id}',[
            'uses' => 'ProductController@update',
            'as' => 'product.update'
        ]);
        Route::post('/draft',[
            'uses' => 'ProductController@draft',
            'as' => 'product.draft'
        ]);
        Route::post('/getimage',[
            'uses' => 'ProductController@getImage',
            'as' => 'product.getimage'
        ]);
        Route::post('/uploadimage',[
            'uses' => 'ProductController@uploadimage',
            'as' => 'product.uploadimage'
        ]);
        Route::post('/delete/{id}',[
            'uses' => 'ProductController@destroy',
            'as' => 'product.delete'
        ]);
        Route::post('/image/delete/{id}','ProductController@deleteimage');
        Route::post('/image/getlist/{id}','ProductController@getlist');

    });

    Route::group(['prefix' => 'size'],function (){
       Route::get('/index',[
          'uses' => 'SizeController@index',
          'as' => 'size.index'
       ]);
        Route::get('/add',[
            'uses' => 'SizeController@create',
            'as' => 'size.create'
        ]);
        Route::post('/add',[
            'uses' => 'SizeController@store',
            'as' => 'size.store'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'SizeController@edit',
            'as' => 'size.edit'
        ]);
        Route::post('/edit/{id}',[
            'uses' => 'SizeController@update',
            'as' => 'size.update'
        ]);

        Route::post('/delete/{id}',[
            'uses' => 'SizeController@destroy',
            'as' => 'size.delete'
        ]);
    });

    Route::group(['prefix' => 'color'],function (){
       Route::get('/index',[
          'uses' => 'ColorController@index',
          'as' => 'color.index'
       ]);
        Route::get('/add',[
            'uses' => 'ColorController@create',
            'as' => 'color.add'
        ]);
        Route::post('/add',[
            'uses' => 'ColorController@store',
            'as' => 'color.store'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'ColorController@edit',
            'as' => 'color.edit'
        ]);
        Route::post('/edit/{id}',[
            'uses' => 'ColorController@update',
            'as' => 'color.update'
        ]);
        Route::post('/delete/{id}',[
            'uses' => 'ColorController@destroy',
            'as' => 'color.delete'
        ]);
    });
    Route::group(['prefix' => 'discount'],function (){
       Route::get('/index',[
         'uses' => 'DiscountController@index',
         'as' => 'discount.index'
       ]);
       Route::get('/add',[
           'uses' => 'DiscountController@create',
           'as' => 'discount.create'
       ]);
        Route::post('/add',[
            'uses' => 'DiscountController@store',
            'as' => 'discount.store'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'DiscountController@edit',
            'as' => 'discount.edit'
        ]);
        Route::post('/edit/{id}',[
            'uses' => 'DiscountController@update',
            'as' => 'discount.update'
        ]);
        Route::post('/delete/{id}',[
            'uses' => 'DiscountController@destroy',
            'as' => 'discount.delete'
        ]);
    });

    Route::group(['prefix' => 'satisfied'],function (){

        Route::get('/',[
           'as' => 'admin.satisfied.index',
           'uses' => 'SatisfiedcostumerController@index'
        ]);
        Route::get('/show/{id}',[
            'as' => 'admin.satisfied.show',
            'uses' => 'SatisfiedcostumerController@show'
        ]);
        Route::get('/create',[
            'as' => 'admin.satisfied.create',
            'uses' => 'SatisfiedcostumerController@create'
        ]);
        Route::post('/active/{id}',[
            'as' => 'admin.satisfied.active',
            'uses' => 'SatisfiedcostumerController@active'
        ]);
        Route::post('/create',[
            'as' => 'admin.satisfied.store',
            'uses' => 'SatisfiedcostumerController@store'
        ]);
        Route::post('/update/{id}',[
            'as' => 'admin.satisfied.update',
            'uses' => 'SatisfiedcostumerController@update'
        ]);
        Route::post('/delete/{id}',[
            'as' => 'admin.satisfied.delete',
            'uses' => 'SatisfiedcostumerController@destroy'
        ]);
    });

    Route::group(['prefix' => 'blog'],function (){
       Route::get('/',[
           'as' => 'admin.blog.index',
           'uses' => 'BlogController@index'
       ]);
       Route::get('/create',[
           'as' => 'admin.blog.create',
           'uses' => 'BlogController@create'
       ]);
        Route::post('/create',[
            'as' => 'admin.blog.store',
            'uses' => 'BlogController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'admin.blog.edit',
            'uses' => 'BlogController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'admin.blog.update',
            'uses' => 'BlogController@update'
        ]);
        Route::post('/delete/{id}',[
            'as' => 'admin.blog.delete',
            'uses' => 'BlogController@destroy'
        ]);
    });
    Route::group(['prefix' => 'about'],function (){

        Route::get('/create',[
            'as' => 'admin.about.create',
            'uses' => 'AboutController@create'
        ]);
        Route::post('/create',[
            'as' => 'admin.about.store',
            'uses' => 'AboutController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'admin.about.edit',
            'uses' => 'AboutController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'admin.about.update',
            'uses' => 'AboutController@update'
        ]);
        Route::post('/delete/{id}',[
            'as' => 'admin.about.delete',
            'uses' => 'AboutController@destroy'
        ]);
    });
    Route::group(['prefix' => 'contactus'],function (){
        Route::get('/',[
            'as' => 'admin.contactus.index',
            'uses' => 'MessageController@index'
        ]);

        Route::get('/edit/{id}',[
           'uses' => 'MessageController@edit',
           'as' => 'admin.contactus.edit'
        ]);

        Route::post('/delete/{id}',[
           'uses' => 'MessageController@destroy',
           'as' => 'admin.contactus.delete'
        ]);


    });
});

Route::group(['prefix' => 'user','middleware' => ['verified','isUser']],function (){
    Route::get('/',[
        'uses' => 'UserController@index',
        'as' => 'user.index'
    ]);
    Route::group(['prefix' => 'profile'],function (){
       Route::get('/edit/{id}',[
           'uses' => 'UserController@edit',
           'as' => 'user.edit'
       ]);
       Route::post('/edit/{id}',[
           'uses' => 'UserController@update',
           'as' => 'user.update'
       ]);
       Route::post('/getstate',[
           'uses' => 'UserController@getstate',
           'as' => 'user.getstate'
       ]);

       Route::post('/changepassword/{id}',[
           'uses' => 'UserController@changepassword',
           'as' => 'user.changepassword'
       ]);
    });

    Route::group(['prefix' => 'satisfied'],function (){

        Route::get('/create',[
            'as' => 'user.satisfied.showusercm',
            'uses' => 'SatisfiedcostumerController@showusercm'
        ]);
        Route::post('/create',[
            'as' => 'user.satisfied.addusercm',
            'uses' => 'SatisfiedcostumerController@addusercm'
        ]);

        Route::post('/update/{id}',[
            'as' => 'user.satisfied.editusercm',
            'uses' => 'SatisfiedcostumerController@editusercm'
        ]);

    });

    Route::group(['prefix' => 'myorder'],function (){
        Route::get('/{id}',[
            'uses' => 'MyorderController@index',
            'as' => 'user.myorder.index'
        ]);

        Route::get('/show/{id}',[
            'uses' => 'MyorderController@show',
            'as' => 'user.myorder.show'
        ]);
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
