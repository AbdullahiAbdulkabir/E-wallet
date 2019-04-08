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

// Route::group(['middleware' => ['web']], function () {
//     Route::get('login', 'UserLoginController@getUserLogin');
//     Route::post('login', ['as'=>'user.auth','uses'=>'UserLoginController@userAuth']);
//     Route::get('admin/login', 'AdminLoginController@getAdminLogin');
//     Route::post('admin/login', ['as'=>'admin.auth','uses'=>'AdminLoginController@adminAuth']);
// });

    Route::get('login', 'ClientAuthController@getClientLogin');
    Route::get('register', [
        'as'=>'register',
        'uses'=>'ClientAuthController@getClientRegister'
        ]);
    Route::post('register', [
        'as'=>'register',
        'uses'=>'ClientAuthController@clientRegister'
        ]);
    Route::post('login', [
        'as'=>'login',
        'uses'=>'ClientAuthController@clientAuth'
        ]);
Route::group(['middleware' => ['client']], function () {
    Route::get('/logout', [
        'as'=>'client.logout',
        'uses'=>'ClientAuthController@logout'
    ]);
    Route::get('/', 
            ['as'=>'home',
            'uses'=>'ClientController@dashboard'
    ]);
    Route::get('/home', 
    ['as'=>'home',
    'uses'=>'ClientController@dashboard'
    ]);
    Route::get('/transaction', 
    ['as'=>'transaction',
    'uses'=>'TransactionController@getTransactions'
    ]);
    Route::get('/profile', 
    ['as'=>'profile',
    'uses'=>'ClientController@getProfile'
    ]);
    Route::get('/help', 
    ['as'=>'help',
    'uses'=>'HelpController@getHelp'
    ]);
    Route::post('/help', 
    ['as'=>'help',
    'uses'=>'HelpController@postHelp'
    ]);
    Route::get('/send', 
    ['as'=>'send',
    'uses'=>'TransactionController@getSend'
    ]);
    Route::get('/withdraw', 
    ['as'=>'withdraw',
    'uses'=>'TransactionController@withdraw'
    ]);


    Route::post('/send', 
    ['as'=>'send',
    'uses'=>'TransactionController@postSend'
    ]);
    Route::post('/withdrawl', 
    ['as'=>'withdrawl',
    'uses'=>'TransactionController@postwithdrawl'
    ]);
    /**
     * Credit/debit card routes
     */
    Route::get('/cardView',[
        'uses'=>'TransactionController@getCardView',
        'as'=>'cardview'
    ]);
    Route::post('/cardDeposit',[
        'uses'=>'TransactionController@cardDeposit',
        'as'=>'cardDeposit'
    ]);
    /**
     * Paypal routes
     */
    // route for view/blade file
    Route::get('paywithpaypal', array(
        'as' => 'paywithpaypal',
        'uses' => 'PaypalController@payWithPaypal',
    ));
    Route::get('paywithpaystack', array(
        'as' => 'paywithstack',
        'uses' => 'PaystackController@payWithPaystack',
    ));


    // route for post request
    // Route::post('paypal', array(
    //     'as' => 'paypal',
    //     'uses' => 'PaypalController@postPaymentWithpaypal',
    // ));
    Route::post('paypal', array(
        'as' => 'paypal',
        'uses' => 'PaystackController@redirectToGateway',
    ));
    Route::get('paypal', array(
        'as' => 'status',
        'uses' => 'PaypalController@getPaymentStatus',
    ));
    // route for check status responce
    // Route::post('paystack', array(
    //     'as' => 'paystack',
    //     'uses' => 'PaystackController@redirectToGateway',
    // ));

    // Route::post('/pay', 'PaystackController@redirectToGateway')->name('pay');
    Route::get('payment/call', 'PaystackController@handleGatewayCallback');
    
    });
    















