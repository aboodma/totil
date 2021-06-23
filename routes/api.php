<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login','ApiController@Login');
Route::post('/signup','ApiController@SignUp');
Route::post('/categories','ApiController@Categories');
Route::post('/countries','ApiController@Countries');

Route::middleware(['auth:api'])->group(function () {
    Route::post('/userByToken','ApiController@GetUserByToken');
    Route::post('/acceptOrder','ApiController@AcceptOrder');
    Route::post('/rejectOrder','ApiController@RejectOrder');
    Route::post('/ProccedOrder','ApiController@ProccedOrder');
    Route::post('/logout','ApiController@Logout');
    Route::post('/user','ApiController@user');
  
});

