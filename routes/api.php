<?php
/**
 * Developer : Abdulrahman Mardinli
 * Email : aboodma@gmail.com
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    /**
     * How To Use :
     *   API URL : https://totil.net/api/{route}
     *   API POST AUTH Request : https://totil.net/api/{route}?api_token={user->api_token}
     */
    Route::post('/login', 'ApiController@Login');
    Route::post('/signup', 'ApiController@SignUp');
    Route::get('/categories', 'ApiController@Categories');
    Route::get('/providers', 'ApiController@Providers');
    Route::get('/provider/{provider}', 'ApiController@Provider');
    Route::get('/book/{book}', 'ApiController@BookServices');
    Route::get('/providerFromCategory', 'ApiController@providerFromCategory');
    Route::get('posts','ApiController@Posts');
    Route::get('post/{provider}','ApiController@Post');

Route::middleware(['auth:api'])->group(function () {
    Route::post('/userByToken', 'ApiController@GetUserByToken');
    Route::post('/logout', 'ApiController@Logout');
    Route::post('/user', 'ApiController@user');
    Route::post('/pay', 'ApiController@pay');
    Route::post('/myOrders','ApiController@myOrders');
    Route::post('/wallets','ApiController@wallet');
    Route::post('/packets','ApiController@packets');
    Route::post('/add_funds_to_wallet','ApiController@add_funds_to_wallet');
    Route::post('/profile_update','ApiController@profile_update');
    Route::post('premiumActivate','ApiController@premiumActivate');
    Route::post('reservation','ApiController@Reservation');
    Route::get('reservations','ApiController@Reservations');

});

